<?php

declare(strict_types=1);

namespace App\Service;

use App\Manager\UserManager;

class UserService
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function isValidNickname(string $nickname = null): bool
    {
        if ($nickname === null) {
            return false;
        }

        if (strlen($nickname) < 4 || strlen($nickname) > 24) {
            return false;
        }

        $user = $this->userManager->findByNickname($nickname);

        if ($user) {
            return false;
        }

        return true;
    }
}