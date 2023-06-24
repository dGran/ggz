<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230624052216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name_canonical VARCHAR(50) NOT NULL, iso_code VARCHAR(10) NOT NULL, iso_code_language VARCHAR(10) NOT NULL, country_zone_name VARCHAR(255) DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5373C966D322CED6 (name_canonical), UNIQUE INDEX UNIQ_5373C96662B6A45E (iso_code), UNIQUE INDEX UNIQ_5373C9666815938C (iso_code_language), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name_canonical VARCHAR(50) NOT NULL, iso_code VARCHAR(10) NOT NULL, conversion_rate DOUBLE PRECISION DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6956883FD322CED6 (name_canonical), UNIQUE INDEX UNIQ_6956883F62B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, iso_code VARCHAR(10) DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D4DB71B562B6A45E (iso_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_currency (language_id INT NOT NULL, currency_id INT NOT NULL, INDEX IDX_5F4D00582F1BAF4 (language_id), INDEX IDX_5F4D00538248176 (currency_id), PRIMARY KEY(language_id, currency_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(30) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', birthdate DATETIME DEFAULT NULL, profile_pic VARCHAR(255) DEFAULT NULL, share_content VARCHAR(255) DEFAULT NULL, on_boarding_complete TINYINT(1) NOT NULL, accept_mailing TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649A188FE64 (nickname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language_currency ADD CONSTRAINT FK_5F4D00582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_currency ADD CONSTRAINT FK_5F4D00538248176 FOREIGN KEY (currency_id) REFERENCES currency (id) ON DELETE CASCADE');
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
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
