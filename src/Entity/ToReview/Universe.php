<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Universe
 *
 * @ORM\Table(name="universe", indexes={@ORM\Index(name="fk_universe_universe_parent_id_idx", columns={"universe_parent_id"})})
 * @ORM\Entity
 */
class Universe
{
    /**
     * @var int
     *
     * @ORM\Column(name="iduniverse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduniverse;

    /**
     * @var string
     *
     * @ORM\Column(name="universe_name", type="string", length=255, nullable=false)
     */
    private $universeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="universe_description", type="string", length=255, nullable=true)
     */
    private $universeDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="universe_alternate_name", type="string", length=255, nullable=true)
     */
    private $universeAlternateName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="universe_picture", type="string", length=255, nullable=true)
     */
    private $universePicture;

    /**
     * @var \Universe
     *
     * @ORM\ManyToOne(targetEntity="Universe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="universe_parent_id", referencedColumnName="iduniverse")
     * })
     */
    private $universeParent;

    public function getIduniverse(): ?int
    {
        return $this->iduniverse;
    }

    public function getUniverseName(): ?string
    {
        return $this->universeName;
    }

    public function setUniverseName(string $universeName): self
    {
        $this->universeName = $universeName;

        return $this;
    }

    public function getUniverseDescription(): ?string
    {
        return $this->universeDescription;
    }

    public function setUniverseDescription(?string $universeDescription): self
    {
        $this->universeDescription = $universeDescription;

        return $this;
    }

    public function getUniverseAlternateName(): ?string
    {
        return $this->universeAlternateName;
    }

    public function setUniverseAlternateName(?string $universeAlternateName): self
    {
        $this->universeAlternateName = $universeAlternateName;

        return $this;
    }

    public function getUniversePicture(): ?string
    {
        return $this->universePicture;
    }

    public function setUniversePicture(?string $universePicture): self
    {
        $this->universePicture = $universePicture;

        return $this;
    }

    public function getUniverseParent(): ?self
    {
        return $this->universeParent;
    }

    public function setUniverseParent(?self $universeParent): self
    {
        $this->universeParent = $universeParent;

        return $this;
    }


}
