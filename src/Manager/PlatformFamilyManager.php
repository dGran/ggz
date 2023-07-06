<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\PlatformFamily;
use App\Repository\PlatformFamilyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class PlatformFamilyManager
{
    protected EntityManagerInterface $entityManager;
    protected PlatformFamilyRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(PlatformFamily::class);
    }

    public function create(): PlatformFamily
    {
        return new PlatformFamily();
    }

    public function save($platformFamily): PlatformFamily
    {
        $this->entityManager->persist($platformFamily);
        $this->entityManager->flush();

        return $platformFamily;
    }

    public function delete(PlatformFamily $platformFamily): PlatformFamily
    {
        $this->entityManager->remove($platformFamily);
        $this->entityManager->flush();

        return $platformFamily;
    }

    public function findOneById($id): ?PlatformFamily
    {
        /** @var PlatformFamily $platformFamily */
        $platformFamily = $this->repository->find($id);

        return $platformFamily;
    }

    public function findOneBy(array $criteria, array $orderBy = null): PlatformFamily
    {
        /** @var PlatformFamily $platformFamily */
        $platformFamily = $this->repository->findOneBy($criteria, $orderBy);

        return $platformFamily;
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
     * @param PlatformFamily[] $platformFamilies
     *
     * @return PlatformFamily[]
     */
    public function saveCollection(array $platformFamilies): array
    {
        foreach ($platformFamilies as $platformFamily) {
            $this->entityManager->persist($platformFamily);
        }

        $this->entityManager->flush();

        return $platformFamilies;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): ?PlatformFamily
    {
        return $this->repository->findByName($name);
    }
}