<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnboardingsnsController extends AbstractController
{
    #[Route('/onboardingsns', name: 'app_onboardingsns')]
    public function index(): Response
    {
        return $this->render('onboardingsns/index.html.twig', [
            'controller_name' => 'OnboardingsnsController',
        ]);
    }
}
