<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lists', name: 'app_lists')]
class ListsController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/lists/index.html.twig');
    }
}
