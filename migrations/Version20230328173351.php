<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328173351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY artiste_collaboration_ibfk_1');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY fk_id_artiste');
        $this->addSql('DROP INDEX id_artiste ON artiste_collaboration');
        $this->addSql('DROP INDEX id_collaboration ON artiste_collaboration');
        $this->addSql('DROP INDEX id_artiste_2 ON artiste_collaboration');
        $this->addSql('DROP INDEX id_collaboration_fk ON artiste_collaboration');
        $this->addSql('DROP INDEX IDX_DF84342A937FD9CD ON artiste_collaboration');
        $this->addSql('ALTER TABLE artiste_collaboration ADD idCollaborationFk INT DEFAULT NULL, ADD idArtisteFk INT DEFAULT NULL, DROP id_artiste_fk, DROP id_collaboration_fk');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT FK_DF84342AD3EA8222 FOREIGN KEY (idCollaborationFk) REFERENCES collaboration (idCollaboration)');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT FK_DF84342AE0226214 FOREIGN KEY (idArtisteFk) REFERENCES user (iduser)');
        $this->addSql('CREATE INDEX IDX_DF84342AD3EA8222 ON artiste_collaboration (idCollaborationFk)');
        $this->addSql('CREATE INDEX IDX_DF84342AE0226214 ON artiste_collaboration (idArtisteFk)');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY fk_id_artist');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY fk_id_sou_cat');
        $this->addSql('DROP INDEX fk_id_type ON artwork');
        $this->addSql('ALTER TABLE artwork ADD id_type  INT DEFAULT NULL, DROP id_type, CHANGE id_artist id_artist INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC576276E236A FOREIGN KEY (id_artist) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC57645D7C84E FOREIGN KEY (id_type ) REFERENCES sous_cat (idsouscat)');
        $this->addSql('CREATE INDEX IDX_881FC57645D7C84E ON artwork (id_type )');
        $this->addSql('ALTER TABLE artwork RENAME INDEX fk_id_artist TO IDX_881FC576276E236A');
        $this->addSql('DROP INDEX nom_categorie ON categorie');
        $this->addSql('ALTER TABLE collaboration CHANGE type_collaboration type_collaboration VARCHAR(255) NOT NULL, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE nom_user nom_user VARCHAR(255) NOT NULL, CHANGE email_user email_user VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY fl_id_artwork');
        $this->addSql('DROP INDEX fl_id_artwork ON commande');
        $this->addSql('ALTER TABLE commande ADD idProduit INT DEFAULT NULL, DROP id_produit');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D391C87D5 FOREIGN KEY (idProduit) REFERENCES artwork (idArtwork)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D391C87D5 ON commande (idProduit)');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_id_artwork');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_id_user');
        $this->addSql('DROP INDEX fk_id_artwork ON commentaire');
        $this->addSql('DROP INDEX fk_id_user ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD idArtwork INT DEFAULT NULL, ADD idUtil INT DEFAULT NULL, DROP id_util, DROP id_artwork, CHANGE Texte texte VARCHAR(255) NOT NULL, CHANGE Date_post date_post DATE NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC98A6AE84 FOREIGN KEY (idArtwork) REFERENCES artwork (idArtwork)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCAD9BEC3D FOREIGN KEY (idUtil) REFERENCES user (iduser)');
        $this->addSql('CREATE INDEX IDX_67F068BC98A6AE84 ON commentaire (idArtwork)');
        $this->addSql('CREATE INDEX IDX_67F068BCAD9BEC3D ON commentaire (idUtil)');
        $this->addSql('DROP INDEX fk_email ON parrainage');
        $this->addSql('DROP INDEX fk_pro ON parrainage');
        $this->addSql('DROP INDEX fk_typerole ON parrainage');
        $this->addSql('DROP INDEX fk_username ON parrainage');
        $this->addSql('ALTER TABLE parrainage CHANGE email email VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE type_role type_role VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX id_util ON profile');
        $this->addSql('ALTER TABLE profile CHANGE bio bio VARCHAR(255) NOT NULL, CHANGE ig ig VARCHAR(255) NOT NULL, CHANGE fb fb VARCHAR(255) NOT NULL, CHANGE twitter twitter VARCHAR(255) NOT NULL, CHANGE ytb ytb VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX id_user ON reclamation');
        $this->addSql('ALTER TABLE reclamation CHANGE Titre titre VARCHAR(255) NOT NULL, CHANGE Reclamation_sec reclamation_sec VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX type_role ON role');
        $this->addSql('ALTER TABLE role CHANGE type_role type_role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY fk_id_profile');
        $this->addSql('DROP INDEX fk_id_profile ON skills');
        $this->addSql('ALTER TABLE skills ADD idProfile INT DEFAULT NULL, DROP id_profile, CHANGE desc_skill desc_skill VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D531167091EEC1FD FOREIGN KEY (idProfile) REFERENCES profile (idProfil)');
        $this->addSql('CREATE INDEX IDX_D531167091EEC1FD ON skills (idProfile)');
        $this->addSql('ALTER TABLE sous_cat MODIFY id_sous_cat INT NOT NULL');
        $this->addSql('ALTER TABLE sous_cat DROP FOREIGN KEY fk_type');
        $this->addSql('DROP INDEX fk_id_categorie ON sous_cat');
        $this->addSql('DROP INDEX type_sous_cat ON sous_cat');
        $this->addSql('DROP INDEX fk_type ON sous_cat');
        $this->addSql('DROP INDEX `primary` ON sous_cat');
        $this->addSql('ALTER TABLE sous_cat DROP nom_sous_cat, CHANGE id_sous_cat idsouscat INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE sous_cat ADD PRIMARY KEY (idsouscat)');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY fk_id_produit');
        $this->addSql('DROP INDEX fk_id_produit ON store');
        $this->addSql('ALTER TABLE store ADD idPieceArt INT DEFAULT NULL, DROP id_piece_art, CHANGE nom_artwork nom_artwork VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758773595B077 FOREIGN KEY (idPieceArt) REFERENCES artwork (idArtwork)');
        $this->addSql('CREATE INDEX IDX_FF5758773595B077 ON store (idPieceArt)');
        $this->addSql('ALTER TABLE user MODIFY id_user INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY user_ibfk_1');
        $this->addSql('DROP INDEX role ON user');
        $this->addSql('DROP INDEX email_user ON user');
        $this->addSql('DROP INDEX is_pro ON user');
        $this->addSql('DROP INDEX username ON user');
        $this->addSql('DROP INDEX `primary` ON user');
        $this->addSql('ALTER TABLE user ADD typeRole VARCHAR(255) DEFAULT NULL, DROP type_role, CHANGE username username VARCHAR(255) NOT NULL, CHANGE cin_user cin_user VARCHAR(255) NOT NULL, CHANGE adresse_user adresse_user VARCHAR(255) NOT NULL, CHANGE password_user password_user VARCHAR(255) NOT NULL, CHANGE email_user email_user VARCHAR(255) NOT NULL, CHANGE is_pro is_pro TINYINT(1) NOT NULL, CHANGE img_user img_user VARCHAR(255) NOT NULL, CHANGE id_user iduser INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B827DA4F FOREIGN KEY (typeRole) REFERENCES role (typeRole)');
        $this->addSql('CREATE INDEX IDX_8D93D649B827DA4F ON user (typeRole)');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (iduser)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE collaboration CHANGE type_collaboration type_collaboration VARCHAR(50) NOT NULL, CHANGE titre titre VARCHAR(50) NOT NULL, CHANGE description description VARCHAR(300) NOT NULL, CHANGE status status VARCHAR(20) NOT NULL, CHANGE nom_user nom_user VARCHAR(50) NOT NULL, CHANGE email_user email_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC98A6AE84');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCAD9BEC3D');
        $this->addSql('DROP INDEX IDX_67F068BC98A6AE84 ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BCAD9BEC3D ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD id_util INT NOT NULL, ADD id_artwork INT NOT NULL, DROP idArtwork, DROP idUtil, CHANGE texte Texte VARCHAR(200) NOT NULL, CHANGE date_post Date_post DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_id_artwork FOREIGN KEY (id_artwork) REFERENCES artwork (id_artwork) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_id_user FOREIGN KEY (id_util) REFERENCES user (id_user) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fk_id_artwork ON commentaire (id_artwork)');
        $this->addSql('CREATE INDEX fk_id_user ON commentaire (id_util)');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY FK_DF84342AD3EA8222');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY FK_DF84342AE0226214');
        $this->addSql('DROP INDEX IDX_DF84342AD3EA8222 ON artiste_collaboration');
        $this->addSql('DROP INDEX IDX_DF84342AE0226214 ON artiste_collaboration');
        $this->addSql('ALTER TABLE artiste_collaboration ADD id_artiste_fk INT NOT NULL, ADD id_collaboration_fk INT NOT NULL, DROP idCollaborationFk, DROP idArtisteFk');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT artiste_collaboration_ibfk_1 FOREIGN KEY (id_collaboration_fk) REFERENCES collaboration (id_collaboration) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT fk_id_artiste FOREIGN KEY (id_artiste_fk) REFERENCES user (id_user)');
        $this->addSql('CREATE UNIQUE INDEX id_artiste ON artiste_collaboration (id_artiste_fk, id_collaboration_fk)');
        $this->addSql('CREATE UNIQUE INDEX id_collaboration ON artiste_collaboration (id_collaboration_fk)');
        $this->addSql('CREATE UNIQUE INDEX id_artiste_2 ON artiste_collaboration (id_artiste_fk, id_collaboration_fk)');
        $this->addSql('CREATE UNIQUE INDEX id_collaboration_fk ON artiste_collaboration (id_collaboration_fk)');
        $this->addSql('CREATE INDEX IDX_DF84342A937FD9CD ON artiste_collaboration (id_artiste_fk)');
        $this->addSql('CREATE INDEX nom_categorie ON categorie (nom_categorie)');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D531167091EEC1FD');
        $this->addSql('DROP INDEX IDX_D531167091EEC1FD ON skills');
        $this->addSql('ALTER TABLE skills ADD id_profile INT NOT NULL, DROP idProfile, CHANGE desc_skill desc_skill TEXT NOT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT fk_id_profile FOREIGN KEY (id_profile) REFERENCES profile (id_profil)');
        $this->addSql('CREATE INDEX fk_id_profile ON skills (id_profile)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D391C87D5');
        $this->addSql('DROP INDEX IDX_6EEAA67D391C87D5 ON commande');
        $this->addSql('ALTER TABLE commande ADD id_produit INT NOT NULL, DROP idProduit');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT fl_id_artwork FOREIGN KEY (id_produit) REFERENCES artwork (id_artwork)');
        $this->addSql('CREATE INDEX fl_id_artwork ON commande (id_produit)');
        $this->addSql('ALTER TABLE parrainage CHANGE email email VARCHAR(30) NOT NULL, CHANGE username username VARCHAR(50) NOT NULL, CHANGE type_role type_role VARCHAR(20) NOT NULL');
        $this->addSql('CREATE INDEX fk_email ON parrainage (email)');
        $this->addSql('CREATE INDEX fk_pro ON parrainage (is_pro)');
        $this->addSql('CREATE INDEX fk_typerole ON parrainage (type_role)');
        $this->addSql('CREATE INDEX fk_username ON parrainage (username)');
        $this->addSql('ALTER TABLE sous_cat MODIFY idsouscat INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON sous_cat');
        $this->addSql('ALTER TABLE sous_cat ADD nom_sous_cat VARCHAR(255) NOT NULL, CHANGE idsouscat id_sous_cat INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE sous_cat ADD CONSTRAINT fk_type FOREIGN KEY (nom_sous_cat) REFERENCES categorie (nom_categorie)');
        $this->addSql('CREATE INDEX fk_id_categorie ON sous_cat (id_categorie)');
        $this->addSql('CREATE INDEX type_sous_cat ON sous_cat (type_sous_cat)');
        $this->addSql('CREATE INDEX fk_type ON sous_cat (nom_sous_cat)');
        $this->addSql('ALTER TABLE sous_cat ADD PRIMARY KEY (id_sous_cat)');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC576276E236A');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC57645D7C84E');
        $this->addSql('DROP INDEX IDX_881FC57645D7C84E ON artwork');
        $this->addSql('ALTER TABLE artwork ADD id_type INT NOT NULL, DROP id_type , CHANGE id_artist id_artist INT NOT NULL');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT fk_id_artist FOREIGN KEY (id_artist) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT fk_id_sou_cat FOREIGN KEY (id_type) REFERENCES sous_cat (id_sous_cat)');
        $this->addSql('CREATE INDEX fk_id_type ON artwork (id_type)');
        $this->addSql('ALTER TABLE artwork RENAME INDEX idx_881fc576276e236a TO fk_id_artist');
        $this->addSql('ALTER TABLE reclamation CHANGE titre Titre VARCHAR(10) NOT NULL, CHANGE reclamation_sec Reclamation_sec VARCHAR(200) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL');
        $this->addSql('CREATE INDEX id_user ON reclamation (id_user)');
        $this->addSql('ALTER TABLE role CHANGE type_role type_role VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX type_role ON role (type_role)');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF5758773595B077');
        $this->addSql('DROP INDEX IDX_FF5758773595B077 ON store');
        $this->addSql('ALTER TABLE store ADD id_piece_art INT NOT NULL, DROP idPieceArt, CHANGE nom_artwork nom_artwork VARCHAR(11) NOT NULL');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT fk_id_produit FOREIGN KEY (id_piece_art) REFERENCES artwork (id_artwork) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fk_id_produit ON store (id_piece_art)');
        $this->addSql('ALTER TABLE user MODIFY iduser INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B827DA4F');
        $this->addSql('DROP INDEX IDX_8D93D649B827DA4F ON user');
        $this->addSql('DROP INDEX `PRIMARY` ON user');
        $this->addSql('ALTER TABLE user ADD type_role VARCHAR(20) NOT NULL, DROP typeRole, CHANGE username username VARCHAR(50) NOT NULL, CHANGE cin_user cin_user VARCHAR(8) NOT NULL, CHANGE adresse_user adresse_user VARCHAR(50) NOT NULL, CHANGE password_user password_user VARCHAR(50) NOT NULL, CHANGE email_user email_user VARCHAR(50) NOT NULL, CHANGE is_pro is_pro TINYINT(1) DEFAULT 0 NOT NULL, CHANGE img_user img_user VARCHAR(255) DEFAULT NULL, CHANGE iduser id_user INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT user_ibfk_1 FOREIGN KEY (type_role) REFERENCES role (type_role) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX role ON user (type_role)');
        $this->addSql('CREATE INDEX email_user ON user (email_user)');
        $this->addSql('CREATE INDEX is_pro ON user (is_pro)');
        $this->addSql('CREATE INDEX username ON user (username)');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id_user)');
        $this->addSql('ALTER TABLE profile CHANGE bio bio TEXT NOT NULL, CHANGE ig ig TEXT NOT NULL, CHANGE fb fb TEXT NOT NULL, CHANGE twitter twitter TEXT NOT NULL, CHANGE ytb ytb TEXT NOT NULL');
        $this->addSql('CREATE INDEX id_util ON profile (id_util)');
    }
}
