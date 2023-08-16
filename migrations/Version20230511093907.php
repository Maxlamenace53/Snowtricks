<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511093907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_trick DROP FOREIGN KEY FK_62A1AEA9A76ED395');
        $this->addSql('ALTER TABLE photo_trick CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo_trick ADD CONSTRAINT FK_62A1AEA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE video_trick DROP FOREIGN KEY FK_5792A0BCA76ED395');
        $this->addSql('ALTER TABLE video_trick CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video_trick ADD CONSTRAINT FK_5792A0BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_trick DROP FOREIGN KEY FK_5792A0BCA76ED395');
        $this->addSql('ALTER TABLE video_trick CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE video_trick ADD CONSTRAINT FK_5792A0BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE photo_trick DROP FOREIGN KEY FK_62A1AEA9A76ED395');
        $this->addSql('ALTER TABLE photo_trick CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE photo_trick ADD CONSTRAINT FK_62A1AEA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
