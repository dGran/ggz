<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column]
    protected int $id;

    #[ORM\Column(length: 25)]
    protected string $name;

    #[ORM\Column(length: 10, unique: true, nullable: true)]
    protected ?string $isoCode = null;

    #[ORM\ManyToMany(targetEntity: Currency::class, inversedBy: 'Language')]
    protected Collection $currencies;

    public function __construct()
    {
        $this->currencies = new ArrayCollection();
        $this->dateCreated = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Language
    {
        $this->name = $name;

        return $this;
    }

    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): Language
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function getCurrencies(): Collection
    {
        return $this->currencies;
    }

    public function setCurrencies(ArrayCollection $currencies): Language
    {
        $this->currencies = $currencies;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
