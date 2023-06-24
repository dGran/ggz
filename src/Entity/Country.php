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

    #[ORM\Column]
    protected bool $active = false;

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

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): Country
    {
        $this->active = $active;

        return $this;
    }

    public function __toString()
    {
        return $this->isoCode;
    }
}
