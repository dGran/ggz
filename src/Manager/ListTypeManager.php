<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\ListType;
use App\Repository\ListTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ListTypeManager
{
    protected EntityManagerInterface $entityManager;
    protected ListTypeRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(ListType::class);
    }

    public function create(): ListType
    {
        return new ListType();
    }

    public function save($listType): ListType
    {
        $this->entityManager->persist($listType);
        $this->entityManager->flush();

        return $listType;
    }

    public function delete(ListType $listType): ListType
    {
        $this->entityManager->remove($listType);
        $this->entityManager->flush();

        return $listType;
    }

    public function findOneById($id): ?ListType
    {
        /** @var ListType $listType */
        $listType = $this->repository->find($id);

        return $listType;
    }

    public function findOneBy(array $criteria, array $orderBy = null): ListType
    {
        /** @var ListType $listType */
        $listType = $this->repository->findOneBy($criteria, $orderBy);

        return $listType;
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }
}