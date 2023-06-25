<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\PlatformType;
use App\Repository\PlatformTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlatformTypeManager
{
    protected EntityManagerInterface $entityManager;
    protected PlatformTypeRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(PlatformType::class);
    }

    public function create(): PlatformType
    {
        return new PlatformType();
    }

    public function save($platformType): PlatformType
    {
        $this->entityManager->persist($platformType);
        $this->entityManager->flush();

        return $platformType;
    }

    public function delete(PlatformType $platformType): PlatformType
    {
        $this->entityManager->remove($platformType);
        $this->entityManager->flush();

        return $platformType;
    }

    public function findOneById($id): ?PlatformType
    {
        /** @var PlatformType $platformType */
        $platformType = $this->repository->find($id);

        return $platformType;
    }

    public function findOneBy(array $criteria, array $orderBy = null): PlatformType
    {
        /** @var PlatformType $platformType */
        $platformType = $this->repository->findOneBy($criteria, $orderBy);

        return $platformType;
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
     * @param PlatformType[] $platformTypes
     *
     * @return PlatformType[]
     */
    public function saveCollection(array $platformTypes): array
    {
        foreach ($platformTypes as $platformType) {
            $this->entityManager->persist($platformType);
        }

        $this->entityManager->flush();

        return $platformTypes;
    }
}