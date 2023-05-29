<?php

namespace App\Entity;

use App\Entity\ToReview\AccountType;
use App\Entity\ToReview\Country;
use App\Entity\ToReview\Currency;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="IDX_8D93D64938248176", columns={"currency_id"}), @ORM\Index(name="IDX_8D93D649F92F3E70", columns={"country_id"}), @ORM\Index(name="pk_user_account_type_idx", columns={"user_account_type"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nickname", type="string", length=60, nullable=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="profile_pic", type="string", length=255, nullable=true)
     */
    private $profilePic;

    /**
     * @var string|null
     *
     * @ORM\Column(name="social_credentials", type="string", length=255, nullable=true)
     */
    private $socialCredentials;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remember_token", type="string", length=255, nullable=true)
     */
    private $rememberToken;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reset_password_expires", type="datetime", nullable=true)
     */
    private $resetPasswordExpires;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="marketing_mailing", type="boolean", nullable=true)
     */
    private $marketingMailing;

    /**
     * @var \AccountType
     *
     * @ORM\ManyToOne(targetEntity="AccountType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_account_type", referencedColumnName="idaccount_type")
     * })
     */
    private $userAccountType;

    /**
     * @var \Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     * })
     */
    private $currency;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

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

    public function getUserAccountType(): ?AccountType
    {
        return $this->userAccountType;
    }

    public function setUserAccountType(?AccountType $userAccountType): self
    {
        $this->userAccountType = $userAccountType;

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
