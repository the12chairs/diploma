<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150425165213 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questionvariant DROP FOREIGN KEY FK_48557024AA334807');
        $this->addSql('DROP INDEX IDX_48557024AA334807 ON questionvariant');
        $this->addSql('ALTER TABLE questionvariant DROP answer_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE QuestionVariant ADD answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE QuestionVariant ADD CONSTRAINT FK_48557024AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('CREATE INDEX IDX_48557024AA334807 ON QuestionVariant (answer_id)');
    }
}
