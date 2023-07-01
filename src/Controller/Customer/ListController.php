<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Entity\Edition;
use App\Entity\User;
use App\Manager\ListTypeManager;
use App\Manager\UserListManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    private UserListManager $userListManager;
    private ListTypeManager $listTypeManager;

    public function __construct(UserListManager $userListManager, ListTypeManager $listTypeManager)
    {
        $this->userListManager = $userListManager;
        $this->listTypeManager = $listTypeManager;
    }

    #[Route('/lists', name: 'customer_lists')]
    public function index(): Response
    {
        return $this->render('customer/lists/index.html.twig');
    }

    #[Route('/lists/add-edition-to-list/{edition}', name: 'customer_lists_add_edition', methods: ['POST'])]
    public function addEditionToList(Request $request, Edition $edition): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $listTypeId = $request->get('listTypeId');
        $listType = $this->listTypeManager->findOneById($listTypeId);

        $userList = $this->userListManager->create();
        $userList->setUser($user);
        $userList->setType($listType);
        $userList->setEdition($edition);
        $this->userListManager->save($userList);

//        TODO: avoid duplicates

        return $this->redirectToRoute('customer_lists');
    }
}
