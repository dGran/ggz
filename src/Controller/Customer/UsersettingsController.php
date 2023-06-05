<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user-settings', name: 'customer_user_settings')]
class UsersettingsController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/user_settings/index.html.twig');
    }
}
