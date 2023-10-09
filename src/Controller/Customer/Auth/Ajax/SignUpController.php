<?php

declare(strict_types=1);

namespace App\Controller\Customer\Auth\Ajax;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/sign-up/check-email-availability', name: 'customer_sign_up_check_email_availability')]
    public function __invoke(Request $request): JsonResponse
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
}
