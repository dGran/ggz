<?php

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreditType
 *
 * @ORM\Table(name="credit_type")
 * @ORM\Entity
 */
class CreditType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcredit_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcreditType;

    /**
     * @var string
     *
     * @ORM\Column(name="credit_type_name", type="string", length=250, nullable=false)
     */
    private $creditTypeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="credit_description", type="string", length=250, nullable=true)
     */
    private $creditDescription;

    public function getIdcreditType(): ?int
    {
        return $this->idcreditType;
    }

    public function getCreditTypeName(): ?string
    {
        return $this->creditTypeName;
    }

    public function setCreditTypeName(string $creditTypeName): self
    {
        $this->creditTypeName = $creditTypeName;

        return $this;
    }

    public function getCreditDescription(): ?string
    {
        return $this->creditDescription;
    }

    public function setCreditDescription(?string $creditDescription): self
    {
        $this->creditDescription = $creditDescription;

        return $this;
    }


}
