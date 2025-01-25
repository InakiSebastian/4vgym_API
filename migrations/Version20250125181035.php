<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250125181035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, activity_type_id INT NOT NULL, date DATETIME NOT NULL, duration INT DEFAULT NULL, INDEX IDX_AC74095AC51EFA73 (activity_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_instructor (id INT AUTO_INCREMENT NOT NULL, activity_id INT NOT NULL, instructor_id INT NOT NULL, INDEX IDX_641E7DD581C06096 (activity_id), INDEX IDX_641E7DD58C4FC193 (instructor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, required_instructors INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instructor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telf INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AC51EFA73 FOREIGN KEY (activity_type_id) REFERENCES activity_type (id)');
        $this->addSql('ALTER TABLE activity_instructor ADD CONSTRAINT FK_641E7DD581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE activity_instructor ADD CONSTRAINT FK_641E7DD58C4FC193 FOREIGN KEY (instructor_id) REFERENCES instructor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AC51EFA73');
        $this->addSql('ALTER TABLE activity_instructor DROP FOREIGN KEY FK_641E7DD581C06096');
        $this->addSql('ALTER TABLE activity_instructor DROP FOREIGN KEY FK_641E7DD58C4FC193');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_instructor');
        $this->addSql('DROP TABLE activity_type');
        $this->addSql('DROP TABLE instructor');
    }
}
