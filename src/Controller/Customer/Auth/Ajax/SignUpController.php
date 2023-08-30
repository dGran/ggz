<?php

declare(strict_types=1);

namespace App\Controller\Customer\Auth\Ajax;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    private UserManager $userManager;

    public function __construct(
        UserManager $userManager
    ) {
        $this->userManager = $userManager;
    }

    #[Route('/sign-up/check-email', name: 'customer_sign_up_check_email')]
    public function signUp(Request $request): JsonResponse
    {
        $email = $request->get('sign_up_email');
        $response = ['exists' => false];

        $user = $this->userManager->findByEmail($email);

        if ($user) {
            $response['exists'] = true;
        }

        return new JsonResponse($response);
    }
}
