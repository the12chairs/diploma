<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150425152430 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_4F812B181E27F6BF');
        $this->addSql('DROP INDEX IDX_4F812B181E27F6BF ON question');
        $this->addSql('ALTER TABLE question CHANGE question_id test_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_4F812B181E5D0459 FOREIGN KEY (test_id) REFERENCES Test (id)');
        $this->addSql('CREATE INDEX IDX_4F812B181E5D0459 ON question (test_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Question DROP FOREIGN KEY FK_4F812B181E5D0459');
        $this->addSql('DROP INDEX IDX_4F812B181E5D0459 ON Question');
        $this->addSql('ALTER TABLE Question CHANGE test_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Question ADD CONSTRAINT FK_4F812B181E27F6BF FOREIGN KEY (question_id) REFERENCES test (id)');
        $this->addSql('CREATE INDEX IDX_4F812B181E27F6BF ON Question (question_id)');
    }
}
