<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountType
 *
 * @ORM\Table(name="account_type")
 * @ORM\Entity
 */
class AccountType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idaccount_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaccountType;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_name", type="string", length=255, nullable=false)
     */
    private $accountTypeName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_type_description", type="string", length=255, nullable=true)
     */
    private $accountTypeDescription;

    public function getIdaccountType(): ?int
    {
        return $this->idaccountType;
    }

    public function getAccountTypeName(): ?string
    {
        return $this->accountTypeName;
    }

    public function setAccountTypeName(string $accountTypeName): self
    {
        $this->accountTypeName = $accountTypeName;

        return $this;
    }

    public function getAccountTypeDescription(): ?string
    {
        return $this->accountTypeDescription;
    }

    public function setAccountTypeDescription(?string $accountTypeDescription): self
    {
        $this->accountTypeDescription = $accountTypeDescription;

        return $this;
    }
}
