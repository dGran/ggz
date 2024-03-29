<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(length: 50, unique: true)]
    protected string $nameCanonical;

    #[ORM\Column(length: 10, unique: true)]
    protected string $isoCode;

    #[ORM\Column(precision: 10, scale: 0, nullable: true)]
    protected ?float $conversionRate = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNameCanonical(): string
    {
        return $this->nameCanonical;
    }

    public function setNameCanonical(string $nameCanonical): Currency
    {
        $this->nameCanonical = $nameCanonical;

        return $this;
    }

    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): Currency
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function getConversionRate(): ?float
    {
        return $this->conversionRate;
    }

    public function setConversionRate(?float $conversionRate): Currency
    {
        $this->conversionRate = $conversionRate;

        return $this;
    }

    public function __toString()
    {
        return $this->isoCode;
    }
}
