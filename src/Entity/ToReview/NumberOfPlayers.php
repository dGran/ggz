<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumberOfPlayers
 *
 * @ORM\Table(name="number_of_players")
 * @ORM\Entity
 */
class NumberOfPlayers
{
    /**
     * @var int
     *
     * @ORM\Column(name="idnumber_of_players", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnumberOfPlayers;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    public function getIdnumberOfPlayers(): ?int
    {
        return $this->idnumberOfPlayers;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }


}
