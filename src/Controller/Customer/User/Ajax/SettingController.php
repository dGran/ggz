<?php

declare(strict_types=1);

namespace App\Controller\Customer\User\Ajax;

use App\Entity\User;
use App\Manager\UserManager;
use App\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    public const NICKNAME_MIN_LENGTH = 4;

    public const NICKNAME_MAX_LENGTH = 24;

    private const FIELD_NICKNAME = 'Nickname';

    private const FIELD_EMAIL = 'Email';

    private const ERROR_MESSAGE_NOT_SPECIFIED = 'not specified';

    private const ERROR_MESSAGE_NOT_AVAILABLE = 'not available';

    private const ERROR_MESSAGE_NICKNAME_LENGTH_NOT_VALID = 'You must enter between 4 and 24 characters';

    private const ERROR_MESSAGE_EMAIL_NOT_VALID = 'You must enter a valid email';

    private const ERROR_MESSAGE_SAME_EMAIL_REQUESTED = 'You must enter a new email';

    private UserManager $userManager;

    private UserService $userService;

    private LoggerInterface $logger;

    public function __construct(
        UserManager $userManager,
        UserService $userService,
        LoggerInterface $logger
    ) {
        $this->userManager = $userManager;
        $this->userService = $userService;
        $this->logger = $logger;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    #[Route('/user-settings/{user}/update-nickname', name: 'customer_user_settings_update_nickname')]
    #[Security('is_granted("ROLE_USER")')]
    public function updateNickname(Request $request, User $user): JsonResponse
    {
        $nickname = $request->get('nickname');
        $nicknameErrorResponse = $this->getNicknameErrorResponse($user->getId(), $nickname);

        if (!empty($nicknameErrorResponse)) {
            return new JsonResponse($nicknameErrorResponse);
        }

        try {
            $user->setNickname($nickname);
            $this->userManager->update($user);
            $response = ['result' => true];
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Internal server error'];
        }

        return new JsonResponse($response);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    #[Route('/user-settings/{user}/add-email-request', name: 'customer_user_settings_add_email_request')]
    #[Security('is_granted("ROLE_USER")')]
    public function addEmailRequest(Request $request, User $user): JsonResponse
    {
        $emailRequest = $request->get('email');
        $emailErrorResponse = $this->getEmailErrorResponse($user->getId(), $user->getEmail(), $emailRequest);

        if (!empty($emailErrorResponse)) {
            return new JsonResponse($emailErrorResponse);
        }

        try {
            $user->setEmailRequest($emailRequest);
            $user->setDateEmailRequest(new \DateTime());
            $this->userManager->update($user);
            $response = ['result' => true];

            //TODO: Send email confirmation and implements controller to handling
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Internal server error'];
        }

        return new JsonResponse($response);
    }

    #[Route('/user-settings/{user}/remove-email-request', name: 'customer_user_settings_remove_email_request')]
    #[Security('is_granted("ROLE_USER")')]
    public function removeEmailRequest(User $user): JsonResponse
    {
        try {
            $user->setEmailRequest(null);
            $user->setDateEmailRequest(null);
            $this->userManager->update($user);
            $response = ['result' => true];
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Internal server error'];
        }

        return new JsonResponse($response);
    }

    public function updatePassword(): JsonResponse
    {
        //TODO
        $response = ['result' => false];

        return new JsonResponse($response);
    }

    /**
     * @return array{result: bool, message: string}
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    private function getNicknameErrorResponse(int $userId, ?string $nickname = null): array
    {
        if (!$nickname) {
            return $this->getErrorResponse(self::FIELD_NICKNAME.' '.self::ERROR_MESSAGE_NOT_SPECIFIED);
        }

        if (!$this->userService->isNicknameAvailable($nickname, $userId)) {
            return $this->getErrorResponse(self::FIELD_NICKNAME.' '.self::ERROR_MESSAGE_NOT_AVAILABLE);
        }

        if (
            \mb_strlen($nickname, 'UTF-8') < self::NICKNAME_MIN_LENGTH
            || \mb_strlen($nickname, 'UTF-8') > self::NICKNAME_MAX_LENGTH
        ) {
            return $this->getErrorResponse(self::ERROR_MESSAGE_NICKNAME_LENGTH_NOT_VALID);
        }

        return [];
    }

    /**
     * @return array{result: bool, message: string}
     *
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    private function getEmailErrorResponse(int $userId, string $currentEmail, ?string $email = null): array
    {
        if (!$email) {
            return $this->getErrorResponse(self::FIELD_EMAIL.' '.self::ERROR_MESSAGE_NOT_SPECIFIED);
        }

        if (!\preg_match(UserService::EMAIL_PATTERN, $email)) {
            return $this->getErrorResponse(self::ERROR_MESSAGE_EMAIL_NOT_VALID);
        }

        if ($currentEmail === $email) {
            return $this->getErrorResponse(self::ERROR_MESSAGE_SAME_EMAIL_REQUESTED);
        }

        if (!$this->userManager->isEmailAvailable($email, $userId)) {
            return $this->getErrorResponse(self::FIELD_EMAIL.' '.self::ERROR_MESSAGE_NOT_AVAILABLE);
        }

        return [];
    }

    /**
     * @return array{result: bool, message: string}
     */
    private function getErrorResponse(string $message): array
    {
        return [
            'result' => false,
            'message' => $message,
        ];
    }
}
