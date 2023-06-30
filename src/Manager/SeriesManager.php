<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;

class SeriesManager
{
    protected EntityManagerInterface $entityManager;
    protected SerieRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Serie::class);
    }

    public function create(): Serie
    {
        return new Serie();
    }

    public function save($serie): Serie
    {
        $this->entityManager->persist($serie);
        $this->entityManager->flush();

        return $serie;
    }

    public function delete(Serie $serie): Serie
    {
        $this->entityManager->remove($serie);
        $this->entityManager->flush();

        return $serie;
    }

    public function findOneById($id): ?Serie
    {
        /** @var Serie $serie */
        $serie = $this->repository->find($id);

        return $serie;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Serie
    {
        /** @var Serie $serie */
        $serie = $this->repository->findOneBy($criteria, $orderBy);

        return $serie;
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
     * @param Serie[] $series
     *
     * @return Serie[]
     */
    public function saveCollection(array $series): array
    {
        foreach ($series as $serie) {
            $this->entityManager->persist($serie);
        }

        $this->entityManager->flush();

        return $series;
    }
}