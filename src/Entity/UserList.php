<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserListRepository::class)]
#[UniqueEntity(fields: ['user', 'type', 'edition'], message: 'This edition already exists in the list.')]
class UserList
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userLists')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ListType $type;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Edition $edition;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $dateCreated;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): UserList
    {
        $this->user = $user;

        return $this;
    }

    public function getType(): ListType
    {
        return $this->type;
    }

    public function setType(ListType $type): UserList
    {
        $this->type = $type;

        return $this;
    }

    public function getEdition(): Edition
    {
        return $this->edition;
    }

    public function setEdition(Edition $edition): UserList
    {
        $this->edition = $edition;

        return $this;
    }

    public function getDateCreated(): \DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): UserList
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}
