<?php

declare(strict_types=1);

namespace App\Tests\App\Service;

use App\Manager\UserManager;
use App\Service\UserService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    /** @var UserManager&MockObject */
    private $userManager;

    public function setUp(): void
    {
        $this->userManager = $this->createMock(UserManager::class);
        $this->userService = new UserService($this->userManager);
    }

    /**
     * @dataProvider isValidNicknameProvider
     */
    public function testIsValidNickname(string $nickname, bool $available, bool $expected): void
    {
        $this->userManager->method('isNicknameAvailable')->willReturn($available);

        $isValidNickname = $this->userService->isValidNickname($nickname);

        self::assertEquals($expected, $isValidNickname);
    }

    public function isValidNicknameProvider(): \iterator
    {
        yield 'nickname available: length less than the minimum required characters' => [
            'nickname' => $this->getNickname(3),
            'available' => true,
            'expected' => false,
        ];

        yield 'nickname available: length greater than the maximum number of characters allowed' => [
            'nickname' => $this->getNickname(25),
            'available' => true,
            'expected' => false,
        ];

        yield 'nickname available: minimum length of characters required' => [
            'nickname' => $this->getNickname(4),
            'available' => true,
            'expected' => true,
        ];

        yield 'nickname not available: minimum length of characters required' => [
            'nickname' => $this->getNickname(4),
            'available' => false,
            'expected' => false,
        ];

        yield 'nickname available: maximum length of characters allowed' => [
            'nickname' => $this->getNickname(24),
            'available' => true,
            'expected' => true,
        ];

        yield 'nickname not available: maximum length of characters allowed' => [
            'nickname' => $this->getNickname(24),
            'available' => false,
            'expected' => false,
        ];

        yield 'nickname available: length greater than the minimum number of characters required and less than the maximum number of characters allowed' => [
            'nickname' => $this->getNickname(8),
            'available' => true,
            'expected' => true,
        ];

        yield 'nickname not available: length greater than the minimum number of characters required and less than the maximum number of characters allowed' => [
            'nickname' => $this->getNickname(8),
            'available' => false,
            'expected' => false,
        ];
    }

    private function getNickname($length): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return \substr(\str_shuffle($characters), 0, $length);
    }
}