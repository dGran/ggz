<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlatformFamily
 *
 * @ORM\Table(name="platform_family")
 * @ORM\Entity
 */
class PlatformFamily
{
    /**
     * @var int
     *
     * @ORM\Column(name="idplatform_family", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplatformFamily;

    /**
     * @var string
     *
     * @ORM\Column(name="platform_family_name", type="string", length=250, nullable=false)
     */
    private $platformFamilyName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="platform_family_description", type="string", length=250, nullable=true)
     */
    private $platformFamilyDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="platform_family_picture", type="string", length=250, nullable=true)
     */
    private $platformFamilyPicture;

    public function getIdplatformFamily(): ?int
    {
        return $this->idplatformFamily;
    }

    public function getPlatformFamilyName(): ?string
    {
        return $this->platformFamilyName;
    }

    public function setPlatformFamilyName(string $platformFamilyName): self
    {
        $this->platformFamilyName = $platformFamilyName;

        return $this;
    }

    public function getPlatformFamilyDescription(): ?string
    {
        return $this->platformFamilyDescription;
    }

    public function setPlatformFamilyDescription(?string $platformFamilyDescription): self
    {
        $this->platformFamilyDescription = $platformFamilyDescription;

        return $this;
    }

    public function getPlatformFamilyPicture(): ?string
    {
        return $this->platformFamilyPicture;
    }

    public function setPlatformFamilyPicture(?string $platformFamilyPicture): self
    {
        $this->platformFamilyPicture = $platformFamilyPicture;

        return $this;
    }


}
