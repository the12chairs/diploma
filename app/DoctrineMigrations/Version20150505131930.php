<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150505131930 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Message (id INT AUTO_INCREMENT NOT NULL, from_id INT DEFAULT NULL, to_id INT DEFAULT NULL, post_text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_790009E378CED90B (from_id), INDEX IDX_790009E330354A65 (to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E378CED90B FOREIGN KEY (from_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E330354A65 FOREIGN KEY (to_id) REFERENCES User (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Message');
    }
}
