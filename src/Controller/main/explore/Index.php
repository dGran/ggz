<?php

declare(strict_types=1);

namespace App\Controller\main\explore;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/explore', name: 'explore', methods: ['GET', 'POST'])]
class Index extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        return $this->render('explore/list.html.twig', []);
    }
}