<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlatformType
 *
 * @ORM\Table(name="platform_type")
 * @ORM\Entity
 */
class PlatformType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idplatform_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplatformType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="string", length=250, nullable=true)
     */
    private $picture;

    public function getIdplatformType(): ?int
    {
        return $this->idplatformType;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }


}
