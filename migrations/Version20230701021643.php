<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701021643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, INDEX IDX_4FBF094FC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contribution_state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, contribution_state_id INT DEFAULT NULL, genre_id INT DEFAULT NULL, number_of_players_id INT DEFAULT NULL, region_id INT DEFAULT NULL, country_id INT DEFAULT NULL, language_id INT DEFAULT NULL, platform_id INT DEFAULT NULL, serie_id INT DEFAULT NULL, developer_company_id INT DEFAULT NULL, publisher_company_id INT DEFAULT NULL, universe_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, original_name VARCHAR(100) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, locked TINYINT(1) NOT NULL, date_release DATETIME DEFAULT NULL, date_creation DATETIME DEFAULT NULL, date_last_update DATETIME DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, INDEX IDX_A891181FE9FAEF97 (contribution_state_id), INDEX IDX_A891181F4296D31F (genre_id), INDEX IDX_A891181F472D9B4C (number_of_players_id), INDEX IDX_A891181F98260155 (region_id), INDEX IDX_A891181FF92F3E70 (country_id), INDEX IDX_A891181F82F1BAF4 (language_id), INDEX IDX_A891181FFFE6496F (platform_id), INDEX IDX_A891181FD94388BD (serie_id), INDEX IDX_A891181F5D254210 (developer_company_id), INDEX IDX_A891181F8AD4FF42 (publisher_company_id), INDEX IDX_A891181F5CD9AF2 (universe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE number_of_players (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, platform_family_id INT DEFAULT NULL, company_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, alternate_name VARCHAR(100) DEFAULT NULL, date_release DATETIME DEFAULT NULL, generation INT DEFAULT NULL, locked TINYINT(1) NOT NULL, picture VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, links VARCHAR(255) DEFAULT NULL, INDEX IDX_3952D0CBC54C8C93 (type_id), INDEX IDX_3952D0CB30625722 (platform_family_id), INDEX IDX_3952D0CB979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform_family (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, universe_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, alternate_name VARCHAR(100) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, series_id INT DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, INDEX IDX_AA3A93345CD9AF2 (universe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE universe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, alternate_name VARCHAR(100) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, universe_id INT DEFAULT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_id INT NOT NULL, edition_id INT NOT NULL, date_created DATETIME NOT NULL, date_updated DATETIME DEFAULT NULL, INDEX IDX_3E49B4D1A76ED395 (user_id), INDEX IDX_3E49B4D1C54C8C93 (type_id), INDEX IDX_3E49B4D174281A5E (edition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FC54C8C93 FOREIGN KEY (type_id) REFERENCES company_type (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181FE9FAEF97 FOREIGN KEY (contribution_state_id) REFERENCES contribution_state (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F472D9B4C FOREIGN KEY (number_of_players_id) REFERENCES number_of_players (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181FFFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181FD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F5D254210 FOREIGN KEY (developer_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F8AD4FF42 FOREIGN KEY (publisher_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F5CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE platform ADD CONSTRAINT FK_3952D0CBC54C8C93 FOREIGN KEY (type_id) REFERENCES platform_type (id)');
        $this->addSql('ALTER TABLE platform ADD CONSTRAINT FK_3952D0CB30625722 FOREIGN KEY (platform_family_id) REFERENCES platform_family (id)');
        $this->addSql('ALTER TABLE platform ADD CONSTRAINT FK_3952D0CB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A93345CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id)');
        $this->addSql('ALTER TABLE user_list ADD CONSTRAINT FK_3E49B4D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_list ADD CONSTRAINT FK_3E49B4D1C54C8C93 FOREIGN KEY (type_id) REFERENCES list_type (id)');
        $this->addSql('ALTER TABLE user_list ADD CONSTRAINT FK_3E49B4D174281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE country DROP date_created, DROP date_updated');
        $this->addSql('ALTER TABLE currency DROP date_created, DROP date_updated');
        $this->addSql('ALTER TABLE language DROP date_created, DROP date_updated');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FC54C8C93');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181FE9FAEF97');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F4296D31F');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F472D9B4C');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F98260155');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181FF92F3E70');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F82F1BAF4');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181FFFE6496F');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181FD94388BD');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F5D254210');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F8AD4FF42');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F5CD9AF2');
        $this->addSql('ALTER TABLE platform DROP FOREIGN KEY FK_3952D0CBC54C8C93');
        $this->addSql('ALTER TABLE platform DROP FOREIGN KEY FK_3952D0CB30625722');
        $this->addSql('ALTER TABLE platform DROP FOREIGN KEY FK_3952D0CB979B1AD6');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A93345CD9AF2');
        $this->addSql('ALTER TABLE user_list DROP FOREIGN KEY FK_3E49B4D1A76ED395');
        $this->addSql('ALTER TABLE user_list DROP FOREIGN KEY FK_3E49B4D1C54C8C93');
        $this->addSql('ALTER TABLE user_list DROP FOREIGN KEY FK_3E49B4D174281A5E');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_type');
        $this->addSql('DROP TABLE contribution_state');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE list_type');
        $this->addSql('DROP TABLE number_of_players');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE platform_family');
        $this->addSql('DROP TABLE platform_type');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE universe');
        $this->addSql('DROP TABLE user_list');
        $this->addSql('ALTER TABLE language ADD date_created DATETIME NOT NULL, ADD date_updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE country ADD date_created DATETIME NOT NULL, ADD date_updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE currency ADD date_created DATETIME NOT NULL, ADD date_updated DATETIME DEFAULT NULL');
    }
}
