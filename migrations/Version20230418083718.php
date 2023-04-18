<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418083718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_trick ADD trick_id INT DEFAULT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE photo_trick ADD CONSTRAINT FK_62A1AEA9B281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE photo_trick ADD CONSTRAINT FK_62A1AEA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_62A1AEA9B281BE2E ON photo_trick (trick_id)');
        $this->addSql('CREATE INDEX IDX_62A1AEA9A76ED395 ON photo_trick (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_trick DROP FOREIGN KEY FK_62A1AEA9B281BE2E');
        $this->addSql('ALTER TABLE photo_trick DROP FOREIGN KEY FK_62A1AEA9A76ED395');
        $this->addSql('DROP INDEX IDX_62A1AEA9B281BE2E ON photo_trick');
        $this->addSql('DROP INDEX IDX_62A1AEA9A76ED395 ON photo_trick');
        $this->addSql('ALTER TABLE photo_trick DROP trick_id, DROP user_id');
    }
}
