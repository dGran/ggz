<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624021111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name_canonical VARCHAR(50) NOT NULL, iso_code VARCHAR(10) NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_5373C966D322CED6 (name_canonical), UNIQUE INDEX UNIQ_5373C96662B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name_canonical VARCHAR(50) NOT NULL, iso_code VARCHAR(10) NOT NULL, conversion_rate DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_6956883FD322CED6 (name_canonical), UNIQUE INDEX UNIQ_6956883F62B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, iso_code VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_D4DB71B562B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_currency (language_id INT NOT NULL, currency_id INT NOT NULL, INDEX IDX_5F4D00582F1BAF4 (language_id), INDEX IDX_5F4D00538248176 (currency_id), PRIMARY KEY(language_id, currency_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language_currency ADD CONSTRAINT FK_5F4D00582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_currency ADD CONSTRAINT FK_5F4D00538248176 FOREIGN KEY (currency_id) REFERENCES currency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE date_updated date_updated DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language_currency DROP FOREIGN KEY FK_5F4D00582F1BAF4');
        $this->addSql('ALTER TABLE language_currency DROP FOREIGN KEY FK_5F4D00538248176');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_currency');
        $this->addSql('ALTER TABLE user CHANGE date_updated date_updated DATETIME DEFAULT NULL');
    }
}
