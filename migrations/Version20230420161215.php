<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420161215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_like (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, id_user INT NOT NULL, INDEX IDX_B3A80C18FD02F13 (evenement_id), INDEX IDX_B3A80C186B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_like ADD CONSTRAINT FK_B3A80C18FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE event_like ADD CONSTRAINT FK_B3A80C186B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_like DROP FOREIGN KEY FK_B3A80C18FD02F13');
        $this->addSql('ALTER TABLE event_like DROP FOREIGN KEY FK_B3A80C186B3CA4B');
        $this->addSql('DROP TABLE event_like');
    }
}
