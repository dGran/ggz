<?php

namespace App\Controller\Customer\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/login', name: 'app_login')]
class LoginController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/login/index.html.twig');
    }
}
