<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170112132153 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_candidacy ADD cv_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_candidacy ADD CONSTRAINT FK_1E80B98CCFE419E2 FOREIGN KEY (cv_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1E80B98CCFE419E2 ON job_candidacy (cv_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_candidacy DROP FOREIGN KEY FK_1E80B98CCFE419E2');
        $this->addSql('DROP INDEX UNIQ_1E80B98CCFE419E2 ON job_candidacy');
        $this->addSql('ALTER TABLE job_candidacy DROP cv_id');
    }
}
