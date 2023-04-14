<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private ?string $isoCode = null;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: CountryLang::class)]
    private Collection $countryLangs;

    public function __construct()
    {
         $this->countryLangs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsoCode(): ?string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): self
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * @return Collection<int, CountryLang>
     */
    public function getCountryLangs(): Collection
    {
        return $this->countryLangs;
    }

    public function addCountryLang(CountryLang $countryLang): self
    {
        if (!$this->countryLangs->contains($countryLang)) {
            $this->countryLangs->add($countryLang);
            $countryLang->setLanguage($this);
        }

        return $this;
    }

    public function removeCountryLang(CountryLang $countryLang): self
    {
        if ($this->countryLangs->removeElement($countryLang)) {
            // set the owning side to null (unless already changed)
            if ($countryLang->getLanguage() === $this) {
                $countryLang->setLanguage(null);
            }
        }

        return $this;
    }
}
