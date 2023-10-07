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
    #[Route('/onboarding/check-nickname-availability/{userId}', name: 'customer_onboarding_check_nickname_availability')]
    public function checkNicknameAvailability(Request $request, int $userId): JsonResponse
    {
        if (!$request->request->has('nickname')) {
            $response = ['isAvailable' => false, 'message' => 'Nickname must be specified to check its availability',];

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $nickname = $request->get('nickname');

        if ($this->userService->isNicknameAvailable($nickname, $userId)) {
            $response = ['isAvailable' => true];
        } else {
            $response = ['isAvailable' => false, 'message' => 'There is already an account with this nickname'];
        }

        return new JsonResponse($response);
    }
}
