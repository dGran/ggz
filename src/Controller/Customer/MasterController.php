<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/master', name: 'customer_master')]
class MasterController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('customer/master/index.html.twig');
    }
}
