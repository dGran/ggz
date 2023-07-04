<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Platform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Platform>
 *
 * @method Platform|null find($id, $lockMode = null, $lockVersion = null)
 * @method Platform|null findOneBy(array $criteria, array $orderBy = null)
 * @method Platform[]    findAll()
 * @method Platform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Platform::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByName(string $name): ?Platform
    {
        return $this->createQueryBuilder('platform')
            ->where('platform.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
