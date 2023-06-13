<?php

namespace App\Controller\Customer\Auth;

use App\Entity\User;
use App\Form\Customer\auth\SignUpType;
use App\Security\EmailVerifier;
use App\Service\Customer\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class SignupController extends AbstractController
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

    #[Route('/signup', name: 'customer_signup')]
    public function signUp(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
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
            $this->emailVerifier->sendEmailConfirmation('customer_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@gengemz.com', 'Gengemz'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('customer/auth/signup/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('customer_onboarding_step_one', ['user' => $user->getId()]);
        }

        return $this->render('customer/auth/signup/signup.html.twig', [
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

    #[Route('/onboarding/{user}/step-one', name: 'customer_onboarding_step_one')]
    public function onBoardingStepOne(User $user): Response
    {
        if (
            !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('customer_home');
        }

        return $this->render('customer/auth/signup/onboarding/step_one.html.twig',
            [
                'user' => $user,
            ]
        );
    }

    #[Route('/onboarding/{user}/step-two', name: 'customer_onboarding_step_two')]
    public function onBoardingStepTwo(User $user): Response
    {
        if (
            !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('customer_home',
                [
                    'user' => $user,
                ]
            );
        }

        return $this->render('customer/auth/signup/onboarding/step_two.html.twig');
    }

    #[Route('/onboarding/{user}/step-three', name: 'customer_onboarding_step_three')]
    public function onBoardingStepThree(User $user): Response
    {
        if (
            !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')
            || !$this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')
        ) {
            return $this->redirectToRoute('customer_home');
        }

        return $this->render('customer/auth/signup/onboarding/step_three.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
