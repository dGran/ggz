<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Edition;
use App\Entity\ListType;
use App\Entity\User;
use App\Entity\UserList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
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

    /**
     * @return UserList[]
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('user_list')
            ->where('user_list.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return UserList[]
     */
    public function findEditionsByUserAndListType(int $userId, int $listTypeId): array
    {
        return $this->createQueryBuilder('user_list')
            ->select('user_list')
            ->where('user_list.user = :user')
            ->andWhere('user_list.type = :list_type')
            ->setParameter('user', $userId)
            ->setParameter('list_type', $listTypeId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByUserAndEditionAndListType(User $user, Edition $edition, ListType $listType): ?UserList
    {
        return $this->createQueryBuilder('user_list')
            ->where('user_list.user = :user')
            ->andWhere('user_list.edition = :edition')
            ->andWhere('user_list.type = :list_type')
            ->setParameter('user', $user)
            ->setParameter('edition', $edition)
            ->setParameter('list_type', $listType)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
