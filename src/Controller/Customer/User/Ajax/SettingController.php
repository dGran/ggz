<?php

declare(strict_types=1);

namespace App\Controller\Customer\User\Ajax;

use App\Entity\User;
use App\Manager\UserManager;
use Psr\Log\LoggerInterface;
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

    #[Route('/settings/update-nickname/{user}', name: 'customer_settings_update-nickname')]
    public function updateNickname(Request $request, User $user): JsonResponse
    {
        if (!$request->request->has('nickname')) {
            $response = ['result' => false, 'message' => 'Error, no nickname specified',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        try {
            $nickname = $request->get('nickname');
            $user->setNickname($nickname);
            $this->userManager->save($user);
            $response = ['result' => true, 'message' => 'Saved'];
        } catch (\Exception $exception) {
            $this->logger->critical(date(\DATE_W3C).' - Exception: '.$exception->getMessage());
            $response = ['result' => false, 'message' => 'Error'];
        }

        return new JsonResponse($response);
    }

    #[Route('/settings/update-email/{user}', name: 'customer_settings_update-email')]
    public function updateEmail(Request $request, User $user): JsonResponse
    {
        if (!$request->request->has('email')) {
            $response = ['result' => false, 'message' => 'Error, no email specified',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        try {
            $email = $request->get('email');
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
