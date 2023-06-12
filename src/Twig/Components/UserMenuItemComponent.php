<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('user_menu_item')]
final class UserMenuItemComponent
{
    public ?string $url = null;

    public string $name;

    public ?string $svgPath = null;
}
