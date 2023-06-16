<?php

declare(strict_types=1);

namespace App\Controller\Customer\Auth;

use App\Entity\User;
use App\Form\Customer\auth\SignUpType;
use App\Security\EmailVerifier;
use App\Service\Customer\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class SignController extends AbstractController
{
    private EmailVerifier $emailVerifier;
    private UserService $userService;
    private MailerInterface $mailer;
    private AuthorizationCheckerInterface $authorizationChecker;

    public function __construct(
        EmailVerifier $emailVerifier,
        UserService $userService,
        MailerInterface $mailer,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->emailVerifier = $emailVerifier;
        $this->userService = $userService;
        $this->mailer = $mailer;
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route(path: '/sign-in', name: 'customer_sign_in')]
    public function signIn(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('customer/auth/sign/sign_in.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/sign-out', name: 'customer_sign_out')]
    public function signOut(): void
    {
//        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/sign-up', name: 'customer_sign_up')]
    public function signUp(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        if (
            $this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
            || $this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('customer_home');
        }

        $user = new User();
        $form = $this->createForm(SignUpType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
//            $this->emailVerifier->sendEmailConfirmation('customer_verify_email', $user,
//                (new TemplatedEmail())
//                    ->from(new Address('no-reply@gengemz.com', 'Gengemz'))
//                    ->to($user->getEmail())
//                    ->subject('Please Confirm your Email')
//                    ->htmlTemplate('customer/auth/signup/confirmation_email.html.twig')
//            );


            return $this->redirectToRoute('customer_onboarding_step_one', ['user' => $user->getId()]);
        }

        return $this->render('customer/auth/sign/sign_up.html.twig', [
            'sign_up_form' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'customer_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('customer_signup');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('customer_onboarding_step_one');
    }
}
