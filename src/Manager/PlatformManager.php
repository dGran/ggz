<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Platform;
use App\Repository\PlatformRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class PlatformManager
{
    protected EntityManagerInterface $entityManager;
    protected PlatformRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Platform::class);
    }

    public function create(): Platform
    {
        return new Platform();
    }

    public function save($platform): Platform
    {
        $this->entityManager->persist($platform);
        $this->entityManager->flush();

        return $platform;
    }

    public function delete(Platform $platform): Platform
    {
        $this->entityManager->remove($platform);
        $this->entityManager->flush();

        return $platform;
    }

    public function findOneById($id): ?Platform
    {
        /** @var Platform $platform */
        $platform = $this->repository->find($id);

        return $platform;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Platform
    {
        /** @var Platform $platform */
        $platform = $this->repository->findOneBy($criteria, $orderBy);

        return $platform;
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
     * @param Platform[] $platforms
     *
     * @return Platform[]
     */
    public function saveCollection(array $platforms): array
    {
        foreach ($platforms as $platform) {
            $this->entityManager->persist($platform);
        }

        $this->entityManager->flush();

        return $platforms;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByNameAndTypeNameAndFamilyNameAndCompanyName(string $name): ?Platform
    {
        return $this->repository->findByName($name);
    }
}