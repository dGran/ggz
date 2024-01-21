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
        $nicknameErrorResponse = $this->getNicknameErrorResponse($nickname, $user->getId());

        if (!empty($nicknameErrorResponse)) {
            return new JsonResponse($nicknameErrorResponse);
        }

        try {
            $user->setNickname($nickname);
            $this->userManager->save($user);
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
    #[Route('/user-settings/{user}/update-email', name: 'customer_user_settings_update_email')]
    #[Security('is_granted("ROLE_USER")')]
    public function updateEmail(Request $request, User $user): JsonResponse
    {
        $emailRequest = $request->get('email');
        $emailErrorResponse = $this->getEmailErrorResponse($emailRequest, $user->getId());

        if (!empty($emailErrorResponse)) {
            return new JsonResponse($emailErrorResponse);
        }

        try {
            $user->setEmailRequest($emailRequest);
            $user->setDateEmailRequest(new \DateTime);
            $this->userManager->save($user);
            $response = ['result' => true];
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Internal server error'];
        }

        return new JsonResponse($response);
    }

    /**
     * @return array{result: bool, message: string}
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    private function getNicknameErrorResponse(string $nickname, int $userId): array
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
    private function getEmailErrorResponse(string $email, int $userId): array
    {
        if (!$email) {
            return $this->getErrorResponse(self::FIELD_EMAIL.' '.self::ERROR_MESSAGE_NOT_SPECIFIED);
        }

        if (!\preg_match(UserService::EMAIL_PATTERN, $email)) {
            return $this->getErrorResponse(self::ERROR_MESSAGE_EMAIL_NOT_VALID);
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
