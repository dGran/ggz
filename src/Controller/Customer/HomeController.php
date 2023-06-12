<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'customer_home')]
class HomeController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/home/index.html.twig');
    }
}
