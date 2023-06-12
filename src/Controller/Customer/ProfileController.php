<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile', name: 'customer_profile')]
class ProfileController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/profile/index.html.twig');
    }
}
