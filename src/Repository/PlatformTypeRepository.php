<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PlatformType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlatformType>
 *
 * @method PlatformType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlatformType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlatformType[]    findAll()
 * @method PlatformType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlatformType::class);
    }
}
