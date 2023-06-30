<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Region;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;

class RegionManager
{
    protected EntityManagerInterface $entityManager;
    protected RegionRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Region::class);
    }

    public function create(): Region
    {
        return new Region();
    }

    public function save($region): Region
    {
        $this->entityManager->persist($region);
        $this->entityManager->flush();

        return $region;
    }

    public function delete(Region $region): Region
    {
        $this->entityManager->remove($region);
        $this->entityManager->flush();

        return $region;
    }

    public function findOneById($id): ?Region
    {
        /** @var Region $region */
        $region = $this->repository->find($id);

        return $region;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Region
    {
        /** @var Region $region */
        $region = $this->repository->findOneBy($criteria, $orderBy);

        return $region;
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
     * @param Region[] $regions
     *
     * @return Region[]
     */
    public function saveCollection(array $regions): array
    {
        foreach ($regions as $region) {
            $this->entityManager->persist($region);
        }

        $this->entityManager->flush();

        return $regions;
    }
}