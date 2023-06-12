<?php

namespace App\Controller\Customer\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/login', name: 'customer_login')]
class LoginController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/login/index.html.twig');
    }
}
