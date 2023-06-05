<?php

namespace App\Entity\ToReview;

use App\Entity\UserGGZ;
use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="pk_address_user_id_idx", columns={"address_user_id"})})
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="idaddress", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="address_name", type="string", length=255, nullable=false)
     */
    private $addressName;

    /**
     * @var string
     *
     * @ORM\Column(name="address_full_name", type="string", length=255, nullable=false)
     */
    private $addressFullName;

    /**
     * @var string
     *
     * @ORM\Column(name="address_first_line", type="string", length=255, nullable=false)
     */
    private $addressFirstLine;

    /**
     * @var string
     *
     * @ORM\Column(name="address_city", type="string", length=255, nullable=false)
     */
    private $addressCity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address_regionstate", type="string", length=255, nullable=true)
     */
    private $addressRegionstate;

    /**
     * @var string
     *
     * @ORM\Column(name="address_postal_code", type="string", length=255, nullable=false)
     */
    private $addressPostalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="address_country", type="string", length=255, nullable=false)
     */
    private $addressCountry;

    /**
     * @var bool
     *
     * @ORM\Column(name="address_is_main", type="boolean", nullable=false)
     */
    private $addressIsMain;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_user_id", referencedColumnName="id")
     * })
     */
    private $addressUser;

    public function getIdaddress(): ?int
    {
        return $this->idaddress;
    }

    public function getAddressName(): ?string
    {
        return $this->addressName;
    }

    public function setAddressName(string $addressName): self
    {
        $this->addressName = $addressName;

        return $this;
    }

    public function getAddressFullName(): ?string
    {
        return $this->addressFullName;
    }

    public function setAddressFullName(string $addressFullName): self
    {
        $this->addressFullName = $addressFullName;

        return $this;
    }

    public function getAddressFirstLine(): ?string
    {
        return $this->addressFirstLine;
    }

    public function setAddressFirstLine(string $addressFirstLine): self
    {
        $this->addressFirstLine = $addressFirstLine;

        return $this;
    }

    public function getAddressCity(): ?string
    {
        return $this->addressCity;
    }

    public function setAddressCity(string $addressCity): self
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    public function getAddressRegionstate(): ?string
    {
        return $this->addressRegionstate;
    }

    public function setAddressRegionstate(?string $addressRegionstate): self
    {
        $this->addressRegionstate = $addressRegionstate;

        return $this;
    }

    public function getAddressPostalCode(): ?string
    {
        return $this->addressPostalCode;
    }

    public function setAddressPostalCode(string $addressPostalCode): self
    {
        $this->addressPostalCode = $addressPostalCode;

        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(string $addressCountry): self
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    public function isAddressIsMain(): ?bool
    {
        return $this->addressIsMain;
    }

    public function setAddressIsMain(bool $addressIsMain): self
    {
        $this->addressIsMain = $addressIsMain;

        return $this;
    }

    public function getAddressUser(): ?UserGGZ
    {
        return $this->addressUser;
    }

    public function setAddressUser(?UserGGZ $addressUser): self
    {
        $this->addressUser = $addressUser;

        return $this;
    }


}
