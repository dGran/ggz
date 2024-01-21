<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isEmailAvailable(string $email, ?int $userId = null): bool
    {
        $qb = $this->createQueryBuilder('user')
            ->select('COUNT(user.id)')
            ->where('user.email = :email')
            ->setParameter('email', $email);

        if ($userId !== null) {
            $qb->andWhere('user.id != :user_id')
                ->setParameter('user_id', $userId);
        }

        $count = $qb->getQuery()->getSingleScalarResult();

        return $count === 0;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isNicknameAvailable(string $nickname, ?int $userId = null): bool
    {
        $qb = $this->createQueryBuilder('user')
            ->select('COUNT(user.id)')
            ->where('user.nickname = :nickname')
            ->setParameter('nickname', $nickname);

        if ($userId !== null) {
            $qb->andWhere('user.id != :user_id')
                ->setParameter('user_id', $userId);
        }

        $count = $qb->getQuery()->getSingleScalarResult();

        return $count === 0;
    }

    /**
     * @return User[]
     */
    public function findUnverifiedAndVerificationTimeExceeded(): array
    {
        $maxTimeToVerify = (new \DateTime())->modify('-'.User::VERIFICATION_ACCOUNT_MAX_TIME.' hours');

        return $this->createQueryBuilder('user')
            ->where('user.verified = 0')
            ->andWhere('user.dateCreated <= :max_time_to_verify')
            ->setParameter('max_time_to_verify', $maxTimeToVerify)
            ->getQuery()
            ->getResult();
    }
}
