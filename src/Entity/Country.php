<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(length: 50, unique: true)]
    protected string $nameCanonical;

    #[ORM\Column(length: 10, unique: true)]
    protected string $isoCode;

    #[ORM\Column(length: 10)]
    protected string $languageIsoCode;

    #[ORM\Column(nullable: true)]
    protected ?string $countryZoneName = null;

    #[ORM\Column]
    protected \DateTime $dateCreated;

    #[ORM\Column(nullable: true)]
    protected ?\DateTime $dateUpdated;

    public function __construct()
    {
        $this->dateCreated = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNameCanonical(): string
    {
        return $this->nameCanonical;
    }

    public function setNameCanonical(string $nameCanonical): Country
    {
        $this->nameCanonical = $nameCanonical;

        return $this;
    }

    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): Country
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function getLanguageIsoCode(): string
    {
        return $this->languageIsoCode;
    }

    public function setLanguageIsoCode(string $languageIsoCode): void
    {
        $this->languageIsoCode = $languageIsoCode;
    }

    public function getCountryZoneName(): ?string
    {
        return $this->countryZoneName;
    }

    public function setCountryZoneName(?string $countryZoneName): void
    {
        $this->countryZoneName = $countryZoneName;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }

    public function __toString()
    {
        return $this->isoCode;
    }
}
