<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatformRepository::class)]
class Platform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $alternateName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRelease = null;

    #[ORM\Column(nullable: true)]
    private ?int $generation = null;

    #[ORM\Column]
    private ?bool $locked = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $links = null;

    #[ORM\ManyToOne(inversedBy: 'platforms')]
    private ?PlatformType $type = null;

    #[ORM\ManyToOne(inversedBy: 'platforms')]
    private ?PlatformFamily $platformFamily = null;

    #[ORM\ManyToOne(inversedBy: 'platforms')]
    private ?Company $company = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Platform
    {
        $this->name = $name;

        return $this;
    }

    public function getAlternateName(): ?string
    {
        return $this->alternateName;
    }

    public function setAlternateName(?string $alternateName): Platform
    {
        $this->alternateName = $alternateName;

        return $this;
    }

    public function getDateRelease(): ?\DateTimeInterface
    {
        return $this->dateRelease;
    }

    public function setDateRelease(?\DateTimeInterface $dateRelease): Platform
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(?int $generation): Platform
    {
        $this->generation = $generation;

        return $this;
    }

    public function isLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): Platform
    {
        $this->locked = $locked;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): Platform
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Platform
    {
        $this->description = $description;

        return $this;
    }

    public function getLinks(): ?string
    {
        return $this->links;
    }

    public function setLinks(?string $links): Platform
    {
        $this->links = $links;

        return $this;
    }

    public function getType(): ?PlatformType
    {
        return $this->type;
    }

    public function setType(?PlatformType $type): Platform
    {
        $this->type = $type;

        return $this;
    }

    public function getPlatformFamily(): ?PlatformFamily
    {
        return $this->platformFamily;
    }

    public function setPlatformFamily(?PlatformFamily $platformFamily): Platform
    {
        $this->platformFamily = $platformFamily;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): Platform
    {
        $this->company = $company;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
