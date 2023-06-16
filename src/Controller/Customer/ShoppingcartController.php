<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shoppingcart', name: 'customer_shoppingcart')]
class ShoppingcartController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/shoppingcart/index.html.twig');
    }
}
