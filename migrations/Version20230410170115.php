<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230410170115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evenement');
        $this->addSql('ALTER TABLE artiste_collaboration CHANGE id_artiste_fk id_artiste_fk INT DEFAULT NULL, CHANGE id_collaboration_fk id_collaboration_fk INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT FK_DF84342A1BB81041 FOREIGN KEY (id_collaboration_fk) REFERENCES collaboration (id_collaboration)');
        $this->addSql('ALTER TABLE artiste_collaboration ADD CONSTRAINT FK_DF84342A937FD9CD FOREIGN KEY (id_artiste_fk) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DF84342A1BB81041 ON artiste_collaboration (id_collaboration_fk)');
        $this->addSql('CREATE INDEX IDX_DF84342A937FD9CD ON artiste_collaboration (id_artiste_fk)');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY fk_id_artist');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY fk_id_sou_cat');
        $this->addSql('ALTER TABLE artwork CHANGE id_type_id id_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC57637A2B0DF FOREIGN KEY (id_artist_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT FK_881FC5761BD125E3 FOREIGN KEY (id_type_id) REFERENCES sous_cat (id)');
        $this->addSql('ALTER TABLE artwork RENAME INDEX fk_id_artist TO IDX_881FC57637A2B0DF');
        $this->addSql('ALTER TABLE artwork RENAME INDEX fk_id_type TO IDX_881FC5761BD125E3');
        $this->addSql('DROP INDEX nom_categorie ON categorie');
        $this->addSql('ALTER TABLE collaboration CHANGE type_collaboration type_collaboration VARCHAR(255) NOT NULL, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE nom_user nom_user VARCHAR(255) NOT NULL, CHANGE email_user email_user VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande CHANGE id_produit id_produit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande RENAME INDEX fl_id_artwork TO IDX_6EEAA67DF7384557');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_id_artwork');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY fk_id_user');
        $this->addSql('DROP INDEX fk_id_artwork ON commentaire');
        $this->addSql('DROP INDEX fk_id_user ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP id_util, DROP id_artwork, CHANGE Texte texte VARCHAR(255) NOT NULL, CHANGE Date_post date_post DATETIME NOT NULL');
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
        $this->addSql('ALTER TABLE skills CHANGE id_profile id_profile INT DEFAULT NULL, CHANGE desc_skill desc_skill VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE skills RENAME INDEX fk_id_profile TO IDX_D53116705FCA037F');
        $this->addSql('ALTER TABLE sous_cat DROP FOREIGN KEY fk_type');
        $this->addSql('DROP INDEX fk_id_categorie ON sous_cat');
        $this->addSql('DROP INDEX fk_type ON sous_cat');
        $this->addSql('DROP INDEX type_sous_cat ON sous_cat');
        $this->addSql('ALTER TABLE sous_cat DROP nom_sous_cat');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY fk_id_produit');
        $this->addSql('DROP INDEX fk_id_produit ON store');
        $this->addSql('ALTER TABLE store DROP id_piece_art, CHANGE nom_artwork nom_artwork VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY user_ibfk_1');
        $this->addSql('DROP INDEX email_user ON user');
        $this->addSql('DROP INDEX is_pro ON user');
        $this->addSql('DROP INDEX role ON user');
        $this->addSql('DROP INDEX username ON user');
        $this->addSql('ALTER TABLE user DROP type_role, CHANGE username username VARCHAR(255) NOT NULL, CHANGE cin_user cin_user VARCHAR(255) NOT NULL, CHANGE adresse_user adresse_user VARCHAR(255) NOT NULL, CHANGE password_user password_user VARCHAR(255) NOT NULL, CHANGE email_user email_user VARCHAR(255) NOT NULL, CHANGE is_pro is_pro TINYINT(1) NOT NULL, CHANGE img_user img_user VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, heure_debut TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE parrainage CHANGE email email VARCHAR(30) NOT NULL, CHANGE username username VARCHAR(50) NOT NULL, CHANGE type_role type_role VARCHAR(20) NOT NULL');
        $this->addSql('CREATE INDEX fk_email ON parrainage (email)');
        $this->addSql('CREATE INDEX fk_pro ON parrainage (is_pro)');
        $this->addSql('CREATE INDEX fk_typerole ON parrainage (type_role)');
        $this->addSql('CREATE INDEX fk_username ON parrainage (username)');
        $this->addSql('ALTER TABLE user ADD type_role VARCHAR(20) NOT NULL, CHANGE username username VARCHAR(50) NOT NULL, CHANGE cin_user cin_user VARCHAR(8) NOT NULL, CHANGE adresse_user adresse_user VARCHAR(50) NOT NULL, CHANGE password_user password_user VARCHAR(50) NOT NULL, CHANGE email_user email_user VARCHAR(50) NOT NULL, CHANGE is_pro is_pro TINYINT(1) DEFAULT 0 NOT NULL, CHANGE img_user img_user VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT user_ibfk_1 FOREIGN KEY (type_role) REFERENCES role (type_role) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX email_user ON user (email_user)');
        $this->addSql('CREATE INDEX is_pro ON user (is_pro)');
        $this->addSql('CREATE INDEX role ON user (type_role)');
        $this->addSql('CREATE INDEX username ON user (username)');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY FK_DF84342A1BB81041');
        $this->addSql('ALTER TABLE artiste_collaboration DROP FOREIGN KEY FK_DF84342A937FD9CD');
        $this->addSql('DROP INDEX IDX_DF84342A1BB81041 ON artiste_collaboration');
        $this->addSql('DROP INDEX IDX_DF84342A937FD9CD ON artiste_collaboration');
        $this->addSql('ALTER TABLE artiste_collaboration CHANGE id_collaboration_fk id_collaboration_fk INT NOT NULL, CHANGE id_artiste_fk id_artiste_fk INT NOT NULL');
        $this->addSql('ALTER TABLE store ADD id_piece_art INT NOT NULL, CHANGE nom_artwork nom_artwork VARCHAR(11) NOT NULL');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT fk_id_produit FOREIGN KEY (id_piece_art) REFERENCES artwork (id_artwork) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fk_id_produit ON store (id_piece_art)');
        $this->addSql('ALTER TABLE reclamation CHANGE titre Titre VARCHAR(10) NOT NULL, CHANGE reclamation_sec Reclamation_sec VARCHAR(200) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL');
        $this->addSql('CREATE INDEX id_user ON reclamation (id_user)');
        $this->addSql('CREATE INDEX nom_categorie ON categorie (nom_categorie)');
        $this->addSql('ALTER TABLE profile CHANGE bio bio TEXT NOT NULL, CHANGE ig ig TEXT NOT NULL, CHANGE fb fb TEXT NOT NULL, CHANGE twitter twitter TEXT NOT NULL, CHANGE ytb ytb TEXT NOT NULL');
        $this->addSql('CREATE INDEX id_util ON profile (id_util)');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC57637A2B0DF');
        $this->addSql('ALTER TABLE artwork DROP FOREIGN KEY FK_881FC5761BD125E3');
        $this->addSql('ALTER TABLE artwork CHANGE id_type_id id_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT fk_id_artist FOREIGN KEY (id_artist_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artwork ADD CONSTRAINT fk_id_sou_cat FOREIGN KEY (id_type_id) REFERENCES sous_cat (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artwork RENAME INDEX idx_881fc57637a2b0df TO fk_id_artist');
        $this->addSql('ALTER TABLE artwork RENAME INDEX idx_881fc5761bd125e3 TO fk_id_type');
        $this->addSql('ALTER TABLE sous_cat ADD nom_sous_cat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sous_cat ADD CONSTRAINT fk_type FOREIGN KEY (nom_sous_cat) REFERENCES categorie (nom_categorie)');
        $this->addSql('CREATE INDEX fk_id_categorie ON sous_cat (id_categorie)');
        $this->addSql('CREATE INDEX fk_type ON sous_cat (nom_sous_cat)');
        $this->addSql('CREATE INDEX type_sous_cat ON sous_cat (type_sous_cat)');
        $this->addSql('ALTER TABLE collaboration CHANGE type_collaboration type_collaboration VARCHAR(50) NOT NULL, CHANGE titre titre VARCHAR(50) NOT NULL, CHANGE description description VARCHAR(300) NOT NULL, CHANGE status status VARCHAR(20) NOT NULL, CHANGE nom_user nom_user VARCHAR(50) NOT NULL, CHANGE email_user email_user VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE skills CHANGE id_profile id_profile INT NOT NULL, CHANGE desc_skill desc_skill TEXT NOT NULL');
        $this->addSql('ALTER TABLE skills RENAME INDEX idx_d53116705fca037f TO fk_id_profile');
        $this->addSql('ALTER TABLE commande CHANGE id_produit id_produit INT NOT NULL');
        $this->addSql('ALTER TABLE commande RENAME INDEX idx_6eeaa67df7384557 TO fl_id_artwork');
        $this->addSql('ALTER TABLE role CHANGE type_role type_role VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX type_role ON role (type_role)');
        $this->addSql('ALTER TABLE commentaire ADD id_util INT NOT NULL, ADD id_artwork INT NOT NULL, CHANGE texte Texte VARCHAR(200) NOT NULL, CHANGE date_post Date_post DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_id_artwork FOREIGN KEY (id_artwork) REFERENCES artwork (id_artwork) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT fk_id_user FOREIGN KEY (id_util) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX fk_id_artwork ON commentaire (id_artwork)');
        $this->addSql('CREATE INDEX fk_id_user ON commentaire (id_util)');
    }
}
