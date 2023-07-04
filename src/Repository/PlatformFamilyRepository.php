<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PlatformFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlatformFamily>
 *
 * @method PlatformFamily|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatformFamily|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatformFamily[]    findAll()
 * @method PlatformFamily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformFamilyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatformFamily::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): ?PlatformFamily
    {
        return $this->createQueryBuilder('platform_family')
            ->where('platform_family.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
