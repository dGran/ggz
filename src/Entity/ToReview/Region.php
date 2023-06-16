<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="idregion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idregion;

    /**
     * @var string
     *
     * @ORM\Column(name="region_name", type="string", length=255, nullable=false)
     */
    private $regionName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="region_description", type="string", length=255, nullable=true)
     */
    private $regionDescription;

    public function getIdregion(): ?int
    {
        return $this->idregion;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function setRegionName(string $regionName): self
    {
        $this->regionName = $regionName;

        return $this;
    }

    public function getRegionDescription(): ?string
    {
        return $this->regionDescription;
    }

    public function setRegionDescription(?string $regionDescription): self
    {
        $this->regionDescription = $regionDescription;

        return $this;
    }


}
