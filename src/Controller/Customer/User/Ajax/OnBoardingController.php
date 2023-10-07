<?php

declare(strict_types=1);

namespace App\Controller\Customer\User\Ajax;

use App\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        if (!$request->request->has('nickname')) {
            $response = ['isValid' => false, 'error' => 'Nickname is missing',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $nickname = $request->get('nickname');

        if ($this->userService->isValidNickname($nickname, $userId)) {
            $response = ['isValid' => true];
        } else {
            $response = ['isValid' => false];
        }

        return new JsonResponse($response);
    }
}
