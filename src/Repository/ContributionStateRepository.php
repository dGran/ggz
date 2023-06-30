<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ContributionState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContributionState>
 *
 * @method ContributionState|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContributionState|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContributionState[]    findAll()
 * @method ContributionState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContributionStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContributionState::class);
    }
}
