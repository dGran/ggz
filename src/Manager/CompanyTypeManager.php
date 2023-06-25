<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\CompanyType;
use App\Repository\CompanyTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class CompanyTypeManager
{
    protected EntityManagerInterface $entityManager;
    protected CompanyTypeRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(CompanyType::class);
    }

    public function create(): CompanyType
    {
        return new CompanyType();
    }

    public function save($companyType): CompanyType
    {
        $this->entityManager->persist($companyType);
        $this->entityManager->flush();

        return $companyType;
    }

    public function delete(CompanyType $companyType): CompanyType
    {
        $this->entityManager->remove($companyType);
        $this->entityManager->flush();

        return $companyType;
    }

    public function findOneById($id): ?CompanyType
    {
        /** @var CompanyType $companyType */
        $companyType = $this->repository->find($id);

        return $companyType;
    }

    public function findOneBy(array $criteria, array $orderBy = null): CompanyType
    {
        /** @var CompanyType $companyType */
        $companyType = $this->repository->findOneBy($criteria, $orderBy);

        return $companyType;
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
     * @param CompanyType[] $companyTypes
     *
     * @return CompanyType[]
     */
    public function saveCollection(array $companyTypes): array
    {
        foreach ($companyTypes as $companyType) {
            $this->entityManager->persist($companyType);
        }

        $this->entityManager->flush();

        return $companyTypes;
    }
}