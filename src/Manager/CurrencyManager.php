<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyManager
{
    protected EntityManagerInterface $entityManager;
    protected CurrencyRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Currency::class);
    }

    public function create(): Currency
    {
        return new Currency();
    }

    public function save($currency): Currency
    {
        $this->entityManager->persist($currency);
        $this->entityManager->flush();

        return $currency;
    }

    public function delete(Currency $currency): Currency
    {
        $this->entityManager->remove($currency);
        $this->entityManager->flush();

        return $currency;
    }

    public function findOneById($id): ?Currency
    {
        /** @var Currency $currency */
        $currency = $this->repository->find($id);

        return $currency;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Currency
    {
        /** @var Currency $currency */
        $currency = $this->repository->findOneBy($criteria, $orderBy);

        return $currency;
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