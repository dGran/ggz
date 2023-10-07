<?php

declare(strict_types=1);

namespace App\Service;

use App\Manager\UserManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class UserService
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isValidNickname(string $nickname, ?int $userId = null): bool
    {
        if ($nickname === '') {
            return false;
        }

        if (\strlen($nickname) < 4 || \strlen($nickname) > 24) {
            return false;
        }

        if ($this->userManager->isNicknameAvailable($nickname, $userId)) {
            return false;
        }

        return true;
    }
}
