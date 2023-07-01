<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ListType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListType>
 *
 * @method ListType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListType[]    findAll()
 * @method ListType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListType::class);
    }
}
