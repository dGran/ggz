<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Onboarding2Controller extends AbstractController
{
    #[Route('/onboarding2', name: 'app_onboarding2')]
    public function index(): Response
    {
        return $this->render('onboarding2/index.html.twig', [
            'controller_name' => 'Onboarding2Controller',
        ]);
    }
}
