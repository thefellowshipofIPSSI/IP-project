<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170212152858 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page_category ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page_category ADD CONSTRAINT FK_86D31EE1727ACA70 FOREIGN KEY (parent_id) REFERENCES page_category (id)');
        $this->addSql('CREATE INDEX IDX_86D31EE1727ACA70 ON page_category (parent_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page_category DROP FOREIGN KEY FK_86D31EE1727ACA70');
        $this->addSql('DROP INDEX IDX_86D31EE1727ACA70 ON page_category');
        $this->addSql('ALTER TABLE page_category DROP parent_id');
    }
}
