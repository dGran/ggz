<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CsvService
{
    public const DELIMITER_COMMA = ',';
    public const DELIMITER_SEMICOLON = ';';

    public function getArrayDataFromCsvFile(string $dataSource, string $delimiter): array
    {
        $dataSource = \file_get_contents($dataSource);

        return (new Serializer([new ObjectNormalizer()], [new CsvEncoder()]))->decode($dataSource, 'csv', [CsvEncoder::DELIMITER_KEY => $delimiter]);
    }
}