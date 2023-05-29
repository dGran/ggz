<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderconfirmationController extends AbstractController
{
    #[Route('/orderconfirmation', name: 'app_orderconfirmation')]
    public function index(): Response
    {
        return $this->render('orderconfirmation/index.html.twig');
    }
}
