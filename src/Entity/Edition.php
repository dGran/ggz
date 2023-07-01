<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $originalName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?bool $locked = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRelease = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLastUpdate = null;

    #[ORM\ManyToOne(inversedBy: 'editions')]
    private ?ContributionState $contributionState = null;

    #[ORM\ManyToOne(inversedBy: 'editions')]
    private ?Genre $genre = null;

    #[ORM\ManyToOne(inversedBy: 'editions')]
    private ?NumberOfPlayers $numberOfPlayers = null;

    #[ORM\ManyToOne(inversedBy: 'editions')]
    private ?Region $region = null;

    #[ORM\ManyToOne]
    private ?Country $country = null;

    #[ORM\ManyToOne]
    private ?Language $language = null;

    #[ORM\ManyToOne]
    private ?Platform $platform = null;

    #[ORM\ManyToOne(inversedBy: 'editions')]
    private ?Serie $serie = null;

    #[ORM\ManyToOne]
    private ?Company $developerCompany = null;

    #[ORM\ManyToOne]
    private ?Company $publisherCompany = null;

    #[ORM\ManyToOne(inversedBy: 'editions')]
    private ?Universe $universe = null;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): static
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function isLocked(): ?bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): static
    {
        $this->locked = $locked;

        return $this;
    }

    public function getDateRelease(): ?\DateTimeInterface
    {
        return $this->dateRelease;
    }

    public function setDateRelease(?\DateTimeInterface $dateRelease): static
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateLastUpdate(): ?\DateTimeInterface
    {
        return $this->dateLastUpdate;
    }

    public function setDateLastUpdate(?\DateTimeInterface $dateLastUpdate): static
    {
        $this->dateLastUpdate = $dateLastUpdate;

        return $this;
    }

    public function getContributionState(): ?ContributionState
    {
        return $this->contributionState;
    }

    public function setContributionState(?ContributionState $contributionState): static
    {
        $this->contributionState = $contributionState;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getNumberOfPlayers(): ?NumberOfPlayers
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers(?NumberOfPlayers $numberOfPlayers): static
    {
        $this->numberOfPlayers = $numberOfPlayers;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDeveloperCompany(): ?Company
    {
        return $this->developerCompany;
    }

    public function setDeveloperCompany(?Company $developerCompany): static
    {
        $this->developerCompany = $developerCompany;

        return $this;
    }

    public function getPublisherCompany(): ?Company
    {
        return $this->publisherCompany;
    }

    public function setPublisherCompany(?Company $publisherCompany): static
    {
        $this->publisherCompany = $publisherCompany;

        return $this;
    }

    public function getUniverse(): ?Universe
    {
        return $this->universe;
    }

    public function setUniverse(?Universe $universe): static
    {
        $this->universe = $universe;

        return $this;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): Edition
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTime $dateUpdated): Edition
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
