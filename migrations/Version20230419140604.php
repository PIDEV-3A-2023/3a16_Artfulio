<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419140604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement_participant DROP FOREIGN KEY FK_460A7D3A9D1C3019');
        $this->addSql('ALTER TABLE evenement_participant DROP FOREIGN KEY FK_460A7D3AFD02F13');
        $this->addSql('DROP TABLE evenement_participant');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement_participant (evenement_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_460A7D3AFD02F13 (evenement_id), INDEX IDX_460A7D3A9D1C3019 (participant_id), PRIMARY KEY(evenement_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement_participant ADD CONSTRAINT FK_460A7D3A9D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE evenement_participant ADD CONSTRAINT FK_460A7D3AFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
    }
}
