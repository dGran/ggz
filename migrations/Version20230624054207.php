<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624054207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5373C9666815938C ON country');
        $this->addSql('ALTER TABLE country CHANGE iso_code_language language_iso_code VARCHAR(10) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C966E14FC64 ON country (language_iso_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5373C966E14FC64 ON country');
        $this->addSql('ALTER TABLE country CHANGE language_iso_code iso_code_language VARCHAR(10) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9666815938C ON country (iso_code_language)');
    }
}
