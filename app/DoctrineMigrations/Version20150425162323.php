<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150425162323 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_784DD1321E5D0459');
        $this->addSql('DROP INDEX IDX_784DD1321E5D0459 ON test');
        $this->addSql('ALTER TABLE test CHANGE test_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_784DD1324B89032C FOREIGN KEY (post_id) REFERENCES Post (id)');
        $this->addSql('CREATE INDEX IDX_784DD1324B89032C ON test (post_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Test DROP FOREIGN KEY FK_784DD1324B89032C');
        $this->addSql('DROP INDEX IDX_784DD1324B89032C ON Test');
        $this->addSql('ALTER TABLE Test CHANGE post_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Test ADD CONSTRAINT FK_784DD1321E5D0459 FOREIGN KEY (test_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_784DD1321E5D0459 ON Test (test_id)');
    }
}
