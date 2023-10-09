<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Manager\UserManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class UserService
{
    private const EMAIL_PATTERN = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/';

    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function isValidEmail(string $email): bool
    {
        if (!$email) {
            return false;
        }

        $isValidEmailSyntax = \preg_match(self::EMAIL_PATTERN, $email);
        $isEmailAvailable = $this->isEmailAvailable($email);

        return $isValidEmailSyntax && $isEmailAvailable;
    }

    public function isEmailAvailable(string $email): bool
    {
        if (!$email) {
            return false;
        }

        if (!empty($this->userManager->findByEmail($email))) {
            return false;
        }

        return true;
    }

    public function isValidPassword(string $password): bool
    {
        $hasUppercase = \preg_match('/[A-Z]/', $password);
        $hasNumber = \preg_match('/\d/', $password);
        $isValidLength = \strlen($password) >= User::PASSWORD_MIN_CHARACTERS && \strlen($password) <= User::PASSWORD_MAX_CHARACTERS;

        return $hasUppercase && $hasNumber && $isValidLength;
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
