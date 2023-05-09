<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505195627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id_vente INT AUTO_INCREMENT NOT NULL, id_produit INT DEFAULT NULL, prix_artwork DOUBLE PRECISION NOT NULL, paiement VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67DF7384557 (id_produit), PRIMARY KEY(id_vente)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id_profil INT AUTO_INCREMENT NOT NULL, id_util INT NOT NULL, bio VARCHAR(255) NOT NULL, ig VARCHAR(255) NOT NULL, fb VARCHAR(255) NOT NULL, twitter VARCHAR(255) NOT NULL, ytb VARCHAR(255) NOT NULL, PRIMARY KEY(id_profil)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id_role INT AUTO_INCREMENT NOT NULL, type_role VARCHAR(255) NOT NULL, PRIMARY KEY(id_role)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id_skill INT AUTO_INCREMENT NOT NULL, id_profile INT DEFAULT NULL, titre_skill VARCHAR(255) NOT NULL, desc_skill VARCHAR(255) NOT NULL, INDEX IDX_D53116705FCA037F (id_profile), PRIMARY KEY(id_skill)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_cat (id_sous_cat INT AUTO_INCREMENT NOT NULL, type_sous_cat VARCHAR(255) NOT NULL, id_categorie INT NOT NULL, PRIMARY KEY(id_sous_cat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store (id_produit INT AUTO_INCREMENT NOT NULL, id_piece_art INT DEFAULT NULL, nom_artwork VARCHAR(255) NOT NULL, prix_artwork DOUBLE PRECISION NOT NULL, img_artwork VARCHAR(255) NOT NULL, INDEX IDX_FF575877CF1D26F5 (id_piece_art), PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, type_role VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, cin_user VARCHAR(255) NOT NULL, adresse_user VARCHAR(255) NOT NULL, password_user VARCHAR(255) NOT NULL, email_user VARCHAR(255) NOT NULL, is_pro TINYINT(1) NOT NULL, img_user VARCHAR(255) NOT NULL, INDEX IDX_8D93D64980664F62 (type_role), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF7384557 FOREIGN KEY (id_produit) REFERENCES artwork (id_artwork)');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D53116705FCA037F FOREIGN KEY (id_profile) REFERENCES profile (id_profil)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877CF1D26F5 FOREIGN KEY (id_piece_art) REFERENCES artwork (id_artwork)');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE event_like');
        $this->addSql('DROP TABLE particip_event');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('ALTER TABLE artiste_collaboration CHANGE id_artiste_fk id_artiste_fk INT DEFAULT NULL, CHANGE id_collaboration_fk id_collaboration_fk INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT FK_DF84342A1BB81041 FOREIGN KEY (id_collaboration_fk) REFERENCES collaboration (id_collaboration)');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT FK_DF84342A937FD9CD FOREIGN KEY (id_artiste_fk) REFERENCES user (id_user)');
        $this->addSql('CREATE INDEX IDX_DF84342A1BB81041 ON artiste_collaboration (id_collaboration_fk)');
        $this->addSql('CREATE INDEX IDX_DF84342A937FD9CD ON artiste_collaboration (id_artiste_fk)');
        $this->addSql('DROP INDEX fk_id_type ON artwork');
        $this->addSql('DROP INDEX fk_id_artist ON artwork');
        $this->addSql('DROP INDEX nom_artwork ON artwork');
        $this->addSql('ALTER TABLE artwork DROP id_type_id, DROP id_artist_id, DROP likes_count');
        $this->addSql('CREATE INDEX nom_artwork ON artwork (nom_artwork)');
        $this->addSql('ALTER TABLE collaboration CHANGE type_collaboration type_collaboration VARCHAR(255) NOT NULL, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE nom_user nom_user VARCHAR(255) NOT NULL, CHANGE email_user email_user VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commentaire CHANGE id_util id_util INT DEFAULT NULL, CHANGE Texte texte VARCHAR(255) NOT NULL, CHANGE id_artwork id_artwork INT DEFAULT NULL, CHANGE Date_post date_post DATE NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5546AEA1 FOREIGN KEY (id_util) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC56826C06 FOREIGN KEY (id_artwork) REFERENCES artwork (id_artwork)');
        $this->addSql('DROP INDEX fk_id_artwork ON commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC56826C06 ON commentaire (id_artwork)');
        $this->addSql('DROP INDEX fk_id_user ON commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC5546AEA1 ON commentaire (id_util)');
        $this->addSql('DROP INDEX is_user ON parrainage');
        $this->addSql('ALTER TABLE parrainage ADD type_role VARCHAR(255) NOT NULL, CHANGE id_user_id is_pro INT NOT NULL');
        $this->addSql('DROP INDEX id_user ON reclamation');
        $this->addSql('ALTER TABLE reclamation CHANGE id_user id_user INT NOT NULL, CHANGE Titre titre VARCHAR(255) NOT NULL, CHANGE Reclamation_sec reclamation_sec VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY FK_DF84342A937FD9CD');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5546AEA1');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, type_categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nom_categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX nom_categorie (nom_categorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_like (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, id_user INT DEFAULT NULL, INDEX FK_B3A80C186B3CA4B (id_user), INDEX IDX_B3A80C18FD02F13 (evenement_id), INDEX IDX_B3A80C186B3CA4B (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE particip_event (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, id_user INT DEFAULT NULL, INDEX FK_5BF49BB6B3CA4B (id_user), INDEX FK_5BF49BBFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, nom_artwork VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prix_artwork INT NOT NULL, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, remise INT NOT NULL, id_artwork INT NOT NULL, INDEX fk_idart (id_artwork), INDEX nom_artwork (nom_artwork, prix_artwork, id_artwork), INDEX fk_prix (prix_artwork), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF7384557');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D53116705FCA037F');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF575877CF1D26F5');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE sous_cat');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY FK_DF84342A1BB81041');
        $this->addSql('DROP INDEX IDX_DF84342A1BB81041 ON artiste_collaboration');
        $this->addSql('DROP INDEX IDX_DF84342A937FD9CD ON artiste_collaboration');
        $this->addSql('ALTER TABLE artiste_collaboration CHANGE id_collaboration_fk id_collaboration_fk INT NOT NULL, CHANGE id_artiste_fk id_artiste_fk INT NOT NULL');
        $this->addSql('DROP INDEX nom_artwork ON artwork');
        $this->addSql('ALTER TABLE artwork ADD id_type_id INT NOT NULL, ADD id_artist_id INT NOT NULL, ADD likes_count INT DEFAULT NULL');
        $this->addSql('CREATE INDEX fk_id_type ON artwork (id_type_id)');
        $this->addSql('CREATE INDEX fk_id_artist ON artwork (id_artist_id)');
        $this->addSql('CREATE INDEX nom_artwork ON artwork (nom_artwork, prix_artwork)');
        $this->addSql('ALTER TABLE collaboration CHANGE type_collaboration type_collaboration VARCHAR(50) NOT NULL, CHANGE titre titre VARCHAR(50) NOT NULL, CHANGE description description VARCHAR(300) NOT NULL, CHANGE status status VARCHAR(20) NOT NULL, CHANGE nom_user nom_user VARCHAR(50) NOT NULL, CHANGE email_user email_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC56826C06');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5546AEA1');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC56826C06');
        $this->addSql('ALTER TABLE commentaire CHANGE id_util id_util INT NOT NULL, CHANGE id_artwork id_artwork INT NOT NULL, CHANGE texte Texte VARCHAR(200) NOT NULL, CHANGE date_post Date_post DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('DROP INDEX idx_67f068bc5546aea1 ON commentaire');
        $this->addSql('CREATE INDEX fk_id_user ON commentaire (id_util)');
        $this->addSql('DROP INDEX idx_67f068bc56826c06 ON commentaire');
        $this->addSql('CREATE INDEX fk_id_artwork ON commentaire (id_artwork)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5546AEA1 FOREIGN KEY (id_util) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC56826C06 FOREIGN KEY (id_artwork) REFERENCES artwork (id_artwork)');
        $this->addSql('ALTER TABLE parrainage DROP type_role, CHANGE is_pro id_user_id INT NOT NULL');
        $this->addSql('CREATE INDEX is_user ON parrainage (id_user_id)');
        $this->addSql('ALTER TABLE reclamation CHANGE id_user id_user INT DEFAULT NULL, CHANGE titre Titre VARCHAR(10) NOT NULL, CHANGE reclamation_sec Reclamation_sec VARCHAR(200) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL');
        $this->addSql('CREATE INDEX id_user ON reclamation (id_user)');
    }
}
