<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421093300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, content VARCHAR(255) NOT NULL, date DATETIME NOT NULL, author VARCHAR(255) NOT NULL, INDEX IDX_9474526CE85F12B8 (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CE85F12B8 FOREIGN KEY (post_id) REFERENCES user_post (id)');
        $this->addSql('ALTER TABLE user_post CHANGE topic topic VARCHAR(255) NOT NULL, CHANGE content content VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL, CHANGE author author VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CE85F12B8');
        $this->addSql('DROP TABLE comment');
        $this->addSql('ALTER TABLE user_post CHANGE topic topic VARCHAR(100) DEFAULT NULL, CHANGE content content VARCHAR(1000) NOT NULL, CHANGE date date DATE DEFAULT NULL, CHANGE author author VARCHAR(50) DEFAULT NULL');
    }
}
