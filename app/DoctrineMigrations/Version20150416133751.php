<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150416133751 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Answer (id INT AUTO_INCREMENT NOT NULL, answer_id INT DEFAULT NULL, variant_text VARCHAR(100) NOT NULL, INDEX IDX_DD714F13AA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Answer ADD CONSTRAINT FK_DD714F13AA334807 FOREIGN KEY (answer_id) REFERENCES Question (id)');
        $this->addSql('ALTER TABLE QuestionVariant DROP FOREIGN KEY FK_48557024AA334807');
        $this->addSql('ALTER TABLE QuestionVariant ADD CONSTRAINT FK_48557024AA334807 FOREIGN KEY (answer_id) REFERENCES Answer (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE QuestionVariant DROP FOREIGN KEY FK_48557024AA334807');
        $this->addSql('DROP TABLE Answer');
        $this->addSql('ALTER TABLE QuestionVariant DROP FOREIGN KEY FK_48557024AA334807');
        $this->addSql('ALTER TABLE QuestionVariant ADD CONSTRAINT FK_48557024AA334807 FOREIGN KEY (answer_id) REFERENCES Question (id)');
    }
}
