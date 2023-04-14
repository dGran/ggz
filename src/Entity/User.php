<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $nickname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $socialCredentials = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rememberToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $resetPasswordExpires = null;

    #[ORM\Column(nullable: true)]
    private ?bool $marketingMailing = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Currency $currency = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Country $country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getProfilePic(): ?string
    {
        return $this->profilePic;
    }

    public function setProfilePic(?string $profilePic): self
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    public function getSocialCredentials(): ?string
    {
        return $this->socialCredentials;
    }

    public function setSocialCredentials(?string $socialCredentials): self
    {
        $this->socialCredentials = $socialCredentials;

        return $this;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function setRememberToken(?string $rememberToken): self
    {
        $this->rememberToken = $rememberToken;

        return $this;
    }

    public function getResetPasswordExpires(): ?\DateTimeInterface
    {
        return $this->resetPasswordExpires;
    }

    public function setResetPasswordExpires(?\DateTimeInterface $resetPasswordExpires): self
    {
        $this->resetPasswordExpires = $resetPasswordExpires;

        return $this;
    }

    public function isMarketingMailing(): ?bool
    {
        return $this->marketingMailing;
    }

    public function setMarketingMailing(?bool $marketingMailing): self
    {
        $this->marketingMailing = $marketingMailing;

        return $this;
    }

    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    public function setCurrency(?Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
