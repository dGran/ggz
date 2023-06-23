<?php

declare(strict_types=1);

namespace App\Twig\Components\Customer;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('user_dropdown_item')]
final class UserDropdownItemComponent
{
    public ?string $path = null;

    public string $name;

    public ?string $iconClass = null;

    public ?string $itemClasses = null;

    public ?string $linkClasses = null;
}
