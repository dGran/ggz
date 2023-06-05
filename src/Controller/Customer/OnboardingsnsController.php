<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/onboardingsns', name: 'customer_onboardingsns')]
class OnboardingsnsController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/onboardingsns/index.html.twig');
    }
}
