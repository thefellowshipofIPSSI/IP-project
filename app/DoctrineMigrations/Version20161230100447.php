<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161230100447 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE skill_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_B66FFE9293CB796C (file_id), INDEX IDX_B66FFE92A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_candidacy (id INT AUTO_INCREMENT NOT NULL, updated_by INT DEFAULT NULL, closed_by INT DEFAULT NULL, offer_id INT DEFAULT NULL, candidate_id INT DEFAULT NULL, content LONGTEXT NOT NULL, status INT NOT NULL, decision LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1E80B98C16FE72E1 (updated_by), UNIQUE INDEX UNIQ_1E80B98C88F6E01 (closed_by), INDEX IDX_1E80B98C53C674EE (offer_id), INDEX IDX_1E80B98C91BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE society (id INT AUTO_INCREMENT NOT NULL, logo INT DEFAULT NULL, name VARCHAR(150) NOT NULL, address VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(10) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, primary_phone VARCHAR(15) DEFAULT NULL, secondary_phone VARCHAR(15) DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, presentation LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_D6461F2E48E9A13 (logo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5E3DE4775E237E06 (name), INDEX IDX_5E3DE477C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, updated_by INT DEFAULT NULL, society_id INT DEFAULT NULL, type_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, contract VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, duration VARCHAR(100) DEFAULT NULL, location VARCHAR(100) NOT NULL, salary NUMERIC(10, 0) DEFAULT NULL, currency VARCHAR(15) DEFAULT NULL, begin_date VARCHAR(30) NOT NULL, link VARCHAR(100) DEFAULT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_288A3A4EDE12AB56 (created_by), UNIQUE INDEX UNIQ_288A3A4E16FE72E1 (updated_by), INDEX IDX_288A3A4EE6389D24 (society_id), INDEX IDX_288A3A4EC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offers_skills (offer_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_880D1E2F53C674EE (offer_id), INDEX IDX_880D1E2F5585C142 (skill_id), PRIMARY KEY(offer_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, path TINYTEXT NOT NULL, type TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_vacation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_validation_id INT DEFAULT NULL, creationDate DATETIME NOT NULL, modificationDate DATETIME DEFAULT NULL, beginDate DATETIME NOT NULL, endDate DATETIME NOT NULL, nbDays INT NOT NULL, comment LONGTEXT DEFAULT NULL, status INT NOT NULL, INDEX IDX_3573B75A76ED395 (user_id), INDEX IDX_3573B754CA9E500 (user_validation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, page_category_id INT NOT NULL, page_template_id INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, metaDescription LONGTEXT DEFAULT NULL, metaKeywords LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, status INT NOT NULL, dateCreation DATETIME NOT NULL, dateUpdate DATETIME NOT NULL, INDEX IDX_140AB620A76ED395 (user_id), INDEX IDX_140AB6205FAC390 (page_category_id), INDEX IDX_140AB620126651CA (page_template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_expense (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_validation_id INT DEFAULT NULL, creationDate DATETIME NOT NULL, modificationDate DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, beginDate DATETIME NOT NULL, endDate DATETIME NOT NULL, status INT DEFAULT 0 NOT NULL, validationDate DATETIME DEFAULT NULL, INDEX IDX_753793ACA76ED395 (user_id), INDEX IDX_753793AC4CA9E500 (user_validation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, creationDate DATETIME NOT NULL, modificationDate DATETIME DEFAULT NULL, title VARCHAR(255) NOT NULL, resume VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, status INT NOT NULL, metaDescription VARCHAR(255) NOT NULL, metaTitle VARCHAR(255) NOT NULL, INDEX IDX_1DD39950A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cra (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_validation_id INT DEFAULT NULL, creationDate DATETIME NOT NULL, modificationDate DATETIME DEFAULT NULL, projectName VARCHAR(255) NOT NULL, activityReport LONGTEXT NOT NULL, beginDate DATETIME NOT NULL, endDate DATETIME NOT NULL, status INT DEFAULT 0 NOT NULL, nbLostTimeAccident INT DEFAULT 0 NOT NULL, nbNoneLostTimeAccident INT DEFAULT 0 NOT NULL, nbTravelAccident INT DEFAULT 0 NOT NULL, nbSickDay INT DEFAULT 0 NOT NULL, nbVacancyDay INT DEFAULT 0 NOT NULL, clientSatisfaction LONGTEXT NOT NULL, consultantSatisfaction LONGTEXT NOT NULL, ameliorationPoint LONGTEXT NOT NULL, leftActivity LONGTEXT DEFAULT NULL, comments LONGTEXT DEFAULT NULL, client VARCHAR(255) NOT NULL, client_validation INT DEFAULT NULL, client_validation_date DATETIME DEFAULT NULL, INDEX IDX_797A875AA76ED395 (user_id), INDEX IDX_797A875A4CA9E500 (user_validation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_line (id INT AUTO_INCREMENT NOT NULL, user_expense_id INT NOT NULL, expenseLineDate DATETIME NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_65B3FA9454F21D97 (user_expense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_profile (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, user_id INT DEFAULT NULL, pseudo VARCHAR(100) NOT NULL, gravatar TINYINT(1) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, birth_date DATE DEFAULT NULL, other VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D95AB40586CC499D (pseudo), UNIQUE INDEX UNIQ_D95AB40586383B10 (avatar_id), UNIQUE INDEX UNIQ_D95AB405A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_newsletter (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, email VARCHAR(150) NOT NULL, enabled TINYINT(1) NOT NULL, createdAt DATETIME NOT NULL, updatedAt DATETIME NOT NULL, UNIQUE INDEX UNIQ_D9E24324E7927C74 (email), UNIQUE INDEX UNIQ_D9E24324A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, society_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', google_id VARCHAR(255) DEFAULT NULL, google_access_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX IDX_8D93D649E6389D24 (society_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_skills (user_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_B0630D4DA76ED395 (user_id), INDEX IDX_B0630D4D5585C142 (skill_id), PRIMARY KEY(user_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_4B019DDB5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9293CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_candidacy ADD CONSTRAINT FK_1E80B98C16FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_candidacy ADD CONSTRAINT FK_1E80B98C88F6E01 FOREIGN KEY (closed_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_candidacy ADD CONSTRAINT FK_1E80B98C53C674EE FOREIGN KEY (offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE job_candidacy ADD CONSTRAINT FK_1E80B98C91BD8781 FOREIGN KEY (candidate_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE society ADD CONSTRAINT FK_D6461F2E48E9A13 FOREIGN KEY (logo) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477C54C8C93 FOREIGN KEY (type_id) REFERENCES skill_type (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E16FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EE6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EC54C8C93 FOREIGN KEY (type_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_offers_skills ADD CONSTRAINT FK_880D1E2F53C674EE FOREIGN KEY (offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offers_skills ADD CONSTRAINT FK_880D1E2F5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_vacation ADD CONSTRAINT FK_3573B75A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_vacation ADD CONSTRAINT FK_3573B754CA9E500 FOREIGN KEY (user_validation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6205FAC390 FOREIGN KEY (page_category_id) REFERENCES page_category (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620126651CA FOREIGN KEY (page_template_id) REFERENCES page_template (id)');
        $this->addSql('ALTER TABLE user_expense ADD CONSTRAINT FK_753793ACA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_expense ADD CONSTRAINT FK_753793AC4CA9E500 FOREIGN KEY (user_validation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_cra ADD CONSTRAINT FK_797A875AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_cra ADD CONSTRAINT FK_797A875A4CA9E500 FOREIGN KEY (user_validation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE expense_line ADD CONSTRAINT FK_65B3FA9454F21D97 FOREIGN KEY (user_expense_id) REFERENCES user_expense (id)');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB40586383B10 FOREIGN KEY (avatar_id) REFERENCES file (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB405A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_newsletter ADD CONSTRAINT FK_D9E24324A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E6389D24 FOREIGN KEY (society_id) REFERENCES society (id)');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_group (id)');
        $this->addSql('ALTER TABLE user_skills ADD CONSTRAINT FK_B0630D4DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_skills ADD CONSTRAINT FK_B0630D4D5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477C54C8C93');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EE6389D24');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E6389D24');
        $this->addSql('ALTER TABLE job_offers_skills DROP FOREIGN KEY FK_880D1E2F5585C142');
        $this->addSql('ALTER TABLE user_skills DROP FOREIGN KEY FK_B0630D4D5585C142');
        $this->addSql('ALTER TABLE job_candidacy DROP FOREIGN KEY FK_1E80B98C53C674EE');
        $this->addSql('ALTER TABLE job_offers_skills DROP FOREIGN KEY FK_880D1E2F53C674EE');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EC54C8C93');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE9293CB796C');
        $this->addSql('ALTER TABLE society DROP FOREIGN KEY FK_D6461F2E48E9A13');
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB40586383B10');
        $this->addSql('ALTER TABLE expense_line DROP FOREIGN KEY FK_65B3FA9454F21D97');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6205FAC390');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620126651CA');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92A76ED395');
        $this->addSql('ALTER TABLE job_candidacy DROP FOREIGN KEY FK_1E80B98C16FE72E1');
        $this->addSql('ALTER TABLE job_candidacy DROP FOREIGN KEY FK_1E80B98C88F6E01');
        $this->addSql('ALTER TABLE job_candidacy DROP FOREIGN KEY FK_1E80B98C91BD8781');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EDE12AB56');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E16FE72E1');
        $this->addSql('ALTER TABLE user_vacation DROP FOREIGN KEY FK_3573B75A76ED395');
        $this->addSql('ALTER TABLE user_vacation DROP FOREIGN KEY FK_3573B754CA9E500');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620A76ED395');
        $this->addSql('ALTER TABLE user_expense DROP FOREIGN KEY FK_753793ACA76ED395');
        $this->addSql('ALTER TABLE user_expense DROP FOREIGN KEY FK_753793AC4CA9E500');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950A76ED395');
        $this->addSql('ALTER TABLE user_cra DROP FOREIGN KEY FK_797A875AA76ED395');
        $this->addSql('ALTER TABLE user_cra DROP FOREIGN KEY FK_797A875A4CA9E500');
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB405A76ED395');
        $this->addSql('ALTER TABLE user_newsletter DROP FOREIGN KEY FK_D9E24324A76ED395');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE user_skills DROP FOREIGN KEY FK_B0630D4DA76ED395');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947');
        $this->addSql('DROP TABLE skill_type');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE job_candidacy');
        $this->addSql('DROP TABLE society');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_offers_skills');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE user_vacation');
        $this->addSql('DROP TABLE news_category');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE user_expense');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user_category');
        $this->addSql('DROP TABLE page_category');
        $this->addSql('DROP TABLE page_template');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE user_cra');
        $this->addSql('DROP TABLE expense_line');
        $this->addSql('DROP TABLE vacation_type');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE user_newsletter');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE user_skills');
        $this->addSql('DROP TABLE fos_group');
    }
}
