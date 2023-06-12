<?php

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyType
 *
 * @ORM\Table(name="company_type")
 * @ORM\Entity
 */
class CompanyType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcompany_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcompanyType;

    /**
     * @var string
     *
     * @ORM\Column(name="company_type_name", type="string", length=250, nullable=false)
     */
    private $companyTypeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    public function getIdcompanyType(): ?int
    {
        return $this->idcompanyType;
    }

    public function getCompanyTypeName(): ?string
    {
        return $this->companyTypeName;
    }

    public function setCompanyTypeName(string $companyTypeName): self
    {
        $this->companyTypeName = $companyTypeName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
