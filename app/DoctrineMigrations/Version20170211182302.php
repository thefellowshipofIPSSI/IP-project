<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170211182302 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE9293CB796C');
        $this->addSql('DROP INDEX UNIQ_B66FFE9293CB796C ON cv');
        $this->addSql('ALTER TABLE cv ADD statut_id INT NOT NULL, ADD cv_name VARCHAR(255) DEFAULT NULL, CHANGE file_id user_validation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE924CA9E500 FOREIGN KEY (user_validation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_B66FFE924CA9E500 ON cv (user_validation_id)');
        $this->addSql('CREATE INDEX IDX_B66FFE92F6203804 ON cv (statut_id)');
        $this->addSql('ALTER TABLE user_vacation ADD statut_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE user_vacation ADD CONSTRAINT FK_3573B75F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_3573B75F6203804 ON user_vacation (statut_id)');
        $this->addSql('ALTER TABLE user_expense ADD statut_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE user_expense ADD CONSTRAINT FK_753793ACF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_753793ACF6203804 ON user_expense (statut_id)');
        $this->addSql('ALTER TABLE user_cra ADD statut_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE user_cra ADD CONSTRAINT FK_797A875AF6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_797A875AF6203804 ON user_cra (statut_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE92F6203804');
        $this->addSql('ALTER TABLE user_vacation DROP FOREIGN KEY FK_3573B75F6203804');
        $this->addSql('ALTER TABLE user_expense DROP FOREIGN KEY FK_753793ACF6203804');
        $this->addSql('ALTER TABLE user_cra DROP FOREIGN KEY FK_797A875AF6203804');
        $this->addSql('DROP TABLE statut');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE924CA9E500');
        $this->addSql('DROP INDEX IDX_B66FFE924CA9E500 ON cv');
        $this->addSql('DROP INDEX IDX_B66FFE92F6203804 ON cv');
        $this->addSql('ALTER TABLE cv DROP statut_id, DROP cv_name, CHANGE user_validation_id file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9293CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B66FFE9293CB796C ON cv (file_id)');
        $this->addSql('DROP INDEX IDX_797A875AF6203804 ON user_cra');
        $this->addSql('ALTER TABLE user_cra ADD status INT DEFAULT 0 NOT NULL, DROP statut_id');
        $this->addSql('DROP INDEX IDX_753793ACF6203804 ON user_expense');
        $this->addSql('ALTER TABLE user_expense ADD status INT DEFAULT 0 NOT NULL, DROP statut_id');
        $this->addSql('DROP INDEX IDX_3573B75F6203804 ON user_vacation');
        $this->addSql('ALTER TABLE user_vacation ADD status INT NOT NULL, DROP statut_id');
    }
}
