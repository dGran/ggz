<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private ?string $isoCode = null;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: CountryLang::class)]
    private Collection $countryLangs;

    #[ORM\ManyToOne(inversedBy: 'countries')]
    private ?Currency $defaultCurrency = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $countryZone = null;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getCountryLang(): ?CountryLang
    {
        return $this->countryLang;
    }

    public function setCountryLang(?CountryLang $countryLang): self
    {
        $this->countryLang = $countryLang;

        return $this;
    }

    public function getDefaultCurrency(): ?Currency
    {
        return $this->defaultCurrency;
    }

    public function setDefaultCurrency(?Currency $defaultCurrency): self
    {
        $this->defaultCurrency = $defaultCurrency;

        return $this;
    }

    public function getCountryZone(): ?string
    {
        return $this->countryZone;
    }

    public function setCountryZone(?string $countryZone): self
    {
        $this->countryZone = $countryZone;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCountry($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCountry() === $this) {
                $user->setCountry(null);
            }
        }

        return $this;
    }
}