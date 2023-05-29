<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ratings
 *
 * @ORM\Table(name="ratings", indexes={@ORM\Index(name="pk_ratings_user_id_idx", columns={"ratings_user_id"})})
 * @ORM\Entity
 */
class Ratings
{
    /**
     * @var int
     *
     * @ORM\Column(name="idratings", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idratings;

    /**
     * @var int
     *
     * @ORM\Column(name="ratings_game_id", type="integer", nullable=false)
     */
    private $ratingsGameId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ratings_creation_date", type="datetime", nullable=false)
     */
    private $ratingsCreationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ratings_last_edit_date", type="datetime", nullable=true)
     */
    private $ratingsLastEditDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ratings_review", type="string", length=255, nullable=true)
     */
    private $ratingsReview;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ratings_review_creation_date", type="datetime", nullable=true)
     */
    private $ratingsReviewCreationDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ratings_review_last_edit_date", type="datetime", nullable=true)
     */
    private $ratingsReviewLastEditDate;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ratings_user_id", referencedColumnName="id")
     * })
     */
    private $ratingsUser;

    public function getIdratings(): ?int
    {
        return $this->idratings;
    }

    public function getRatingsGameId(): ?int
    {
        return $this->ratingsGameId;
    }

    public function setRatingsGameId(int $ratingsGameId): self
    {
        $this->ratingsGameId = $ratingsGameId;

        return $this;
    }

    public function getRatingsCreationDate(): ?\DateTimeInterface
    {
        return $this->ratingsCreationDate;
    }

    public function setRatingsCreationDate(\DateTimeInterface $ratingsCreationDate): self
    {
        $this->ratingsCreationDate = $ratingsCreationDate;

        return $this;
    }

    public function getRatingsLastEditDate(): ?\DateTimeInterface
    {
        return $this->ratingsLastEditDate;
    }

    public function setRatingsLastEditDate(?\DateTimeInterface $ratingsLastEditDate): self
    {
        $this->ratingsLastEditDate = $ratingsLastEditDate;

        return $this;
    }

    public function getRatingsReview(): ?string
    {
        return $this->ratingsReview;
    }

    public function setRatingsReview(?string $ratingsReview): self
    {
        $this->ratingsReview = $ratingsReview;

        return $this;
    }

    public function getRatingsReviewCreationDate(): ?\DateTimeInterface
    {
        return $this->ratingsReviewCreationDate;
    }

    public function setRatingsReviewCreationDate(?\DateTimeInterface $ratingsReviewCreationDate): self
    {
        $this->ratingsReviewCreationDate = $ratingsReviewCreationDate;

        return $this;
    }

    public function getRatingsReviewLastEditDate(): ?\DateTimeInterface
    {
        return $this->ratingsReviewLastEditDate;
    }

    public function setRatingsReviewLastEditDate(?\DateTimeInterface $ratingsReviewLastEditDate): self
    {
        $this->ratingsReviewLastEditDate = $ratingsReviewLastEditDate;

        return $this;
    }

    public function getRatingsUser(): ?User
    {
        return $this->ratingsUser;
    }

    public function setRatingsUser(?User $ratingsUser): self
    {
        $this->ratingsUser = $ratingsUser;

        return $this;
    }


}
