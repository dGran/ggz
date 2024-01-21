<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Manager\UserManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class UserService
{
    public const EMAIL_PATTERN = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/';

    private const CODE_200_PATTERN = '/^HTTP\/\d+\.\d+\s+200\s+OK/';

    private UserManager $userManager;

    private ParameterBagInterface $parameterBag;

    public function __construct(UserManager $userManager, ParameterBagInterface $parameterBag)
    {
        $this->userManager = $userManager;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function isValidEmail(string $email): bool
    {
        if (!$email) {
            return false;
        }

        $isValidEmailSyntax = \preg_match(self::EMAIL_PATTERN, $email);
        $isEmailAvailable = $this->userManager->isEmailAvailable($email);

        return $isValidEmailSyntax && $isEmailAvailable;
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

    public function getProfilePicPath(User $user): string
    {
        $avatarPath = $this->parameterBag->get('kernel.project_dir').'/public/'.User::PROFILE_PIC_PATH;

        if (!empty($user->getProfilePic())) {
            $avatarFullPath = $avatarPath.$user->getProfilePic();

            if (\file_exists($avatarFullPath)) {
                // TODO: usar getHeaders solo para imagenes externas, cuando el registro es de google o facebook y almacenamos su imagen
                // en estos casos posteriormente puede el usuario actualizar su imagen
//                $headers = get_headers($avatarFullPath);
//
//                if ($headers && preg_match(self::CODE_200_PATTERN, $headers[0])) {
                    return User::PROFILE_PIC_PATH.$user->getProfilePicPath();
//                }
            }
        }

        return User::PROFILE_PIC_PATH.User::DEFAULT_PROFILE_PIC;
    }
}
