<?php

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnitContent
 *
 * @ORM\Table(name="unit_content")
 * @ORM\Entity
 */
class UnitContent
{
    /**
     * @var int
     *
     * @ORM\Column(name="idunit_content", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idunitContent;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_content_name", type="string", length=255, nullable=false)
     */
    private $unitContentName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unit_content_description", type="string", length=255, nullable=true)
     */
    private $unitContentDescription;

    public function getIdunitContent(): ?int
    {
        return $this->idunitContent;
    }

    public function getUnitContentName(): ?string
    {
        return $this->unitContentName;
    }

    public function setUnitContentName(string $unitContentName): self
    {
        $this->unitContentName = $unitContentName;

        return $this;
    }

    public function getUnitContentDescription(): ?string
    {
        return $this->unitContentDescription;
    }

    public function setUnitContentDescription(?string $unitContentDescription): self
    {
        $this->unitContentDescription = $unitContentDescription;

        return $this;
    }


}
