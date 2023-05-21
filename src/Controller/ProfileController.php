<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile', name: 'app_profile')]
class ProfileController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('profile/index.html.twig');
    }
}
