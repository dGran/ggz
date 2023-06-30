<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\NumberOfPlayers;
use App\Repository\NumberOfPlayersRepository;
use Doctrine\ORM\EntityManagerInterface;

class NumberOfPlayersManager
{
    protected EntityManagerInterface $entityManager;
    protected NumberOfPlayersRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(NumberOfPlayers::class);
    }

    public function create(): NumberOfPlayers
    {
        return new NumberOfPlayers();
    }

    public function save($numberOfPlayers): NumberOfPlayers
    {
        $this->entityManager->persist($numberOfPlayers);
        $this->entityManager->flush();

        return $numberOfPlayers;
    }

    public function delete(NumberOfPlayers $numberOfPlayers): NumberOfPlayers
    {
        $this->entityManager->remove($numberOfPlayers);
        $this->entityManager->flush();

        return $numberOfPlayers;
    }

    public function findOneById($id): ?NumberOfPlayers
    {
        /** @var NumberOfPlayers $numberOfPlayers */
        $numberOfPlayers = $this->repository->find($id);

        return $numberOfPlayers;
    }

    public function findOneBy(array $criteria, array $orderBy = null): NumberOfPlayers
    {
        /** @var NumberOfPlayers $numberOfPlayers */
        $numberOfPlayers = $this->repository->findOneBy($criteria, $orderBy);

        return $numberOfPlayers;
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