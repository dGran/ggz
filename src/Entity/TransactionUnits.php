<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransactionUnits
 *
 * @ORM\Table(name="transaction_units", indexes={@ORM\Index(name="fk_transaction_units_unit_id_idx", columns={"transaction_units_unit_id"}), @ORM\Index(name="fk_transaction_units_transaction_id_idx", columns={"transaction_units_transaction_id"})})
 * @ORM\Entity
 */
class TransactionUnits
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtransaction_units", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransactionUnits;

    /**
     * @var \Transaction
     *
     * @ORM\ManyToOne(targetEntity="Transaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_units_transaction_id", referencedColumnName="idtransaction")
     * })
     */
    private $transactionUnitsTransaction;

    /**
     * @var \Unit
     *
     * @ORM\ManyToOne(targetEntity="Unit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_units_unit_id", referencedColumnName="idunit")
     * })
     */
    private $transactionUnitsUnit;

    public function getIdtransactionUnits(): ?int
    {
        return $this->idtransactionUnits;
    }

    public function getTransactionUnitsTransaction(): ?Transaction
    {
        return $this->transactionUnitsTransaction;
    }

    public function setTransactionUnitsTransaction(?Transaction $transactionUnitsTransaction): self
    {
        $this->transactionUnitsTransaction = $transactionUnitsTransaction;

        return $this;
    }

    public function getTransactionUnitsUnit(): ?Unit
    {
        return $this->transactionUnitsUnit;
    }

    public function setTransactionUnitsUnit(?Unit $transactionUnitsUnit): self
    {
        $this->transactionUnitsUnit = $transactionUnitsUnit;

        return $this;
    }


}
