<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserList>
 *
 * @method UserList|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserList|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserList[]    findAll()
 * @method UserList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserList::class);
    }
}
