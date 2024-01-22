<?php

declare(strict_types=1);

namespace App\Command;

use App\Manager\UserManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SanitizeUserCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'system:sanitize-user';

    private UserManager $userManager;

    private LoggerInterface $logger;

    public function __construct(UserManager $userManager, LoggerInterface $logger)
    {
        parent::__construct();

        $this->userManager = $userManager;
        $this->logger = $logger;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(\date(DATE_W3C).' - Start process to remove unverified users before the deadline');

        $unverifiedUsersToDelete = $this->userManager->findUnverifiedAndVerificationTimeExceeded();

        foreach ($unverifiedUsersToDelete as $user) {
            $this->logger->info('Delete unverified user with Id: '.$user->getId());
            $output->writeln(\date(DATE_W3C).' - Delete unverified user with Id: '.$user->getId());

            try {
                $this->userManager->delete($user);
            } catch (\Throwable $exception) {
                $this->logger->info(__METHOD__.'Error deleting user with Id: '.$user->getId().' - Exception: '.$exception->getMessage());
                $output->writeln(\date(DATE_W3C).' - Error deleting user with Id: '.$user->getId());
            }
        }

        $output->writeln(\date(DATE_W3C).' - End process to remove unverified users before the deadline');

        //TODO: Obtener los users, recorrerlos con el fin de logear uno a uno cada update
        $output->writeln(\date(DATE_W3C).' - Start process to delete unconfirmed email change requests before deadline');
        $this->userManager->updateEmailRequestedNotConfirmed();
        $output->writeln(\date(DATE_W3C).' - End process to delete unconfirmed email change requests before deadline');

        return Command::SUCCESS;
    }
}
