<?php

declare(strict_types=1);

namespace App\Controller\Customer\User\Ajax;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OnBoardingController extends AbstractController
{
    private UserManager $userManager;

    public function __construct(
        UserManager $userManager
    ) {
        $this->userManager = $userManager;
    }

    #[Route('/onboarding/check-nickname', name: 'customer_onboarding_check_nickname')]
    public function signUp(Request $request): JsonResponse
    {
        $nickname = $request->get('nickname');
        $response = ['exists' => false];

        $user = $this->userManager->findByNickname($nickname);

        if ($user) {
            $response['exists'] = true;
        }

        return new JsonResponse($response);
    }
}
