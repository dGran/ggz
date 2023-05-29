<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListsController extends AbstractController
{
    #[Route('/lists', name: 'app_lists')]
    public function index(): Response
    {
        return $this->render('lists/index.html.twig');
    }
}
