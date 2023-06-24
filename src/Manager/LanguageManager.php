<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Language;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

class LanguageManager
{
    protected EntityManagerInterface $entityManager;
    protected LanguageRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Language::class);
    }

    public function create(): Language
    {
        return new Language();
    }

    public function save($language): Language
    {
        $this->entityManager->persist($language);
        $this->entityManager->flush();

        return $language;
    }

    public function delete(Language $language): Language
    {
        $this->entityManager->remove($language);
        $this->entityManager->flush();

        return $language;
    }

    public function findOneById($id): ?Language
    {
        /** @var Language $language */
        $language = $this->repository->find($id);

        return $language;
    }

    public function findOneBy(array $criteria, array $orderBy = null): Language
    {
        /** @var Language $language */
        $language = $this->repository->findOneBy($criteria, $orderBy);

        return $language;
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
     * @param Language[] $languages
     *
     * @return Language[]
     */
    public function saveCollection(array $languages): array
    {
        foreach ($languages as $language) {
            $this->entityManager->persist($language);
        }

        $this->entityManager->flush();

        return $languages;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByIsoCode(string $isoCode): ?Language
    {
        return $this->repository->findByIsoCode($isoCode);
    }
}