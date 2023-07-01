<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
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

    #[ORM\ManyToOne(inversedBy: 'companies')]
    private ?CompanyType $type = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Platform::class)]
    private Collection $platforms;

    #[ORM\Column]
    protected \DateTime $dateCreated;

    #[ORM\Column(nullable: true)]
    protected ?\DateTime $dateUpdated;

    public function __construct()
    {
        $this->platforms = new ArrayCollection();
        $this->dateCreated = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Company
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Company
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): Company
    {
        $this->picture = $picture;

        return $this;
    }

    public function getType(): ?CompanyType
    {
        return $this->type;
    }

    public function setType(?CompanyType $type): Company
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Platform>
     */
    public function getPlatforms(): Collection
    {
        return $this->platforms;
    }

    public function addPlatform(Platform $platform): Company
    {
        if (!$this->platforms->contains($platform)) {
            $this->platforms->add($platform);
            $platform->setCompany($this);
        }

        return $this;
    }

    public function removePlatform(Platform $platform): Company
    {
        if ($this->platforms->removeElement($platform)) {
            // set the owning side to null (unless already changed)
            if ($platform->getCompany() === $this) {
                $platform->setCompany(null);
            }
        }

        return $this;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): Company
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTime $dateUpdated): Company
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
