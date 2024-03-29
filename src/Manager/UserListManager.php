<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Edition;
use App\Entity\ListType;
use App\Entity\User;
use App\Entity\UserList;
use App\Repository\UserListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class UserListManager
{
    protected EntityManagerInterface $entityManager;
    protected UserListRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(UserList::class);
    }

    public function create(): UserList
    {
        return new UserList();
    }

    public function save($userList): UserList
    {
        $this->entityManager->persist($userList);
        $this->entityManager->flush();

        return $userList;
    }

    public function delete(UserList $userList): UserList
    {
        $this->entityManager->remove($userList);
        $this->entityManager->flush();

        return $userList;
    }

    public function findOneById($id): ?UserList
    {
        /** @var UserList $userList */
        $userList = $this->repository->find($id);

        return $userList;
    }

    public function findOneBy(array $criteria, array $orderBy = null): UserList
    {
        /** @var UserList $userList */
        $userList = $this->repository->findOneBy($criteria, $orderBy);

        return $userList;
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @return UserList[]
     */
    public function findByUser(User $user): array
    {
        return $this->repository->findByUser($user);
    }

    /**
     * @return UserList[]
     */
    public function findEditionsByUserAndListType(int $userId, int $listTypeId): array
    {
        $userLists = $this->repository->findEditionsByUserAndListType($userId, $listTypeId);
        $editions = [];

        foreach ($userLists as $userList) {
            $editions[] = $userList->getEdition();
        }

        return $editions;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByUserAndEditionAndListType(User $user, Edition $edition, ListType $listType): ?UserList
    {
        return $this->repository->findByUserAndEditionAndListType($user, $edition, $listType);
    }
}