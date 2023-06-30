<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;

class GenreManager
{
    protected EntityManagerInterface $entityManager;
    protected GenreRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Genre::class);
    }

    public function create(): Genre
    {
        return new Genre();
    }

    public function save($genre): Genre
    {
        $this->entityManager->persist($genre);
        $this->entityManager->flush();

        return $genre;
    }

    public function delete(Genre $genre): Genre
    {
        $this->entityManager->remove($genre);
        $this->entityManager->flush();

        return $genre;
    }

    public function findOneById($id): ?Genre
    {
        /** @var Genre $genre */
        $genre = $this->repository->find($id);

        return $genre;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Genre
    {
        /** @var Genre $genre */
        $genre = $this->repository->findOneBy($criteria, $orderBy);

        return $genre;
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
     * @param Genre[] $genres
     *
     * @return Genre[]
     */
    public function saveCollection(array $genres): array
    {
        foreach ($genres as $genre) {
            $this->entityManager->persist($genre);
        }

        $this->entityManager->flush();

        return $genres;
    }
}