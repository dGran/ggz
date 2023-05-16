<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Condition
 *
 * @ORM\Table(name="condition")
 * @ORM\Entity
 */
class Condition
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcondition", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcondition;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_name", type="string", length=255, nullable=false)
     */
    private $conditionName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="condition_description", type="string", length=255, nullable=true)
     */
    private $conditionDescription;

    public function getIdcondition(): ?int
    {
        return $this->idcondition;
    }

    public function getConditionName(): ?string
    {
        return $this->conditionName;
    }

    public function setConditionName(string $conditionName): self
    {
        $this->conditionName = $conditionName;

        return $this;
    }

    public function getConditionDescription(): ?string
    {
        return $this->conditionDescription;
    }

    public function setConditionDescription(?string $conditionDescription): self
    {
        $this->conditionDescription = $conditionDescription;

        return $this;
    }


}
