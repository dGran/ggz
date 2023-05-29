<?php

namespace App\Controller\Customer\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/signup', name: 'app_signup')]
class SignupController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/authentication/signup.twig');
    }
}
