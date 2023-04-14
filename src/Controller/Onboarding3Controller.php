<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Onboarding3Controller extends AbstractController
{
    #[Route('/onboarding3', name: 'app_onboarding3')]
    public function index(): Response
    {
        return $this->render('onboarding3/index.html.twig', [
            'controller_name' => 'Onboarding3Controller',
        ]);
    }
}
