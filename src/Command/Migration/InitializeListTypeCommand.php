<?php

declare(strict_types=1);

namespace App\Command\Migration;

use App\Entity\ListType;
use App\Manager\ListTypeManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeListTypeCommand extends Command
{
    protected static $defaultName = 'app:list-type:initialize';

    private ListTypeManager $listTypeManager;

    public function __construct(ListTypeManager $listTypeManager)
    {
        $this->listTypeManager = $listTypeManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription(
            'Initialize list type data'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(\date(DATE_W3C).' - Started processing list type initialize data');

        $counterAdded = 0;

        foreach (ListType::LIST_TYPE_DATA_INDEXED_BY_ID as $listTypeId => $listTypeName) {
            $listType = $this->listTypeManager->create();
            $listType->setId($listTypeId);
            $listType->setName($listTypeName);

            try {
                $this->listTypeManager->save($listType);
                $counterAdded++;
                $output->writeln(\date(DATE_W3C).' - Added "'.$listTypeName.'" list type');
            } catch (\Throwable $exception) {
                continue;
            }
        }

        $output->writeln(\date(DATE_W3C).' - Finished processing list type initialize data. List types added: '.$counterAdded);

        return Command::SUCCESS;
    }
}