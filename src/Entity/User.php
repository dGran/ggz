<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const PROFILE_PIC_PATH = 'img/user/profile/';
    public const SHARE_CONTENT_EVERYBODY = "Everybody";
    public const SHARE_CONTENT_FRIENDS_ONLY = "Friends only";
    public const SHARE_CONTENT_NOBODY = "Nobody";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(length: 180, unique: true)]
    protected string $email;

    #[ORM\Column]
    protected string $password;

    #[ORM\Column(length: 30, unique: true, nullable: true)]
    protected ?string $nickname = null;

    #[ORM\Column]
    protected array $roles = [];

    #[ORM\Column(nullable: true)]
    protected ?\DateTime $birthdate;

    #[ORM\Column(nullable: true)]
    protected ?string $profilePic = null;

    #[ORM\Column(nullable: true)]
    protected ?string $shareContent = null;

    #[ORM\Column]
    protected bool $onBoardingComplete = false;

    #[ORM\Column]
    protected bool $acceptMailing = false;

    #[ORM\Column]
    protected bool $isVerified = false;

    #[ORM\Column]
    protected \DateTime $dateCreated;

    #[ORM\Column(nullable: true)]
    protected ?\DateTime $dateUpdated;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): User
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return \array_unique($roles);
    }

    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTime $birthdate): User
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getProfilePic(): ?string
    {
        return $this->profilePic;
    }

    public function setProfilePic(?string $profilePic): User
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    public function getProfilePicPath(): ?string
    {
        return self::PROFILE_PIC_PATH.$this->profilePic;
    }

    public function getShareContent(): ?string
    {
        return $this->shareContent;
    }

    public function setShareContent(?string $shareContent): User
    {
        $this->shareContent = $shareContent;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isOnBoardingComplete(): bool
    {
        return $this->onBoardingComplete;
    }

    public function setOnBoardingComplete(bool $onBoardingComplete): User
    {
        $this->onBoardingComplete = $onBoardingComplete;

        return $this;
    }

    public function isAcceptMailing(): bool
    {
        return $this->acceptMailing;
    }

    public function setAcceptMailing(bool $acceptMailing): User
    {
        $this->acceptMailing = $acceptMailing;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): User
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): User
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTime $dateUpdated): User
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}
