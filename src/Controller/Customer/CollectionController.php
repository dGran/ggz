<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/collection', name: 'customer_collection')]
class CollectionController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('collection/index.html.twig');
    }
}
