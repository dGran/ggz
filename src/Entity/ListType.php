<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ListTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListTypeRepository::class)]
class ListType
{
    private const LIST_TYPE_PLAYING_ID = 1;
    private const LIST_TYPE_WANT_TO_PLAY_ID = 2;
    private const LIST_TYPE_DONE_ID = 3;
    private const LIST_TYPE_COMPLETED_ID = 4;
    private const LIST_TYPE_FULL_COMPLETED_ID = 5;
    private const LIST_TYPE_WANT_LIST_ID = 6;
    private const LIST_TYPE_PLAYING_NAME = 'playing';
    private const LIST_TYPE_WANT_TO_PLAY_NAME = 'want to play';
    private const LIST_TYPE_DONE_NAME = 'done';
    private const LIST_TYPE_COMPLETED_NAME = 'completed';
    private const LIST_TYPE_FULL_COMPLETED_NAME = '100% completed';
    private const LIST_TYPE_WANT_LIST_NAME = 'want list';
    public const LIST_TYPE_DATA_INDEXED_BY_ID = [
        ListType::LIST_TYPE_PLAYING_ID => ListType::LIST_TYPE_PLAYING_NAME,
        ListType::LIST_TYPE_WANT_TO_PLAY_ID => ListType::LIST_TYPE_WANT_TO_PLAY_NAME,
        ListType::LIST_TYPE_DONE_ID => ListType::LIST_TYPE_DONE_NAME,
        ListType::LIST_TYPE_COMPLETED_ID => ListType::LIST_TYPE_COMPLETED_NAME,
        ListType::LIST_TYPE_FULL_COMPLETED_ID => ListType::LIST_TYPE_FULL_COMPLETED_NAME,
        ListType::LIST_TYPE_WANT_LIST_ID => ListType::LIST_TYPE_WANT_LIST_NAME,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ListType
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): ListType
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
