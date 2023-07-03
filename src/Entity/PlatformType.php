<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\PlatformTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatformTypeRepository::class)]
class PlatformType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Platform::class)]
    private Collection $platforms;

    public function __construct()
    {
        $this->platforms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): PlatformType
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): PlatformType
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): PlatformType
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Platform>
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(Platform $platform): PlatformType
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms->add($platform);
            $platform->setType($this);
        }

        return $this;
    }

    public function removePlatform(Platform $platform): PlatformType
    {
        if ($this->platforms->removeElement($platform)) {
            // set the owning side to null (unless already changed)
            if ($platform->getType() === $this) {
                $platform->setType(null);
            }
        }

        return $this;
    }
}
