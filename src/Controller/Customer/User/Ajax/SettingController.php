<?php

declare(strict_types=1);

namespace App\Controller\Customer\User\Ajax;

use App\Entity\User;
use App\Manager\UserManager;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    private UserManager $userManager;

    private LoggerInterface $logger;

    public function __construct(
        UserManager $userManager,
        LoggerInterface $logger
    ) {
        $this->userManager = $userManager;
        $this->logger = $logger;
    }

    #[Route('/user-settings/{user}/update-nickname', name: 'customer_user_settings_update_nickname')]
    #[Security('is_granted("ROLE_USER")')]
    public function updateNickname(Request $request, User $user): JsonResponse
    {
        $nickname = $request->get('nickname');

        if (!$nickname) {
            $response = ['result' => false, 'message' => 'Error, no data specified',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        try {
            $user->setNickname($nickname);
            $this->userManager->save($user);
            $response = ['result' => true, 'message' => 'Saved'];
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Error'];
        }

        return new JsonResponse($response);
    }

    #[Route('/user-settings/{user}/update-email', name: 'customer_user_settings_update_email')]
    public function updateEmail(Request $request, User $user): JsonResponse
    {
        $email = $request->get('email');

        if (!$email) {
            $response = ['result' => false, 'message' => 'Error, no data specified',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        try {
            $user->setEmail($email);
            $this->userManager->save($user);
            $response = ['result' => true, 'message' => 'Saved'];
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Error'];
        }

        return new JsonResponse($response);
    }
}
