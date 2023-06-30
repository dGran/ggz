<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NumberOfPlayers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NumberOfPlayers>
 *
 * @method NumberOfPlayers|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumberOfPlayers|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumberOfPlayers[]    findAll()
 * @method NumberOfPlayers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberOfPlayersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumberOfPlayers::class);
    }
}
