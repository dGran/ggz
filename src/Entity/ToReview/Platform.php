<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Platform
 *
 * @ORM\Table(name="platform", indexes={@ORM\Index(name="fk_platform_company_id_idx", columns={"platform_company_id"}), @ORM\Index(name="fk_platform_platform_type_idx", columns={"platform_type_id"}), @ORM\Index(name="fk_platform_platform_family_idx", columns={"platform_family_id"})})
 * @ORM\Entity
 */
class Platform
{
    /**
     * @var int
     *
     * @ORM\Column(name="idplatform", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplatform;

    /**
     * @var string
     *
     * @ORM\Column(name="platform_name", type="string", length=250, nullable=false)
     */
    private $platformName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="platform_alternate_name", type="string", length=250, nullable=true)
     */
    private $platformAlternateName;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="platform_release_date", type="date", nullable=true)
     */
    private $platformReleaseDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="platform_generation", type="integer", nullable=true)
     */
    private $platformGeneration;

    /**
     * @var bool
     *
     * @ORM\Column(name="platform_locked", type="boolean", nullable=false)
     */
    private $platformLocked;

    /**
     * @var string|null
     *
     * @ORM\Column(name="platform_picture", type="string", length=255, nullable=true)
     */
    private $platformPicture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="platform_description", type="string", length=255, nullable=true)
     */
    private $platformDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="platform_links", type="string", length=255, nullable=true)
     */
    private $platformLinks;

    /**
     * @var \PlatformType
     *
     * @ORM\ManyToOne(targetEntity="PlatformType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="platform_type_id", referencedColumnName="idplatform_type")
     * })
     */
    private $platformType;

    /**
     * @var \Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="platform_company_id", referencedColumnName="idcompany")
     * })
     */
    private $platformCompany;

    /**
     * @var \PlatformFamily
     *
     * @ORM\ManyToOne(targetEntity="PlatformFamily")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="platform_family_id", referencedColumnName="idplatform_family")
     * })
     */
    private $platformFamily;

    public function getIdplatform(): ?int
    {
        return $this->idplatform;
    }

    public function getPlatformName(): ?string
    {
        return $this->platformName;
    }

    public function setPlatformName(string $platformName): self
    {
        $this->platformName = $platformName;

        return $this;
    }

    public function getPlatformAlternateName(): ?string
    {
        return $this->platformAlternateName;
    }

    public function setPlatformAlternateName(?string $platformAlternateName): self
    {
        $this->platformAlternateName = $platformAlternateName;

        return $this;
    }

    public function getPlatformReleaseDate(): ?\DateTimeInterface
    {
        return $this->platformReleaseDate;
    }

    public function setPlatformReleaseDate(?\DateTimeInterface $platformReleaseDate): self
    {
        $this->platformReleaseDate = $platformReleaseDate;

        return $this;
    }

    public function getPlatformGeneration(): ?int
    {
        return $this->platformGeneration;
    }

    public function setPlatformGeneration(?int $platformGeneration): self
    {
        $this->platformGeneration = $platformGeneration;

        return $this;
    }

    public function isPlatformLocked(): ?bool
    {
        return $this->platformLocked;
    }

    public function setPlatformLocked(bool $platformLocked): self
    {
        $this->platformLocked = $platformLocked;

        return $this;
    }

    public function getPlatformPicture(): ?string
    {
        return $this->platformPicture;
    }

    public function setPlatformPicture(?string $platformPicture): self
    {
        $this->platformPicture = $platformPicture;

        return $this;
    }

    public function getPlatformDescription(): ?string
    {
        return $this->platformDescription;
    }

    public function setPlatformDescription(?string $platformDescription): self
    {
        $this->platformDescription = $platformDescription;

        return $this;
    }

    public function getPlatformLinks(): ?string
    {
        return $this->platformLinks;
    }

    public function setPlatformLinks(?string $platformLinks): self
    {
        $this->platformLinks = $platformLinks;

        return $this;
    }

    public function getPlatformType(): ?PlatformType
    {
        return $this->platformType;
    }

    public function setPlatformType(?PlatformType $platformType): self
    {
        $this->platformType = $platformType;

        return $this;
    }

    public function getPlatformCompany(): ?Company
    {
        return $this->platformCompany;
    }

    public function setPlatformCompany(?Company $platformCompany): self
    {
        $this->platformCompany = $platformCompany;

        return $this;
    }

    public function getPlatformFamily(): ?PlatformFamily
    {
        return $this->platformFamily;
    }

    public function setPlatformFamily(?PlatformFamily $platformFamily): self
    {
        $this->platformFamily = $platformFamily;

        return $this;
    }


}
