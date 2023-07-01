<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Edition;
use App\Repository\EditionRepository;
use Doctrine\ORM\EntityManagerInterface;

class EditionManager
{
    protected EntityManagerInterface $entityManager;
    protected EditionRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Edition::class);
    }

    public function create(): Edition
    {
        return new Edition();
    }

    public function save($edition): Edition
    {
        $this->entityManager->persist($edition);
        $this->entityManager->flush();

        return $edition;
    }

    public function delete(Edition $edition): Edition
    {
        $this->entityManager->remove($edition);
        $this->entityManager->flush();

        return $edition;
    }

    public function findOneById($id): ?Edition
    {
        /** @var Edition $edition */
        $edition = $this->repository->find($id);

        return $edition;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Edition
    {
        /** @var Edition $edition */
        $edition = $this->repository->findOneBy($criteria, $orderBy);

        return $edition;
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
     * @param Edition[] $editions
     *
     * @return Edition[]
     */
    public function saveCollection(array $editions): array
    {
        foreach ($editions as $edition) {
            $this->entityManager->persist($edition);
        }

        $this->entityManager->flush();

        return $editions;
    }
}