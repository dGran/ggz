<?php

declare(strict_types=1);

namespace App\Command\Migration;

use App\Manager\CompanyManager;
use App\Manager\PlatformFamilyManager;
use App\Manager\PlatformManager;
use App\Manager\PlatformTypeManager;
use App\Service\CsvService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdatePlatformCommand extends Command
{
    protected static $defaultName = 'app:platform:update';

    private const DATA_SOURCE = __DIR__.'/DataSource/platform_data.csv';
    private CsvService $csvService;
    private PlatformManager $platformManager;
    private PlatformTypeManager $platformTypeManager;
    private PlatformFamilyManager $platformFamilyManager;
    private CompanyManager $companyManager;

    public function __construct(
        CsvService $csvService,
        PlatformManager $platformManager,
        PlatformTypeManager $platformTypeManager,
        PlatformFamilyManager $platformFamilyManager,
        CompanyManager $companyManager
    ) {
        $this->csvService = $csvService;
        $this->platformManager = $platformManager;
        $this->platformTypeManager = $platformTypeManager;
        $this->platformFamilyManager = $platformFamilyManager;
        $this->companyManager = $companyManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription(
            'Update platform data from .csv file'
        );
    }

    /**
     * @throws NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(\date(DATE_W3C).' - Started processing platform update data');

        $platformsFromSource = $this->csvService->getArrayDataFromCsvFile(self::DATA_SOURCE, CsvService::DELIMITER_SEMICOLON);
        $platforms = [];

        foreach ($platformsFromSource as $platformFromSource) {
            $platformFromSourceName = $platformFromSource["name"];

            if ($platformFromSourceName === null) {
                continue;
            }

            try {
                $platform = $this->platformManager->findByNameAndTypeNameAndFamilyNameAndCompanyName($platformFromSourceName);
            } catch (\Throwable $exception) {
                $output->writeln(\date(DATE_W3C).' - Skipped platform with name: "'.$platformFromSourceName.'", Error: '.$exception->getMessage());

                continue;
            }

            if ($platform === null) {
                $platform = $this->platformManager->create();
                $platform->setName($platformFromSourceName);
            }

            $platformFromSourceTypeName = $platformFromSource["type"];

            if ($platformFromSourceTypeName !== null) {
                $platformType = $this->platformTypeManager->findByName($platformFromSourceTypeName);

                if ($platformType === null) {
                    $platformType = $this->platformTypeManager->create();
                    $platformType->setName($platformFromSourceTypeName);
                    $this->platformTypeManager->save($platformType);
                }

                $platform->setType($platformType);
            }

            $platformFromSourceFamilyName = $platformFromSource["family"];

            if ($platformFromSourceFamilyName !== null) {
                $platformFamily = $this->platformFamilyManager->findByName($platformFromSourceFamilyName);

                if ($platformFamily === null) {
                    $platformFamily = $this->platformFamilyManager->create();
                    $platformFamily->setName($platformFromSourceFamilyName);
                    $this->platformFamilyManager->save($platformFamily);
                }

                $platform->setPlatformFamily($platformFamily);
            }

            $platformFromSourceCompanyName = $platformFromSource["company"];

            if ($platformFromSourceCompanyName !== null) {
                $company = $this->companyManager->findByName($platformFromSourceCompanyName);

                if ($company === null) {
                    $company = $this->companyManager->create();
                    $company->setName($platformFromSourceCompanyName);
                    $this->companyManager->save($company);
                }

                $platform->setCompany($company);
            }

            $platform->setAlternateName($platformFromSource["alternate_name"]);
            $platform->setGeneration((int)$platformFromSource["generation"]);
            $platform->setLocked((bool)$platformFromSource["locked"]);

            $platforms[] = $platform;
        }

        $this->platformManager->saveCollection($platforms);

        $output->writeln(\date(DATE_W3C).' - Finished processing platform update data. Platforms updated: '.\count($platforms));

        return Command::SUCCESS;
    }
}