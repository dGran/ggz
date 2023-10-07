<?php

declare(strict_types=1);

namespace App\Controller\Customer\User\Ajax;

use App\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OnBoardingController extends AbstractController
{
    private UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    #[Route('/onboarding/check-nickname/{userId}', name: 'customer_onboarding_check_nickname')]
    public function checkNickname(Request $request, int $userId): JsonResponse
    {
        $nickname = $request->get('nickname');
        $response = ['exists' => false];

        $user = $this->userService->isValidNickname($nickname, $userId);

        if ($user) {
            $response['exists'] = true;
        }

        return new JsonResponse($response);
    }
}
