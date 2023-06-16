<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Credits
 *
 * @ORM\Table(name="credits")
 * @ORM\Entity
 */
class Credits
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcredits", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcredits;

    /**
     * @var string
     *
     * @ORM\Column(name="credits_name", type="string", length=255, nullable=false)
     */
    private $creditsName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="credits_alternate_name", type="string", length=255, nullable=true)
     */
    private $creditsAlternateName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="credits_picture", type="string", length=255, nullable=true)
     */
    private $creditsPicture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="credits_description", type="string", length=255, nullable=true)
     */
    private $creditsDescription;

    public function getIdcredits(): ?int
    {
        return $this->idcredits;
    }

    public function getCreditsName(): ?string
    {
        return $this->creditsName;
    }

    public function setCreditsName(string $creditsName): self
    {
        $this->creditsName = $creditsName;

        return $this;
    }

    public function getCreditsAlternateName(): ?string
    {
        return $this->creditsAlternateName;
    }

    public function setCreditsAlternateName(?string $creditsAlternateName): self
    {
        $this->creditsAlternateName = $creditsAlternateName;

        return $this;
    }

    public function getCreditsPicture(): ?string
    {
        return $this->creditsPicture;
    }

    public function setCreditsPicture(?string $creditsPicture): self
    {
        $this->creditsPicture = $creditsPicture;

        return $this;
    }

    public function getCreditsDescription(): ?string
    {
        return $this->creditsDescription;
    }

    public function setCreditsDescription(?string $creditsDescription): self
    {
        $this->creditsDescription = $creditsDescription;

        return $this;
    }


}
