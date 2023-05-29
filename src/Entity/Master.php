<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Master
 *
 * @ORM\Table(name="master", indexes={@ORM\Index(name="fk_master_contribution_state_id_idx", columns={"master_contribution_state"}), @ORM\Index(name="fk_master_number_of_players_id_idx", columns={"master_numberofplayers_id"}), @ORM\Index(name="fk_master_genre_id_idx", columns={"master_genre_id"}), @ORM\Index(name="fk_master_country_id_idx", columns={"master_country_id"}), @ORM\Index(name="fk_master_series_id_idx", columns={"master_series_id"}), @ORM\Index(name="fk_master_platform_id_idx", columns={"master_platform_id"}), @ORM\Index(name="fk_master_developer_id_idx", columns={"master_developer_id"}), @ORM\Index(name="fk_master_universe_id_idx", columns={"master_universe_id"}), @ORM\Index(name="fk_master_language_id_idx", columns={"master_language_id"}), @ORM\Index(name="fk_master_publisher_id_idx", columns={"master_publisher_id"}), @ORM\Index(name="fk_master_region_id_idx", columns={"master_region_id"})})
 * @ORM\Entity
 */
class Master
{
    /**
     * @var int
     *
     * @ORM\Column(name="idmaster", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmaster;

    /**
     * @var string
     *
     * @ORM\Column(name="master_name", type="string", length=255, nullable=false)
     */
    private $masterName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="master_picture", type="string", length=255, nullable=true)
     */
    private $masterPicture;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="master_release_date", type="date", nullable=true)
     */
    private $masterReleaseDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="master_description", type="string", length=255, nullable=true)
     */
    private $masterDescription;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="master_creation_date", type="date", nullable=true)
     */
    private $masterCreationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="master_latest_update", type="date", nullable=true)
     */
    private $masterLatestUpdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="master_locked", type="boolean", nullable=false)
     */
    private $masterLocked;

    /**
     * @var Region
     *
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_region_id", referencedColumnName="idregion")
     * })
     */
    private $masterRegion;

    /**
     * @var ContributionState
     *
     * @ORM\ManyToOne(targetEntity="ContributionState")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_contribution_state", referencedColumnName="idcontribution_state")
     * })
     */
    private $masterContributionState;

    /**
     * @var Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_genre_id", referencedColumnName="idgenre")
     * })
     */
    private $masterGenre;

    /**
     * @var Platform
     *
     * @ORM\ManyToOne(targetEntity="Platform")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_platform_id", referencedColumnName="idplatform")
     * })
     */
    private $masterPlatform;

    /**
     * @var Series
     *
     * @ORM\ManyToOne(targetEntity="Series")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_series_id", referencedColumnName="idseries")
     * })
     */
    private $masterSeries;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_country_id", referencedColumnName="id")
     * })
     */
    private $masterCountry;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_language_id", referencedColumnName="id")
     * })
     */
    private $masterLanguage;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_publisher_id", referencedColumnName="idcompany")
     * })
     */
    private $masterPublisher;

    /**
     * @var Universe
     *
     * @ORM\ManyToOne(targetEntity="Universe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_universe_id", referencedColumnName="iduniverse")
     * })
     */
    private $masterUniverse;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_developer_id", referencedColumnName="idcompany")
     * })
     */
    private $masterDeveloper;

    /**
     * @var NumberOfPlayers
     *
     * @ORM\ManyToOne(targetEntity="NumberOfPlayers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="master_numberofplayers_id", referencedColumnName="idnumber_of_players")
     * })
     */
    private $masterNumberofplayers;

    public function getIdmaster(): ?int
    {
        return $this->idmaster;
    }

    public function getMasterName(): ?string
    {
        return $this->masterName;
    }

    public function setMasterName(string $masterName): self
    {
        $this->masterName = $masterName;

        return $this;
    }

    public function getMasterPicture(): ?string
    {
        return $this->masterPicture;
    }

    public function setMasterPicture(?string $masterPicture): self
    {
        $this->masterPicture = $masterPicture;

        return $this;
    }

    public function getMasterReleaseDate(): ?\DateTimeInterface
    {
        return $this->masterReleaseDate;
    }

    public function setMasterReleaseDate(?\DateTimeInterface $masterReleaseDate): self
    {
        $this->masterReleaseDate = $masterReleaseDate;

        return $this;
    }

    public function getMasterDescription(): ?string
    {
        return $this->masterDescription;
    }

    public function setMasterDescription(?string $masterDescription): self
    {
        $this->masterDescription = $masterDescription;

        return $this;
    }

    public function getMasterCreationDate(): ?\DateTimeInterface
    {
        return $this->masterCreationDate;
    }

    public function setMasterCreationDate(?\DateTimeInterface $masterCreationDate): self
    {
        $this->masterCreationDate = $masterCreationDate;

        return $this;
    }

    public function getMasterLatestUpdate(): ?\DateTimeInterface
    {
        return $this->masterLatestUpdate;
    }

    public function setMasterLatestUpdate(?\DateTimeInterface $masterLatestUpdate): self
    {
        $this->masterLatestUpdate = $masterLatestUpdate;

        return $this;
    }

    public function isMasterLocked(): ?bool
    {
        return $this->masterLocked;
    }

    public function setMasterLocked(bool $masterLocked): self
    {
        $this->masterLocked = $masterLocked;

        return $this;
    }

    public function getMasterRegion(): ?Region
    {
        return $this->masterRegion;
    }

    public function setMasterRegion(?Region $masterRegion): self
    {
        $this->masterRegion = $masterRegion;

        return $this;
    }

    public function getMasterContributionState(): ?ContributionState
    {
        return $this->masterContributionState;
    }

    public function setMasterContributionState(?ContributionState $masterContributionState): self
    {
        $this->masterContributionState = $masterContributionState;

        return $this;
    }

    public function getMasterGenre(): ?Genre
    {
        return $this->masterGenre;
    }

    public function setMasterGenre(?Genre $masterGenre): self
    {
        $this->masterGenre = $masterGenre;

        return $this;
    }

    public function getMasterPlatform(): ?Platform
    {
        return $this->masterPlatform;
    }

    public function setMasterPlatform(?Platform $masterPlatform): self
    {
        $this->masterPlatform = $masterPlatform;

        return $this;
    }

    public function getMasterSeries(): ?Series
    {
        return $this->masterSeries;
    }

    public function setMasterSeries(?Series $masterSeries): self
    {
        $this->masterSeries = $masterSeries;

        return $this;
    }

    public function getMasterCountry(): ?Country
    {
        return $this->masterCountry;
    }

    public function setMasterCountry(?Country $masterCountry): self
    {
        $this->masterCountry = $masterCountry;

        return $this;
    }

    public function getMasterLanguage(): ?Language
    {
        return $this->masterLanguage;
    }

    public function setMasterLanguage(?Language $masterLanguage): self
    {
        $this->masterLanguage = $masterLanguage;

        return $this;
    }

    public function getMasterPublisher(): ?Company
    {
        return $this->masterPublisher;
    }

    public function setMasterPublisher(?Company $masterPublisher): self
    {
        $this->masterPublisher = $masterPublisher;

        return $this;
    }

    public function getMasterUniverse(): ?Universe
    {
        return $this->masterUniverse;
    }

    public function setMasterUniverse(?Universe $masterUniverse): self
    {
        $this->masterUniverse = $masterUniverse;

        return $this;
    }

    public function getMasterDeveloper(): ?Company
    {
        return $this->masterDeveloper;
    }

    public function setMasterDeveloper(?Company $masterDeveloper): self
    {
        $this->masterDeveloper = $masterDeveloper;

        return $this;
    }

    public function getMasterNumberofplayers(): ?NumberOfPlayers
    {
        return $this->masterNumberofplayers;
    }

    public function setMasterNumberofplayers(?NumberOfPlayers $masterNumberofplayers): self
    {
        $this->masterNumberofplayers = $masterNumberofplayers;

        return $this;
    }


}
