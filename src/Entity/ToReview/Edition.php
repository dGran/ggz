<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edition
 *
 * @ORM\Table(name="edition", indexes={@ORM\Index(name="fk_edition_contribution_state_id_idx", columns={"edition_contribution_state_id"}), @ORM\Index(name="fk_edition_number_of_players_id_idx", columns={"edition_number_of_players_id"}), @ORM\Index(name="fk_edition_genre_id_idx", columns={"edition_genre_id"}), @ORM\Index(name="fk_edition_country_id_idx", columns={"edition_country_id"}), @ORM\Index(name="fk_edition_universe_id_idx", columns={"edition_universe_id"}), @ORM\Index(name="fk_edition_platform_id_idx", columns={"edition_platform_id"}), @ORM\Index(name="fk_edition_developer_id_idx", columns={"edition_developer_id"}), @ORM\Index(name="fk_edition_master_id_idx", columns={"edition_master_id"}), @ORM\Index(name="fk_edition_series_id_idx", columns={"edition_series_id"}), @ORM\Index(name="fk_edition_language_id_idx", columns={"edition_language_id"}), @ORM\Index(name="fk_edition_publisher_id_idx", columns={"edition_publisher_id"}), @ORM\Index(name="fk_edition_region_id_idx", columns={"edition_region_id"})})
 * @ORM\Entity
 */
class Edition
{
    /**
     * @var int
     *
     * @ORM\Column(name="idedition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idedition;

    /**
     * @var string
     *
     * @ORM\Column(name="edition_name", type="string", length=255, nullable=false)
     */
    private $editionName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="edition_original_name", type="string", length=255, nullable=true)
     */
    private $editionOriginalName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="edition_picture", type="string", length=255, nullable=true)
     */
    private $editionPicture;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="edition_release_date", type="date", nullable=true)
     */
    private $editionReleaseDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="edition_description", type="string", length=255, nullable=true)
     */
    private $editionDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="edition_locked", type="boolean", nullable=false)
     */
    private $editionLocked;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="edition_creation_date", type="date", nullable=true)
     */
    private $editionCreationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="edition_latest_update", type="date", nullable=true)
     */
    private $editionLatestUpdate;

    /**
     * @var \ContributionState
     *
     * @ORM\ManyToOne(targetEntity="ContributionState")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_contribution_state_id", referencedColumnName="idcontribution_state")
     * })
     */
    private $editionContributionState;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_genre_id", referencedColumnName="idgenre")
     * })
     */
    private $editionGenre;

    /**
     * @var \NumberOfPlayers
     *
     * @ORM\ManyToOne(targetEntity="NumberOfPlayers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_number_of_players_id", referencedColumnName="idnumber_of_players")
     * })
     */
    private $editionNumberOfPlayers;

    /**
     * @var \Region
     *
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_region_id", referencedColumnName="idregion")
     * })
     */
    private $editionRegion;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_country_id", referencedColumnName="id")
     * })
     */
    private $editionCountry;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_language_id", referencedColumnName="id")
     * })
     */
    private $editionLanguage;

    /**
     * @var \Platform
     *
     * @ORM\ManyToOne(targetEntity="Platform")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_platform_id", referencedColumnName="idplatform")
     * })
     */
    private $editionPlatform;

    /**
     * @var \Series
     *
     * @ORM\ManyToOne(targetEntity="Series")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_series_id", referencedColumnName="idseries")
     * })
     */
    private $editionSeries;

    /**
     * @var \Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_developer_id", referencedColumnName="idcompany")
     * })
     */
    private $editionDeveloper;

    /**
     * @var \Master
     *
     * @ORM\ManyToOne(targetEntity="Master")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_master_id", referencedColumnName="idmaster")
     * })
     */
    private $editionMaster;

    /**
     * @var \Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_publisher_id", referencedColumnName="idcompany")
     * })
     */
    private $editionPublisher;

    /**
     * @var \Universe
     *
     * @ORM\ManyToOne(targetEntity="Universe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edition_universe_id", referencedColumnName="iduniverse")
     * })
     */
    private $editionUniverse;

    public function getIdedition(): ?int
    {
        return $this->idedition;
    }

    public function getEditionName(): ?string
    {
        return $this->editionName;
    }

    public function setEditionName(string $editionName): self
    {
        $this->editionName = $editionName;

        return $this;
    }

    public function getEditionOriginalName(): ?string
    {
        return $this->editionOriginalName;
    }

    public function setEditionOriginalName(?string $editionOriginalName): self
    {
        $this->editionOriginalName = $editionOriginalName;

        return $this;
    }

    public function getEditionPicture(): ?string
    {
        return $this->editionPicture;
    }

    public function setEditionPicture(?string $editionPicture): self
    {
        $this->editionPicture = $editionPicture;

        return $this;
    }

    public function getEditionReleaseDate(): ?\DateTimeInterface
    {
        return $this->editionReleaseDate;
    }

    public function setEditionReleaseDate(?\DateTimeInterface $editionReleaseDate): self
    {
        $this->editionReleaseDate = $editionReleaseDate;

        return $this;
    }

    public function getEditionDescription(): ?string
    {
        return $this->editionDescription;
    }

    public function setEditionDescription(?string $editionDescription): self
    {
        $this->editionDescription = $editionDescription;

        return $this;
    }

    public function isEditionLocked(): ?bool
    {
        return $this->editionLocked;
    }

    public function setEditionLocked(bool $editionLocked): self
    {
        $this->editionLocked = $editionLocked;

        return $this;
    }

    public function getEditionCreationDate(): ?\DateTimeInterface
    {
        return $this->editionCreationDate;
    }

    public function setEditionCreationDate(?\DateTimeInterface $editionCreationDate): self
    {
        $this->editionCreationDate = $editionCreationDate;

        return $this;
    }

    public function getEditionLatestUpdate(): ?\DateTimeInterface
    {
        return $this->editionLatestUpdate;
    }

    public function setEditionLatestUpdate(?\DateTimeInterface $editionLatestUpdate): self
    {
        $this->editionLatestUpdate = $editionLatestUpdate;

        return $this;
    }

    public function getEditionContributionState(): ?ContributionState
    {
        return $this->editionContributionState;
    }

    public function setEditionContributionState(?ContributionState $editionContributionState): self
    {
        $this->editionContributionState = $editionContributionState;

        return $this;
    }

    public function getEditionGenre(): ?Genre
    {
        return $this->editionGenre;
    }

    public function setEditionGenre(?Genre $editionGenre): self
    {
        $this->editionGenre = $editionGenre;

        return $this;
    }

    public function getEditionNumberOfPlayers(): ?NumberOfPlayers
    {
        return $this->editionNumberOfPlayers;
    }

    public function setEditionNumberOfPlayers(?NumberOfPlayers $editionNumberOfPlayers): self
    {
        $this->editionNumberOfPlayers = $editionNumberOfPlayers;

        return $this;
    }

    public function getEditionRegion(): ?Region
    {
        return $this->editionRegion;
    }

    public function setEditionRegion(?Region $editionRegion): self
    {
        $this->editionRegion = $editionRegion;

        return $this;
    }

    public function getEditionCountry(): ?Country
    {
        return $this->editionCountry;
    }

    public function setEditionCountry(?Country $editionCountry): self
    {
        $this->editionCountry = $editionCountry;

        return $this;
    }

    public function getEditionLanguage(): ?Language
    {
        return $this->editionLanguage;
    }

    public function setEditionLanguage(?Language $editionLanguage): self
    {
        $this->editionLanguage = $editionLanguage;

        return $this;
    }

    public function getEditionPlatform(): ?Platform
    {
        return $this->editionPlatform;
    }

    public function setEditionPlatform(?Platform $editionPlatform): self
    {
        $this->editionPlatform = $editionPlatform;

        return $this;
    }

    public function getEditionSeries(): ?Series
    {
        return $this->editionSeries;
    }

    public function setEditionSeries(?Series $editionSeries): self
    {
        $this->editionSeries = $editionSeries;

        return $this;
    }

    public function getEditionDeveloper(): ?Company
    {
        return $this->editionDeveloper;
    }

    public function setEditionDeveloper(?Company $editionDeveloper): self
    {
        $this->editionDeveloper = $editionDeveloper;

        return $this;
    }

    public function getEditionMaster(): ?Master
    {
        return $this->editionMaster;
    }

    public function setEditionMaster(?Master $editionMaster): self
    {
        $this->editionMaster = $editionMaster;

        return $this;
    }

    public function getEditionPublisher(): ?Company
    {
        return $this->editionPublisher;
    }

    public function setEditionPublisher(?Company $editionPublisher): self
    {
        $this->editionPublisher = $editionPublisher;

        return $this;
    }

    public function getEditionUniverse(): ?Universe
    {
        return $this->editionUniverse;
    }

    public function setEditionUniverse(?Universe $editionUniverse): self
    {
        $this->editionUniverse = $editionUniverse;

        return $this;
    }


}
