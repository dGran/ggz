<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\User;
use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile', name: 'customer_user_profile')]
#[Security('is_granted("ROLE_USER")')]
class ProfileController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $profilePicPath = $this->userService->getProfilePicPath($user);

        return $this->render('customer/user/profile/index.html.twig', [
            'user' => $user,
            'profile_pic_path' => $profilePicPath,
        ]);
    }
}
