<?php

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContributionState
 *
 * @ORM\Table(name="contribution_state")
 * @ORM\Entity
 */
class ContributionState
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcontribution_state", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontributionState;

    /**
     * @var string
     *
     * @ORM\Column(name="contribution_state_name", type="string", length=255, nullable=false)
     */
    private $contributionStateName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contribution_state_description", type="string", length=255, nullable=true)
     */
    private $contributionStateDescription;

    public function getIdcontributionState(): ?int
    {
        return $this->idcontributionState;
    }

    public function getContributionStateName(): ?string
    {
        return $this->contributionStateName;
    }

    public function setContributionStateName(string $contributionStateName): self
    {
        $this->contributionStateName = $contributionStateName;

        return $this;
    }

    public function getContributionStateDescription(): ?string
    {
        return $this->contributionStateDescription;
    }

    public function setContributionStateDescription(?string $contributionStateDescription): self
    {
        $this->contributionStateDescription = $contributionStateDescription;

        return $this;
    }


}
