<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624043529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country ADD date_created DATETIME NOT NULL, ADD date_updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE currency ADD date_created DATETIME NOT NULL, ADD date_updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE language ADD date_created DATETIME NOT NULL, ADD date_updated DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language DROP date_created, DROP date_updated');
        $this->addSql('ALTER TABLE country DROP date_created, DROP date_updated');
        $this->addSql('ALTER TABLE currency DROP date_created, DROP date_updated');
    }
}
