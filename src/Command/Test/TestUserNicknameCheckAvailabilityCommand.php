<?php

declare(strict_types=1);

namespace App\Command\Test;

use App\Service\UserService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TestUserNicknameCheckAvailabilityCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'test:user:nickname-availability';

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    protected function configure(): void
    {
        $this
            ->addOption('nickname', '', InputOption::VALUE_REQUIRED, 'Nickname to check availability')
            ->addOption('userId', '', InputOption::VALUE_OPTIONAL, 'User ID')
        ;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $nickname = (string)$input->getOption('nickname');
        $userId = $input->getOption('userId');

        if ($userId !== null) {
            $userId = (int)$userId;
        }

        $isNicknameAvailable = $this->userService->isNicknameAvailable($nickname, $userId);

        if ($isNicknameAvailable) {
            $output->writeln(\date(DATE_W3C).' - Nickname: "'.$nickname.'" for user with Id: '.$userId.' - <info>available</info>');

            return Command::SUCCESS;
        }

        $output->writeln(\date(DATE_W3C).' - Nickname: "'.$nickname.'" for user with Id: '.$userId.' - <error>not available</error>');

        return Command::SUCCESS;
    }
}
