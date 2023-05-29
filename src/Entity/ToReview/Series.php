<?php

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 *
 * @ORM\Table(name="series", indexes={@ORM\Index(name="fk_series_parent_universe_id_idx", columns={"series_parent_universe_id"}), @ORM\Index(name="fk_series_parent_series_id_idx", columns={"series_parent_id"})})
 * @ORM\Entity
 */
class Series
{
    /**
     * @var int
     *
     * @ORM\Column(name="idseries", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseries;

    /**
     * @var string
     *
     * @ORM\Column(name="series_name", type="string", length=255, nullable=false)
     */
    private $seriesName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="series_description", type="string", length=255, nullable=true)
     */
    private $seriesDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="series_alternate_name", type="string", length=255, nullable=true)
     */
    private $seriesAlternateName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="series_picture", type="string", length=255, nullable=true)
     */
    private $seriesPicture;

    /**
     * @var \Series
     *
     * @ORM\ManyToOne(targetEntity="Series")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="series_parent_id", referencedColumnName="idseries")
     * })
     */
    private $seriesParent;

    /**
     * @var \Universe
     *
     * @ORM\ManyToOne(targetEntity="Universe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="series_parent_universe_id", referencedColumnName="iduniverse")
     * })
     */
    private $seriesParentUniverse;

    public function getIdseries(): ?int
    {
        return $this->idseries;
    }

    public function getSeriesName(): ?string
    {
        return $this->seriesName;
    }

    public function setSeriesName(string $seriesName): self
    {
        $this->seriesName = $seriesName;

        return $this;
    }

    public function getSeriesDescription(): ?string
    {
        return $this->seriesDescription;
    }

    public function setSeriesDescription(?string $seriesDescription): self
    {
        $this->seriesDescription = $seriesDescription;

        return $this;
    }

    public function getSeriesAlternateName(): ?string
    {
        return $this->seriesAlternateName;
    }

    public function setSeriesAlternateName(?string $seriesAlternateName): self
    {
        $this->seriesAlternateName = $seriesAlternateName;

        return $this;
    }

    public function getSeriesPicture(): ?string
    {
        return $this->seriesPicture;
    }

    public function setSeriesPicture(?string $seriesPicture): self
    {
        $this->seriesPicture = $seriesPicture;

        return $this;
    }

    public function getSeriesParent(): ?self
    {
        return $this->seriesParent;
    }

    public function setSeriesParent(?self $seriesParent): self
    {
        $this->seriesParent = $seriesParent;

        return $this;
    }

    public function getSeriesParentUniverse(): ?Universe
    {
        return $this->seriesParentUniverse;
    }

    public function setSeriesParentUniverse(?Universe $seriesParentUniverse): self
    {
        $this->seriesParentUniverse = $seriesParentUniverse;

        return $this;
    }


}
