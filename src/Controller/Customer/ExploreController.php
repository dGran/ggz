<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/explore', name: 'explore', methods: ['GET', 'POST'])]
class ExploreController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        return $this->render('customer/explore/list.html.twig', []);
    }
}