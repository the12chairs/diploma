<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150519080041 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Test (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, INDEX IDX_784DD1324B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Task (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, text LONGTEXT NOT NULL, answer LONGTEXT DEFAULT NULL, right_answer LONGTEXT DEFAULT NULL, is_seen TINYINT(1) NOT NULL, is_right TINYINT(1) NOT NULL, INDEX IDX_F24C741BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE QuestionVariant (id INT AUTO_INCREMENT NOT NULL, variant_id INT DEFAULT NULL, variant_text VARCHAR(100) NOT NULL, is_right TINYINT(1) NOT NULL, INDEX IDX_485570243B69A9AF (variant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, grouppa VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_2DA1797792FC23A8 (username_canonical), UNIQUE INDEX UNIQ_2DA17977A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Post (id INT AUTO_INCREMENT NOT NULL, autor_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, post_text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FAB8C3B314D45BBE (autor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_tags (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_D5ECAD9F4B89032C (post_id), INDEX IDX_D5ECAD9FBAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Script (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, code LONGTEXT NOT NULL, difficult VARCHAR(255) NOT NULL, INDEX IDX_1B2D820C1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Message (id INT AUTO_INCREMENT NOT NULL, from_id INT DEFAULT NULL, to_id INT DEFAULT NULL, post_text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_790009E378CED90B (from_id), INDEX IDX_790009E330354A65 (to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Question (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, question_text VARCHAR(500) NOT NULL, INDEX IDX_4F812B181E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE TestResult (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, test_id INT DEFAULT NULL, points INT NOT NULL, INDEX IDX_DA7D8D62A76ED395 (user_id), INDEX IDX_DA7D8D621E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Test ADD CONSTRAINT FK_784DD1324B89032C FOREIGN KEY (post_id) REFERENCES Post (id)');
        $this->addSql('ALTER TABLE Task ADD CONSTRAINT FK_F24C741BA76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE QuestionVariant ADD CONSTRAINT FK_485570243B69A9AF FOREIGN KEY (variant_id) REFERENCES Question (id)');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B314D45BBE FOREIGN KEY (autor_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9F4B89032C FOREIGN KEY (post_id) REFERENCES Post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9FBAD26311 FOREIGN KEY (tag_id) REFERENCES Tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Script ADD CONSTRAINT FK_1B2D820C1E5D0459 FOREIGN KEY (test_id) REFERENCES Post (id)');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E378CED90B FOREIGN KEY (from_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Message ADD CONSTRAINT FK_790009E330354A65 FOREIGN KEY (to_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE Question ADD CONSTRAINT FK_4F812B181E5D0459 FOREIGN KEY (test_id) REFERENCES Test (id)');
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

        $this->addSql('ALTER TABLE Question DROP FOREIGN KEY FK_4F812B181E5D0459');
        $this->addSql('ALTER TABLE TestResult DROP FOREIGN KEY FK_DA7D8D621E5D0459');
        $this->addSql('ALTER TABLE Task DROP FOREIGN KEY FK_F24C741BA76ED395');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY FK_FAB8C3B314D45BBE');
        $this->addSql('ALTER TABLE Message DROP FOREIGN KEY FK_790009E378CED90B');
        $this->addSql('ALTER TABLE Message DROP FOREIGN KEY FK_790009E330354A65');
        $this->addSql('ALTER TABLE TestResult DROP FOREIGN KEY FK_DA7D8D62A76ED395');
        $this->addSql('ALTER TABLE Test DROP FOREIGN KEY FK_784DD1324B89032C');
        $this->addSql('ALTER TABLE posts_tags DROP FOREIGN KEY FK_D5ECAD9F4B89032C');
        $this->addSql('ALTER TABLE Script DROP FOREIGN KEY FK_1B2D820C1E5D0459');
        $this->addSql('ALTER TABLE posts_tags DROP FOREIGN KEY FK_D5ECAD9FBAD26311');
        $this->addSql('ALTER TABLE QuestionVariant DROP FOREIGN KEY FK_485570243B69A9AF');
        $this->addSql('DROP TABLE Test');
        $this->addSql('DROP TABLE Task');
        $this->addSql('DROP TABLE QuestionVariant');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE Post');
        $this->addSql('DROP TABLE posts_tags');
        $this->addSql('DROP TABLE Tag');
        $this->addSql('DROP TABLE Script');
        $this->addSql('DROP TABLE Message');
        $this->addSql('DROP TABLE Question');
        $this->addSql('DROP TABLE TestResult');
    }
}
