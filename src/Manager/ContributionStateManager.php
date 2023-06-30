<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\ContributionState;
use App\Repository\ContributionStateRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContributionStateManager
{
    protected EntityManagerInterface $entityManager;
    protected ContributionStateRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(ContributionState::class);
    }

    public function create(): ContributionState
    {
        return new ContributionState();
    }

    public function save($contributionState): ContributionState
    {
        $this->entityManager->persist($contributionState);
        $this->entityManager->flush();

        return $contributionState;
    }

    public function delete(ContributionState $contributionState): ContributionState
    {
        $this->entityManager->remove($contributionState);
        $this->entityManager->flush();

        return $contributionState;
    }

    public function findOneById($id): ?ContributionState
    {
        /** @var ContributionState $contributionState */
        $contributionState = $this->repository->find($id);

        return $contributionState;
    }

    public function findOneBy(array $criteria, array $orderBy = null): ContributionState
    {
        /** @var ContributionState $contributionState */
        $contributionState = $this->repository->findOneBy($criteria, $orderBy);

        return $contributionState;
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
     * @param ContributionState[] $contributionStates
     *
     * @return ContributionState[]
     */
    public function saveCollection(array $contributionStates): array
    {
        foreach ($contributionStates as $contributionState) {
            $this->entityManager->persist($contributionState);
        }

        $this->entityManager->flush();

        return $contributionStates;
    }
}