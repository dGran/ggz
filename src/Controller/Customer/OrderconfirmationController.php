<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/orderconfirmation', name: 'customer_orderconfirmation')]
class OrderconfirmationController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/orderconfirmation/index.html.twig');
    }
}
