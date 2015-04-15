<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150315184046 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Post (id INT AUTO_INCREMENT NOT NULL, autor_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, post_text LONGTEXT NOT NULL, INDEX IDX_FAB8C3B314D45BBE (autor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts_tags (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_D5ECAD9F4B89032C (post_id), INDEX IDX_D5ECAD9FBAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2DA1797792FC23A8 (username_canonical), UNIQUE INDEX UNIQ_2DA17977A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B314D45BBE FOREIGN KEY (autor_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9F4B89032C FOREIGN KEY (post_id) REFERENCES Post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9FBAD26311 FOREIGN KEY (tag_id) REFERENCES Tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE posts_tags DROP FOREIGN KEY FK_D5ECAD9F4B89032C');
        $this->addSql('ALTER TABLE posts_tags DROP FOREIGN KEY FK_D5ECAD9FBAD26311');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY FK_FAB8C3B314D45BBE');
        $this->addSql('DROP TABLE Post');
        $this->addSql('DROP TABLE posts_tags');
        $this->addSql('DROP TABLE Tag');
        $this->addSql('DROP TABLE User');
    }
}
