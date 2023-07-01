<?php

declare(strict_types=1);

namespace App\Command\Migration;

use App\Entity\ListType;
use App\Manager\ListTypeManager;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeListTypeCommand extends Command
{
    protected static $defaultName = 'app:list-type:initialize';

    private const LIST_TYPE_DATA_INDEXED_BY_ID = [
        ListType::LIST_TYPE_PLAYING_ID => ListType::LIST_TYPE_PLAYING_NAME,
        ListType::LIST_TYPE_WANT_TO_PLAY_ID => ListType::LIST_TYPE_WANT_TO_PLAY_NAME,
        ListType::LIST_TYPE_DONE_ID => ListType::LIST_TYPE_DONE_NAME,
        ListType::LIST_TYPE_COMPLETED_ID => ListType::LIST_TYPE_COMPLETED_NAME,
        ListType::LIST_TYPE_FULL_COMPLETED_ID => ListType::LIST_TYPE_FULL_COMPLETED_NAME,
        ListType::LIST_TYPE_WANT_LIST_ID => ListType::LIST_TYPE_WANT_LIST_NAME,
    ];

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

    /**
     * @throws NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(\date(DATE_W3C).' - Started processing list type initialize data');

        $counterAdded = 0;

        foreach (self::LIST_TYPE_DATA_INDEXED_BY_ID as $listTypeId => $listTypeName) {
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