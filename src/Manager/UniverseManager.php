<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Universe;
use App\Repository\UniverseRepository;
use Doctrine\ORM\EntityManagerInterface;

class UniverseManager
{
    protected EntityManagerInterface $entityManager;
    protected UniverseRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Universe::class);
    }

    public function create(): Universe
    {
        return new Universe();
    }

    public function save($universe): Universe
    {
        $this->entityManager->persist($universe);
        $this->entityManager->flush();

        return $universe;
    }

    public function delete(Universe $universe): Universe
    {
        $this->entityManager->remove($universe);
        $this->entityManager->flush();

        return $universe;
    }

    public function findOneById($id): ?Universe
    {
        /** @var Universe $universe */
        $universe = $this->repository->find($id);

        return $universe;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Universe
    {
        /** @var Universe $universe */
        $universe = $this->repository->findOneBy($criteria, $orderBy);

        return $universe;
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
     * @param Universe[] $universes
     *
     * @return Universe[]
     */
    public function saveCollection(array $universes): array
    {
        foreach ($universes as $universe) {
            $this->entityManager->persist($universe);
        }

        $this->entityManager->flush();

        return $universes;
    }
}