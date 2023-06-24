<?php

declare(strict_types=1);

namespace App\Command\Migration;

use App\Entity\Language;
use App\Manager\LanguageManager;
use App\Service\CsvService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateLanguageCommand extends Command
{
    protected static $defaultName = 'app:language:update';

    private const DATA_SOURCE = __DIR__.'/DataSource/language_data.csv';
    private LanguageManager $languageManager;
    private CsvService $csvService;

    public function __construct(LanguageManager $languageManager, CsvService $csvService)
    {
        $this->languageManager = $languageManager;
        $this->csvService = $csvService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription(
            'Update language data'
        );
    }

    /**
     * @throws NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(\date(DATE_W3C).' - Started processing language update data');

        $languages = [];
        $languagesFromSource = $this->csvService->getArrayDataFromCsvFile(self::DATA_SOURCE, CsvService::DELIMITER_COMMA);

        foreach ($languagesFromSource as $languageFromSource) {
            $language = $this->languageManager->findByIsoCode($languageFromSource['iso_code']);

            $language?->setDateUpdated(new \DateTime());

            if ($language === null) {
                $language = new Language();
            }

            $language->setIsoCode($languageFromSource['iso_code']);
            $language->setName($languageFromSource['name']);

            $languages[] = $language;
        }

        $this->languageManager->saveCollection($languages);

        $output->writeln(\date(DATE_W3C).' - Finished processing language update data. Languages updated: '.\count($languages));

        return Command::SUCCESS;
    }
}