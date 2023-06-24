<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CountryManager
{
    protected EntityManagerInterface $entityManager;
    protected CountryRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Country::class);
    }

    public function create(): Country
    {
        return new Country();
    }

    public function save($country): Country
    {
        $this->entityManager->persist($country);
        $this->entityManager->flush();

        return $country;
    }

    public function delete(Country $country): Country
    {
        $this->entityManager->remove($country);
        $this->entityManager->flush();

        return $country;
    }

    public function findOneById($id): ?Country
    {
        /** @var Country $country */
        $country = $this->repository->find($id);

        return $country;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Country
    {
        /** @var Country $country */
        $country = $this->repository->findOneBy($criteria, $orderBy);

        return $country;
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