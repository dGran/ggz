<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransactionState
 *
 * @ORM\Table(name="transaction_state")
 * @ORM\Entity
 */
class TransactionState
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtransaction_state", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransactionState;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_state_name", type="string", length=255, nullable=false)
     */
    private $transactionStateName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transaction_state_description", type="string", length=255, nullable=true)
     */
    private $transactionStateDescription;

    public function getIdtransactionState(): ?int
    {
        return $this->idtransactionState;
    }

    public function getTransactionStateName(): ?string
    {
        return $this->transactionStateName;
    }

    public function setTransactionStateName(string $transactionStateName): self
    {
        $this->transactionStateName = $transactionStateName;

        return $this;
    }

    public function getTransactionStateDescription(): ?string
    {
        return $this->transactionStateDescription;
    }

    public function setTransactionStateDescription(?string $transactionStateDescription): self
    {
        $this->transactionStateDescription = $transactionStateDescription;

        return $this;
    }


}
