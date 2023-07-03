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
    private const LIST_TYPE_PLAYING_DESCRIPTION = 'List of games you are currently playing';
    private const LIST_TYPE_WANT_TO_PLAY_DESCRIPTION = 'Don\'t forget about the games you want to play in the future!';
    private const LIST_TYPE_DONE_DESCRIPTION = 'Not completed (or can\'t be completed), but no longer interested in playing these games';
    private const LIST_TYPE_COMPLETED_DESCRIPTION = 'You consider these games completed';
    private const LIST_TYPE_FULL_COMPLETED_DESCRIPTION = 'These games have been completed to the maximum level possible (achievements or trophies included)';
    private const LIST_TYPE_WANT_LIST_DESCRIPTION = 'List of games you would like to buy in the future';
    private const LIST_TYPE_PLAYING_ICON_CLASS = 'icon-playing-list';
    private const LIST_TYPE_WANT_TO_PLAY_ICON_CLASS = 'icon-want-to-play-list';
    private const LIST_TYPE_DONE_ICON_CLASS = 'icon-done-list';
    private const LIST_TYPE_COMPLETED_ICON_CLASS = 'icon-completed-list';
    private const LIST_TYPE_FULL_COMPLETED_ICON_CLASS = 'icon-full-completed-list';
    private const LIST_TYPE_WANT_LIST_ICON_CLASS = 'icon-want-list';
    private const LIST_TYPE_PLAYING_SLUG = 'playing';
    private const LIST_TYPE_WANT_TO_PLAY_SLUG = 'want-to-play';
    private const LIST_TYPE_DONE_SLUG = 'done';
    private const LIST_TYPE_COMPLETED_SLUG = 'completed';
    private const LIST_TYPE_FULL_COMPLETED_SLUG = 'full-completed';
    private const LIST_TYPE_WANT_LIST_SLUG = 'want-list';
    public const LIST_TYPE_DATA_INDEXED_BY_ID = [
        ListType::LIST_TYPE_PLAYING_ID => [
            'name' => ListType::LIST_TYPE_PLAYING_NAME,
            'description' => self::LIST_TYPE_PLAYING_DESCRIPTION,
            'icon_class' => self::LIST_TYPE_PLAYING_ICON_CLASS,
            'slug' => self::LIST_TYPE_PLAYING_SLUG,
        ],
        ListType::LIST_TYPE_WANT_TO_PLAY_ID => [
            'name' => ListType::LIST_TYPE_WANT_TO_PLAY_NAME,
            'description' => self::LIST_TYPE_WANT_TO_PLAY_DESCRIPTION,
            'icon_class' => self::LIST_TYPE_WANT_TO_PLAY_ICON_CLASS,
            'slug' => self::LIST_TYPE_WANT_TO_PLAY_SLUG,
        ],
        ListType::LIST_TYPE_DONE_ID => [
            'name' => ListType::LIST_TYPE_DONE_NAME,
            'description' => self::LIST_TYPE_DONE_DESCRIPTION,
            'icon_class' => self::LIST_TYPE_DONE_ICON_CLASS,
            'slug' => self::LIST_TYPE_DONE_SLUG,
        ],
        ListType::LIST_TYPE_COMPLETED_ID => [
            'name' => ListType::LIST_TYPE_COMPLETED_NAME,
            'description' => self::LIST_TYPE_COMPLETED_DESCRIPTION,
            'icon_class' => self::LIST_TYPE_COMPLETED_ICON_CLASS,
            'slug' => self::LIST_TYPE_COMPLETED_SLUG,
        ],
        ListType::LIST_TYPE_FULL_COMPLETED_ID => [
            'name' => ListType::LIST_TYPE_FULL_COMPLETED_NAME,
            'description' => self::LIST_TYPE_FULL_COMPLETED_DESCRIPTION,
            'icon_class' => self::LIST_TYPE_FULL_COMPLETED_ICON_CLASS,
            'slug' => self::LIST_TYPE_FULL_COMPLETED_SLUG,
        ],
        ListType::LIST_TYPE_WANT_LIST_ID => [
            'name' => ListType::LIST_TYPE_WANT_LIST_NAME,
            'description' => self::LIST_TYPE_WANT_LIST_DESCRIPTION,
            'icon_class' => self::LIST_TYPE_WANT_LIST_ICON_CLASS,
            'slug' => self::LIST_TYPE_WANT_LIST_SLUG,
        ],
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $iconClass = null;

    #[ORM\Column(length: 255)]
    private string $slug;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ListType
    {
        $this->description = $description;

        return $this;
    }

    public function getIconClass(): ?string
    {
        return $this->iconClass;
    }

    public function setIconClass(?string $iconClass): ListType
    {
        $this->iconClass = $iconClass;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): ListType
    {
        $this->slug = $slug;

        return $this;
    }

    public function __toString()
    {
        return $this->slug;
    }
}
