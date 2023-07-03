<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
    public const PICTURE_PATH = 'img/editions/';
    public const DEFAULT_PICTURE = 'no-image.png';

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

    #[ORM\Column(options: ['default' => false])]
    private bool $locked = false;

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

    public function setName(string $name): Edition
    {
        $this->name = $name;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): Edition
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Edition
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): Edition
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPicturePath(): string
    {
        return $this->picture ? self::PICTURE_PATH.$this->picture : self::PICTURE_PATH.self::DEFAULT_PICTURE;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): Edition
    {
        $this->locked = $locked;

        return $this;
    }

    public function getDateRelease(): ?\DateTimeInterface
    {
        return $this->dateRelease;
    }

    public function setDateRelease(?\DateTimeInterface $dateRelease): Edition
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $dateCreation): Edition
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateLastUpdate(): ?\DateTimeInterface
    {
        return $this->dateLastUpdate;
    }

    public function setDateLastUpdate(?\DateTimeInterface $dateLastUpdate): Edition
    {
        $this->dateLastUpdate = $dateLastUpdate;

        return $this;
    }

    public function getContributionState(): ?ContributionState
    {
        return $this->contributionState;
    }

    public function setContributionState(?ContributionState $contributionState): Edition
    {
        $this->contributionState = $contributionState;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): Edition
    {
        $this->genre = $genre;

        return $this;
    }

    public function getNumberOfPlayers(): ?NumberOfPlayers
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers(?NumberOfPlayers $numberOfPlayers): Edition
    {
        $this->numberOfPlayers = $numberOfPlayers;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): Edition
    {
        $this->region = $region;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): Edition
    {
        $this->country = $country;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): Edition
    {
        $this->language = $language;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): Edition
    {
        $this->platform = $platform;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): Edition
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDeveloperCompany(): ?Company
    {
        return $this->developerCompany;
    }

    public function setDeveloperCompany(?Company $developerCompany): Edition
    {
        $this->developerCompany = $developerCompany;

        return $this;
    }

    public function getPublisherCompany(): ?Company
    {
        return $this->publisherCompany;
    }

    public function setPublisherCompany(?Company $publisherCompany): Edition
    {
        $this->publisherCompany = $publisherCompany;

        return $this;
    }

    public function getUniverse(): ?Universe
    {
        return $this->universe;
    }

    public function setUniverse(?Universe $universe): Edition
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
