<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UniverseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniverseRepository::class)]
class Universe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $alternateName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(nullable: true)]
    private ?int $universeId = null;

    #[ORM\OneToMany(mappedBy: 'universe', targetEntity: Series::class)]
    private Collection $series;

    public function __construct()
    {
        $this->series = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Universe
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Universe
    {
        $this->description = $description;

        return $this;
    }

    public function getAlternateName(): ?string
    {
        return $this->alternateName;
    }

    public function setAlternateName(?string $alternateName): Universe
    {
        $this->alternateName = $alternateName;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): Universe
    {
        $this->picture = $picture;

        return $this;
    }

    public function getUniverseId(): ?int
    {
        return $this->universeId;
    }

    public function setUniverseId(?int $universeId): Universe
    {
        $this->universeId = $universeId;

        return $this;
    }

    /**
     * @return Collection<int, Series>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Series $series): Universe
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->setUniverse($this);
        }

        return $this;
    }

    public function removeSeries(Series $series): Universe
    {
        if ($this->series->removeElement($series)) {
            // set the owning side to null (unless already changed)
            if ($series->getUniverse() === $this) {
                $series->setUniverse(null);
            }
        }

        return $this;
    }
}
