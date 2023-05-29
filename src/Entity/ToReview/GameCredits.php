<?php

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameCredits
 *
 * @ORM\Table(name="game_credits", indexes={@ORM\Index(name="pk_game_credits_credit_type_idx", columns={"game_credits_credit_type"}), @ORM\Index(name="pk_game_credits_credit_id_idx", columns={"game_credits_credits_id"}), @ORM\Index(name="pk_game_credits_game_id_idx", columns={"game_credits_game_id"})})
 * @ORM\Entity
 */
class GameCredits
{
    /**
     * @var int
     *
     * @ORM\Column(name="idgame_credits", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgameCredits;

    /**
     * @var int|null
     *
     * @ORM\Column(name="game_credits_order", type="integer", nullable=true)
     */
    private $gameCreditsOrder;

    /**
     * @var \CreditType
     *
     * @ORM\ManyToOne(targetEntity="CreditType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game_credits_credit_type", referencedColumnName="idcredit_type")
     * })
     */
    private $gameCreditsCreditType;

    /**
     * @var \Master
     *
     * @ORM\ManyToOne(targetEntity="Master")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game_credits_game_id", referencedColumnName="idmaster")
     * })
     */
    private $gameCreditsGame;

    /**
     * @var \Credits
     *
     * @ORM\ManyToOne(targetEntity="Credits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game_credits_credits_id", referencedColumnName="idcredits")
     * })
     */
    private $gameCreditsCredits;

    public function getIdgameCredits(): ?int
    {
        return $this->idgameCredits;
    }

    public function getGameCreditsOrder(): ?int
    {
        return $this->gameCreditsOrder;
    }

    public function setGameCreditsOrder(?int $gameCreditsOrder): self
    {
        $this->gameCreditsOrder = $gameCreditsOrder;

        return $this;
    }

    public function getGameCreditsCreditType(): ?CreditType
    {
        return $this->gameCreditsCreditType;
    }

    public function setGameCreditsCreditType(?CreditType $gameCreditsCreditType): self
    {
        $this->gameCreditsCreditType = $gameCreditsCreditType;

        return $this;
    }

    public function getGameCreditsGame(): ?Master
    {
        return $this->gameCreditsGame;
    }

    public function setGameCreditsGame(?Master $gameCreditsGame): self
    {
        $this->gameCreditsGame = $gameCreditsGame;

        return $this;
    }

    public function getGameCreditsCredits(): ?Credits
    {
        return $this->gameCreditsCredits;
    }

    public function setGameCreditsCredits(?Credits $gameCreditsCredits): self
    {
        $this->gameCreditsCredits = $gameCreditsCredits;

        return $this;
    }


}
