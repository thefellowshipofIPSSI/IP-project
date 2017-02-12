<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170211140018 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE candidacy');
        $this->addSql('DROP TABLE expense_type');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_offer_skill');
        $this->addSql('DROP TABLE job_offer_user');
        $this->addSql('DROP TABLE user_cv');
        $this->addSql('DROP TABLE vacation_request');
        $this->addSql('DROP TABLE vacation_response');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E16FE72E1');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EDE12AB56');
        $this->addSql('DROP INDEX UNIQ_288A3A4EDE12AB56 ON job_offer');
        $this->addSql('DROP INDEX UNIQ_288A3A4E16FE72E1 ON job_offer');
        $this->addSql('ALTER TABLE job_offer ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL, DROP updated_by, DROP created_by');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_288A3A4EB03A8386 ON job_offer (created_by_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_288A3A4E896DBBDE ON job_offer (updated_by_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE candidacy (id INT AUTO_INCREMENT NOT NULL, job_offer_id INT DEFAULT NULL, user_id INT NOT NULL, creationDate DATETIME NOT NULL, modificationDate DATETIME DEFAULT NULL, freeText LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_D930569D3481D195 (job_offer_id), INDEX IDX_D930569DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, created_by_id INT NOT NULL, INDEX IDX_FBD8E0F8B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer_skill (job_offer_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_BE7C82D73481D195 (job_offer_id), INDEX IDX_BE7C82D75585C142 (skill_id), PRIMARY KEY(job_offer_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer_user (job_offer_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_191C68433481D195 (job_offer_id), INDEX IDX_191C6843A76ED395 (user_id), PRIMARY KEY(job_offer_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cv (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, creationDate DATETIME NOT NULL, modificationDate DATETIME DEFAULT NULL, user_id INT NOT NULL, user_validation_id INT DEFAULT NULL, INDEX IDX_AE384A57A76ED395 (user_id), INDEX IDX_AE384A574CA9E500 (user_validation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation_request (id INT AUTO_INCREMENT NOT NULL, beginDate DATETIME NOT NULL, endDate DATETIME NOT NULL, nbDays INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation_response (id INT AUTO_INCREMENT NOT NULL, signatureManagerDate DATETIME DEFAULT NULL, signatureCEODate DATETIME DEFAULT NULL, status INT NOT NULL, comments LONGTEXT NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EB03A8386');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E896DBBDE');
        $this->addSql('DROP INDEX UNIQ_288A3A4EB03A8386 ON job_offer');
        $this->addSql('DROP INDEX UNIQ_288A3A4E896DBBDE ON job_offer');
        $this->addSql('ALTER TABLE job_offer ADD updated_by INT DEFAULT NULL, ADD created_by INT DEFAULT NULL, DROP created_by_id, DROP updated_by_id');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E16FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_288A3A4EDE12AB56 ON job_offer (created_by)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_288A3A4E16FE72E1 ON job_offer (updated_by)');
    }
}
