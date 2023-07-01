<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\NumberOfPlayersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NumberOfPlayersRepository::class)]
class NumberOfPlayers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'numberOfPlayers', targetEntity: Edition::class)]
    private Collection $editions;

    public function __construct()
    {
        $this->editions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Edition>
     */
    public function getEditions(): Collection
    {
        return $this->editions;
    }

    public function addEdition(Edition $edition): static
    {
        if (!$this->editions->contains($edition)) {
            $this->editions->add($edition);
            $edition->setNumberOfPlayers($this);
        }

        return $this;
    }

    public function removeEdition(Edition $edition): static
    {
        if ($this->editions->removeElement($edition)) {
            // set the owning side to null (unless already changed)
            if ($edition->getNumberOfPlayers() === $this) {
                $edition->setNumberOfPlayers(null);
            }
        }

        return $this;
    }
}
