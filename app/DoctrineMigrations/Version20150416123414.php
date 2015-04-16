<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150416123414 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Test (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, INDEX IDX_784DD1321E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE QuestionVariant (id INT AUTO_INCREMENT NOT NULL, variant_id INT DEFAULT NULL, answer_id INT DEFAULT NULL, variant_text VARCHAR(100) NOT NULL, INDEX IDX_485570243B69A9AF (variant_id), INDEX IDX_48557024AA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Question (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, question_text VARCHAR(500) NOT NULL, INDEX IDX_4F812B181E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TestResult (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, test_id INT DEFAULT NULL, points INT NOT NULL, INDEX IDX_DA7D8D62A76ED395 (user_id), INDEX IDX_DA7D8D621E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Test ADD CONSTRAINT FK_784DD1321E5D0459 FOREIGN KEY (test_id) REFERENCES Post (id)');
        $this->addSql('ALTER TABLE QuestionVariant ADD CONSTRAINT FK_485570243B69A9AF FOREIGN KEY (variant_id) REFERENCES Question (id)');
        $this->addSql('ALTER TABLE QuestionVariant ADD CONSTRAINT FK_48557024AA334807 FOREIGN KEY (answer_id) REFERENCES Question (id)');
        $this->addSql('ALTER TABLE Question ADD CONSTRAINT FK_4F812B181E27F6BF FOREIGN KEY (question_id) REFERENCES Test (id)');
        $this->addSql('ALTER TABLE TestResult ADD CONSTRAINT FK_DA7D8D62A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE TestResult ADD CONSTRAINT FK_DA7D8D621E5D0459 FOREIGN KEY (test_id) REFERENCES Test (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Question DROP FOREIGN KEY FK_4F812B181E27F6BF');
        $this->addSql('ALTER TABLE TestResult DROP FOREIGN KEY FK_DA7D8D621E5D0459');
        $this->addSql('ALTER TABLE QuestionVariant DROP FOREIGN KEY FK_485570243B69A9AF');
        $this->addSql('ALTER TABLE QuestionVariant DROP FOREIGN KEY FK_48557024AA334807');
        $this->addSql('DROP TABLE Test');
        $this->addSql('DROP TABLE QuestionVariant');
        $this->addSql('DROP TABLE Question');
        $this->addSql('DROP TABLE TestResult');
    }
}
