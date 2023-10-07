<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
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
        $isValidNicknameLength = $this->isValidNicknameLength($nickname);
        $isNicknameAvailable = $this->isNicknameAvailable($nickname, $userId);

        return $isValidNicknameLength && $isNicknameAvailable;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isNicknameAvailable(string $nickname, ?int $userId = null): bool
    {
        if (!$this->userManager->isNicknameAvailable($nickname, $userId)) {
            return false;
        }

        return true;
    }

    private function isValidNicknameLength(string $nickname): bool
    {
        if ($nickname === '') {
            return false;
        }

        if (\strlen($nickname) < User::NICKNAME_MIN_CHARACTERS || \strlen($nickname) > User::NICKNAME_MAX_CHARACTERS) {
            return false;
        }

        return true;
    }
}
