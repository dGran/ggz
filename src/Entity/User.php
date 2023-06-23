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
    private const SHARE_CONTENT_ENUM = "ENUM('".self::SHARE_CONTENT_EVERYBODY."', '".self::SHARE_CONTENT_FRIENDS_ONLY."', '".self::SHARE_CONTENT_NOBODY."')";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 30, unique: true, nullable: true)]
    private ?string $nickname = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private string $password;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $birthdate;

    #[ORM\Column(nullable: true)]
    private ?string $profilePic = null;

    #[ORM\Column(type: "string", nullable: true, columnDefinition: self::SHARE_CONTENT_ENUM)]
    private ?string $shareContent = null;

    #[ORM\Column]
    private bool $onBoardingComplete = false;

    #[ORM\Column]
    private bool $acceptMailing = false;

    #[ORM\Column]
    private bool $isVerified = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
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

    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
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

    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function getProfilePic(): ?string
    {
        return $this->profilePic;
    }

    public function setProfilePic(?string $profilePic): void
    {
        $this->profilePic = $profilePic;
    }

    public function getProfilePicPath(): ?string
    {
        return self::PROFILE_PIC_PATH.$this->profilePic;
    }

    public function getShareContent(): ?string
    {
        return $this->shareContent;
    }

    public function setShareContent(?string $shareContent): void
    {
        $this->shareContent = $shareContent;
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

    public function setOnBoardingComplete(bool $onBoardingComplete): void
    {
        $this->onBoardingComplete = $onBoardingComplete;
    }

    public function isAcceptMailing(): bool
    {
        return $this->acceptMailing;
    }

    public function setAcceptMailing(bool $acceptMailing): void
    {
        $this->acceptMailing = $acceptMailing;
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
}
