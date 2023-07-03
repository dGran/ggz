<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Entity\User;
use App\Manager\EditionManager;
use App\Manager\UserListManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/explore', name: 'customer_explore', methods: ['GET', 'POST'])]
class ExploreController extends AbstractController
{
    private EditionManager $editionManager;
    private UserListManager $userListManager;

    public function __construct(EditionManager $editionManager, UserListManager $userListManager)
    {
        $this->editionManager = $editionManager;
        $this->userListManager = $userListManager;
    }

    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $editions = $this->editionManager->findAll();
        $userLists = $this->userListManager->findByUser($user);

        return $this->render('customer/explore/list.html.twig', [
            'editions' => $editions,
            'user_lists' => $userLists,
        ]);
    }
}