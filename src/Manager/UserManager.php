<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class UserManager
{
    protected EntityManagerInterface $entityManager;
    protected UserRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function create(): User
    {
        return new User();
    }

    public function save($user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function update($user): User
    {
        $user->setDateUpdated(new \DateTime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function delete(User $user): User
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return $user;
    }

    public function findOneById($id): ?User
    {
        /** @var User $user */
        $user = $this->repository->find($id);

        return $user;
    }

    public function findOneBy(array $criteria, array $orderBy = null): User
    {
        /** @var User $user */
        $user = $this->repository->findOneBy($criteria, $orderBy);

        return $user;
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
     * @return User[]|null
     */
    public function findByEmail(string $email): ?array
    {
        return $this->repository->findByEmail($email);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isNicknameAvailable(string $nickname, ?int $userId = null): bool
    {
        return $this->repository->isNicknameAvailable($nickname, $userId);
    }

    /**
     * @return User[]
     */
    public function findUnverifiedAndVerificationTimeExceeded(): array
    {
        return $this->repository->findUnverifiedAndVerificationTimeExceeded();
    }
}