<?php

declare(strict_types=1);

namespace App\Command\Migration;

use App\Entity\Country;
use App\Manager\CountryManager;
use App\Service\CsvService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCountryCommand extends Command
{
    protected static $defaultName = 'app:country:update';

    private const DATA_SOURCE = __DIR__.'/DataSource/country_data.csv';
    private CountryManager $countryManager;
    private CsvService $csvService;

    public function __construct(CountryManager $countryManager, CsvService $csvService)
    {
        $this->countryManager = $countryManager;
        $this->csvService = $csvService;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription(
            'Update country data'
        );
    }

    /**
     * @throws NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(\date(DATE_W3C).' - Started processing country update data');

        $countries = [];
        $countriesFromSource = $this->csvService->getArrayDataFromCsvFile(self::DATA_SOURCE);

        foreach ($countriesFromSource as $countryFromSource) {
            $country = $this->countryManager->findByIsoCode($countryFromSource['iso_code']);

            $country?->setDateUpdated(new \DateTime());

            if ($country === null) {
                $country = new Country();
            }

            $country->setIsoCode($countryFromSource['iso_code']);
            $country->setNameCanonical($countryFromSource['name_canonical']);
            $country->setActive((bool)$countryFromSource['active']);

            $countries[] = $country;
        }

        $this->countryManager->saveCollection($countries);

        $output->writeln(\date(DATE_W3C).' - Finished processing country update data. Countries updated: '.\count($countries));

        return Command::SUCCESS;
    }
}