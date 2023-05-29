<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country", indexes={@ORM\Index(name="IDX_5373C966ECD792C0", columns={"default_currency_id"})})
 * @ORM\Entity
 */
class Country
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_code", type="string", length=10, nullable=false)
     */
    private $isoCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country_zone", type="string", length=255, nullable=true)
     */
    private $countryZone;

    /**
     * @var Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="default_currency_id", referencedColumnName="id")
     * })
     */
    private $defaultCurrency;

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

    public function getCountryZone(): ?string
    {
        return $this->countryZone;
    }

    public function setCountryZone(?string $countryZone): self
    {
        $this->countryZone = $countryZone;

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


}
