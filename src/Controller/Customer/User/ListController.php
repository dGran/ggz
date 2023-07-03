<?php

declare(strict_types=1);

namespace App\Controller\Customer\User;

use App\Entity\Edition;
use App\Entity\ListType;
use App\Entity\User;
use App\Manager\ListTypeManager;
use App\Manager\UserListManager;
use Doctrine\ORM\NonUniqueResultException;
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

    #[Route('/lists', name: 'customer_user_lists')]
    public function index(): Response
    {
        $listTypes = ListType::LIST_TYPE_DATA_INDEXED_BY_ID;

        return $this->render('customer/user/lists/index.html.twig', [
            'list_types' => $listTypes,
        ]);
    }

    #[Route('/lists/{slug}', name: 'customer_user_list_show')]
    public function show(ListType $list): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $editions = $this->userListManager->findEditionsByUserAndListType($user->getId(), $list->getId());

        return $this->render('customer/user/lists/show.html.twig', [
            'list' => $list,
            'editions' => $editions,
        ]);
    }

    #[Route('/lists/add-edition-to-list/{edition}', name: 'customer_lists_add_edition', methods: ['POST'])]
    public function addEditionToList(Request $request, Edition $edition): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $listTypeId = $request->get('listTypeId');
        $listType = $this->listTypeManager->findOneById($listTypeId);

        if ($listType === null) {
            $this->addFlash('error', 'The list no longer exists');

            return $this->redirectToRoute('customer_explore');
        }

        $userList = $this->userListManager->create();
        $userList->setUser($user);
        $userList->setType($listType);
        $userList->setEdition($edition);

        try {
            $this->userListManager->save($userList);
            $this->addFlash('success', $edition->getName().' has been added to your '.$listType->getName().' list.');
        } catch(\Throwable $exception) {
            $this->addFlash('error', $edition->getName().' is already included in your '.$listType->getName().' list.');
        }

        return $this->redirectToRoute('customer_explore');
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/lists/remove-edition-to-list/{edition}', name: 'customer_lists_remove_edition', methods: ['POST'])]
    public function removeEditionToList(Request $request, Edition $edition): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $listTypeId = $request->get('listTypeId');
        $listType = $this->listTypeManager->findOneById($listTypeId);

        if ($listType === null) {
            $this->addFlash('error', 'The list no longer exists');

            return $this->redirectToRoute('customer_explore');
        }

        $userList = $this->userListManager->findByUserAndEditionAndListType($user, $edition, $listType);

        if ($userList === null) {
            $this->addFlash('error', $edition->getName().' is not included in your '.$listType->getName().' list.');

            return $this->redirectToRoute('customer_explore');
        }

        try {
            $this->userListManager->delete($userList);
            $this->addFlash('success', $edition->getName().' has been removed from your '.$listType->getName().' list.');
        } catch(\Throwable $exception) {
            $this->addFlash('error', $edition->getName().' is already included in your '.$listType->getName().' list.');
        }

        return $this->redirectToRoute('customer_explore');
    }
}
