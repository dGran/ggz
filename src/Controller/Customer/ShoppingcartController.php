<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingcartController extends AbstractController
{
    #[Route('/shoppingcart', name: 'app_shoppingcart')]
    public function index(): Response
    {
        return $this->render('shoppingcart/index.html.twig');
    }
}
