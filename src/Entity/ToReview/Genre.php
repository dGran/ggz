<?php

declare(strict_types=1);

namespace App\Entity\ToReview;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idgenre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgenre;

    /**
     * @var string
     *
     * @ORM\Column(name="genre_name", type="string", length=255, nullable=false)
     */
    private $genreName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="genre_description", type="string", length=255, nullable=true)
     */
    private $genreDescription;

    public function getIdgenre(): ?int
    {
        return $this->idgenre;
    }

    public function getGenreName(): ?string
    {
        return $this->genreName;
    }

    public function setGenreName(string $genreName): self
    {
        $this->genreName = $genreName;

        return $this;
    }

    public function getGenreDescription(): ?string
    {
        return $this->genreDescription;
    }

    public function setGenreDescription(?string $genreDescription): self
    {
        $this->genreDescription = $genreDescription;

        return $this;
    }


}
