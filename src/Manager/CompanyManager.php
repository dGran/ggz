<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class CompanyManager
{
    protected EntityManagerInterface $entityManager;
    protected CompanyRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Company::class);
    }

    public function create(): Company
    {
        return new Company();
    }

    public function save($company): Company
    {
        $this->entityManager->persist($company);
        $this->entityManager->flush();

        return $company;
    }

    public function delete(Company $company): Company
    {
        $this->entityManager->remove($company);
        $this->entityManager->flush();

        return $company;
    }

    public function findOneById($id): ?Company
    {
        /** @var Company $company */
        $company = $this->repository->find($id);

        return $company;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Company
    {
        /** @var Company $company */
        $company = $this->repository->findOneBy($criteria, $orderBy);

        return $company;
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
     * @param Company[] $companies
     *
     * @return Company[]
     */
    public function saveCollection(array $companies): array
    {
        foreach ($companies as $company) {
            $this->entityManager->persist($company);
        }

        $this->entityManager->flush();

        return $companies;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): ?Company
    {
        return $this->repository->findByName($name);
    }
}