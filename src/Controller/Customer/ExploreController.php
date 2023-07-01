<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Manager\EditionManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/explore', name: 'customer_explore', methods: ['GET', 'POST'])]
class ExploreController extends AbstractController
{
    private EditionManager $editionManager;

    public function __construct(EditionManager $editionManager)
    {
        $this->editionManager = $editionManager;
    }

    public function __invoke(Request $request): Response
    {
        $editions = $this->editionManager->findAll();

        return $this->render('customer/explore/list.html.twig', [
            'editions' => $editions,
        ]);
    }
}