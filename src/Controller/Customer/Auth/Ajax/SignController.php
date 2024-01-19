<?php

declare(strict_types=1);

namespace App\Controller\Customer\Auth\Ajax;

use App\Entity\User;
use App\Manager\UserManager;
use App\Security\EmailVerifier;
use App\Service\UserService;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class SignController extends AbstractController
{
    private UserService $userService;

    private UserManager $userManager;

    private EmailVerifier $emailVerifier;

    private LoggerInterface $logger;

    public function __construct(
        UserService $userService,
        UserManager $userManager,
        EmailVerifier $emailVerifier,
        LoggerInterface $logger
    ) {
        $this->userService = $userService;
        $this->userManager = $userManager;
        $this->emailVerifier = $emailVerifier;
        $this->logger = $logger;
    }

    #[Route('/sign-up/check-email-availability', name: 'customer_sign_up_check_email_availability')]
    public function checkEmailAvailability(Request $request): JsonResponse
    {
        if (!$request->request->has('sign_up_email')) {
            $response = ['isAvailable' => false, 'message' => 'E-mail must be specified to check its availability',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $email = $request->get('sign_up_email');

        if ($this->userService->isEmailAvailable($email)) {
            $response = ['isAvailable' => true];
        } else {
            $response = ['isAvailable' => false, 'message' => 'There is already an account with this nickname'];
        }

        return new JsonResponse($response);
    }

    #[Route('/resend/verify/email/{user}', name: 'customer_resend_verify_email')]
    #[Security('is_granted("ROLE_USER")')]
    public function resendEmailConfirmation(User $user): JsonResponse
    {
        $dateVerificationEmailSend = $user->getDateVerificationEmailSend();

        if (!$dateVerificationEmailSend) {
            $dateVerificationEmailSend = new \DateTime();
        }

        $nextDateAvailableToSendVerificationEmail = (clone $dateVerificationEmailSend)->modify('+'.User::TIME_INTERVAL_FOR_SENDING_VERIFICATION_EMAIL.'minutes');
        $currentDate = new \DateTime();

        if ($currentDate < $nextDateAvailableToSendVerificationEmail) {
            $response = [
                'status' => 'warning',
                'message' => 'Please wait 5 minutes before requesting another verification email. If you haven\'t received it, check your inbox after the waiting period and request again.',
            ];

            return new JsonResponse($response);
        }

        try {
            $this->emailVerifier->sendEmailConfirmation('customer_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@gengemz.com', 'Gengemz'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('customer/auth/sign/confirmation_email.html.twig')
            );

            $user->setDateVerificationEmailSend(new \DateTime());
            $this->userManager->save($user);

            $response = [
                'status' => 'success',
                'message' => 'We\'ve sent a verification email to your inbox. Please follow the instructions inside to verify your account.',
            ];

            return new JsonResponse($response);
        } catch (\Throwable $exception) {
            $this->logger->error(__METHOD__.' - There was an error sending the verification email, user id: '.$user->getId().', user email: '.$user->getEmail().', exception: '.$exception->getMessage());

            $response = [
                'status' => 'error',
                'message' => 'Sorry, we encountered an issue sending your verification email. Please try again later.',
            ];

            return new JsonResponse($response);
        }
    }
}
