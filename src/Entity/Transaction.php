<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction", indexes={@ORM\Index(name="fk_transaction_address_idx", columns={"transaction_address_id"}), @ORM\Index(name="fk_transaction_buyer_idx", columns={"transaction_buyer_id"}), @ORM\Index(name="fk_transaction_currency_idx", columns={"transaction_currency"}), @ORM\Index(name="fk_transaction_seller_idx", columns={"transaction_seller_id"}), @ORM\Index(name="fk_transaction_state_idx", columns={"transaction_state_id"})})
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="idtransaction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtransaction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transaction_creation_date", type="datetime", nullable=false)
     */
    private $transactionCreationDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="transaction_buyer_note", type="string", length=255, nullable=true)
     */
    private $transactionBuyerNote;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_buyer_id", referencedColumnName="id")
     * })
     */
    private $transactionBuyer;

    /**
     * @var \TransactionState
     *
     * @ORM\ManyToOne(targetEntity="TransactionState")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_state_id", referencedColumnName="idtransaction_state")
     * })
     */
    private $transactionState;

    /**
     * @var \Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_currency", referencedColumnName="id")
     * })
     */
    private $transactionCurrency;

    /**
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_address_id", referencedColumnName="idaddress")
     * })
     */
    private $transactionAddress;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_seller_id", referencedColumnName="id")
     * })
     */
    private $transactionSeller;

    public function getIdtransaction(): ?int
    {
        return $this->idtransaction;
    }

    public function getTransactionCreationDate(): ?\DateTimeInterface
    {
        return $this->transactionCreationDate;
    }

    public function setTransactionCreationDate(\DateTimeInterface $transactionCreationDate): self
    {
        $this->transactionCreationDate = $transactionCreationDate;

        return $this;
    }

    public function getTransactionBuyerNote(): ?string
    {
        return $this->transactionBuyerNote;
    }

    public function setTransactionBuyerNote(?string $transactionBuyerNote): self
    {
        $this->transactionBuyerNote = $transactionBuyerNote;

        return $this;
    }

    public function getTransactionBuyer(): ?User
    {
        return $this->transactionBuyer;
    }

    public function setTransactionBuyer(?User $transactionBuyer): self
    {
        $this->transactionBuyer = $transactionBuyer;

        return $this;
    }

    public function getTransactionState(): ?TransactionState
    {
        return $this->transactionState;
    }

    public function setTransactionState(?TransactionState $transactionState): self
    {
        $this->transactionState = $transactionState;

        return $this;
    }

    public function getTransactionCurrency(): ?Currency
    {
        return $this->transactionCurrency;
    }

    public function setTransactionCurrency(?Currency $transactionCurrency): self
    {
        $this->transactionCurrency = $transactionCurrency;

        return $this;
    }

    public function getTransactionAddress(): ?Address
    {
        return $this->transactionAddress;
    }

    public function setTransactionAddress(?Address $transactionAddress): self
    {
        $this->transactionAddress = $transactionAddress;

        return $this;
    }

    public function getTransactionSeller(): ?User
    {
        return $this->transactionSeller;
    }

    public function setTransactionSeller(?User $transactionSeller): self
    {
        $this->transactionSeller = $transactionSeller;

        return $this;
    }


}
