<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user-settings', name: 'customer_user_settings')]
class SettingsController extends AbstractController
{
    public function __invoke(): Response
    {
        $user = $this->getUser();

        return $this->render('customer/user/settings/index.html.twig', [
            'user' => $user,
        ]);
    }
}
