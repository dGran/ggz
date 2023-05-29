<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="unit", indexes={@ORM\Index(name="pk_unit_currency_idx", columns={"unit_currency"}), @ORM\Index(name="pk_unit_condition_id_idx", columns={"unit_condition_id"}), @ORM\Index(name="pk_unit_edition_id_idx", columns={"unit_edition_id"}), @ORM\Index(name="pk_unit_content_id_idx", columns={"unit_content_id"}), @ORM\Index(name="pk_unit_user_id_idx", columns={"unit_user_id"})})
 * @ORM\Entity
 */
class Unit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idunit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idunit;

    /**
     * @var float
     *
     * @ORM\Column(name="unit_price", type="float", precision=10, scale=0, nullable=false)
     */
    private $unitPrice;

    /**
     * @var Condition
     *
     * @ORM\ManyToOne(targetEntity="Condition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_condition_id", referencedColumnName="idcondition")
     * })
     */
    private $unitCondition;

    /**
     * @var Edition
     *
     * @ORM\ManyToOne(targetEntity="Edition")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_edition_id", referencedColumnName="idedition")
     * })
     */
    private $unitEdition;

    /**
     * @var UnitContent
     *
     * @ORM\ManyToOne(targetEntity="UnitContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_content_id", referencedColumnName="idunit_content")
     * })
     */
    private $unitContent;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_user_id", referencedColumnName="id")
     * })
     */
    private $unitUser;

    /**
     * @var Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_currency", referencedColumnName="id")
     * })
     */
    private $unitCurrency;

    public function getIdunit(): ?int
    {
        return $this->idunit;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getUnitCondition(): ?Condition
    {
        return $this->unitCondition;
    }

    public function setUnitCondition(?Condition $unitCondition): self
    {
        $this->unitCondition = $unitCondition;

        return $this;
    }

    public function getUnitEdition(): ?Edition
    {
        return $this->unitEdition;
    }

    public function setUnitEdition(?Edition $unitEdition): self
    {
        $this->unitEdition = $unitEdition;

        return $this;
    }

    public function getUnitContent(): ?UnitContent
    {
        return $this->unitContent;
    }

    public function setUnitContent(?UnitContent $unitContent): self
    {
        $this->unitContent = $unitContent;

        return $this;
    }

    public function getUnitUser(): ?User
    {
        return $this->unitUser;
    }

    public function setUnitUser(?User $unitUser): self
    {
        $this->unitUser = $unitUser;

        return $this;
    }

    public function getUnitCurrency(): ?Currency
    {
        return $this->unitCurrency;
    }

    public function setUnitCurrency(?Currency $unitCurrency): self
    {
        $this->unitCurrency = $unitCurrency;

        return $this;
    }


}
