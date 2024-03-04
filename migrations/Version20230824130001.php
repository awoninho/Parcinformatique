<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824130001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caracteristiques (id INT AUTO_INCREMENT NOT NULL, id_type_id INT NOT NULL, libelle VARCHAR(100) NOT NULL, INDEX IDX_61B5DA1D1BD125E3 (id_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emplacements (id INT AUTO_INCREMENT NOT NULL, salle VARCHAR(60) NOT NULL, bureau VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipements (id INT AUTO_INCREMENT NOT NULL, id_marque_id INT NOT NULL, id_modele_id INT DEFAULT NULL, id_type_id INT NOT NULL, id_personne_id INT NOT NULL, numero_serie VARCHAR(100) DEFAULT NULL, son_etat VARCHAR(20) NOT NULL, date_acquisition DATE NOT NULL, INDEX IDX_3F02D86BC8120595 (id_marque_id), INDEX IDX_3F02D86B2C210B2D (id_modele_id), INDEX IDX_3F02D86B1BD125E3 (id_type_id), INDEX IDX_3F02D86BBA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modeles (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pannes (id INT AUTO_INCREMENT NOT NULL, id_equipement_id INT NOT NULL, diagnostic VARCHAR(100) NOT NULL, date_panne DATE NOT NULL, INDEX IDX_56842BE13E47DE39 (id_equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnels (id INT AUTO_INCREMENT NOT NULL, id_emplacement_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) DEFAULT NULL, sexe VARCHAR(20) NOT NULL, fonction VARCHAR(50) NOT NULL, telephone VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_7AC38C2BE7927C74 (email), INDEX IDX_7AC38C2BF93F3757 (id_emplacement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pieces_changer (id INT AUTO_INCREMENT NOT NULL, id_caracteristique_id INT DEFAULT NULL, details VARCHAR(100) NOT NULL, INDEX IDX_73D8778E94265C18 (id_caracteristique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reparations (id INT AUTO_INCREMENT NOT NULL, id_piece_id INT DEFAULT NULL, date_reparation DATE NOT NULL, commentaire VARCHAR(100) DEFAULT NULL, INDEX IDX_953FFFD394D4233D (id_piece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_materiels (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caracteristiques ADD CONSTRAINT FK_61B5DA1D1BD125E3 FOREIGN KEY (id_type_id) REFERENCES type_materiels (id)');
        $this->addSql('ALTER TABLE equipements ADD CONSTRAINT FK_3F02D86BC8120595 FOREIGN KEY (id_marque_id) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE equipements ADD CONSTRAINT FK_3F02D86B2C210B2D FOREIGN KEY (id_modele_id) REFERENCES modeles (id)');
        $this->addSql('ALTER TABLE equipements ADD CONSTRAINT FK_3F02D86B1BD125E3 FOREIGN KEY (id_type_id) REFERENCES type_materiels (id)');
        $this->addSql('ALTER TABLE equipements ADD CONSTRAINT FK_3F02D86BBA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnels (id)');
        $this->addSql('ALTER TABLE pannes ADD CONSTRAINT FK_56842BE13E47DE39 FOREIGN KEY (id_equipement_id) REFERENCES equipements (id)');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2BF93F3757 FOREIGN KEY (id_emplacement_id) REFERENCES emplacements (id)');
        $this->addSql('ALTER TABLE pieces_changer ADD CONSTRAINT FK_73D8778E94265C18 FOREIGN KEY (id_caracteristique_id) REFERENCES caracteristiques (id)');
        $this->addSql('ALTER TABLE reparations ADD CONSTRAINT FK_953FFFD394D4233D FOREIGN KEY (id_piece_id) REFERENCES pieces_changer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristiques DROP FOREIGN KEY FK_61B5DA1D1BD125E3');
        $this->addSql('ALTER TABLE equipements DROP FOREIGN KEY FK_3F02D86BC8120595');
        $this->addSql('ALTER TABLE equipements DROP FOREIGN KEY FK_3F02D86B2C210B2D');
        $this->addSql('ALTER TABLE equipements DROP FOREIGN KEY FK_3F02D86B1BD125E3');
        $this->addSql('ALTER TABLE equipements DROP FOREIGN KEY FK_3F02D86BBA091CE5');
        $this->addSql('ALTER TABLE pannes DROP FOREIGN KEY FK_56842BE13E47DE39');
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2BF93F3757');
        $this->addSql('ALTER TABLE pieces_changer DROP FOREIGN KEY FK_73D8778E94265C18');
        $this->addSql('ALTER TABLE reparations DROP FOREIGN KEY FK_953FFFD394D4233D');
        $this->addSql('DROP TABLE caracteristiques');
        $this->addSql('DROP TABLE emplacements');
        $this->addSql('DROP TABLE equipements');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE modeles');
        $this->addSql('DROP TABLE pannes');
        $this->addSql('DROP TABLE personnels');
        $this->addSql('DROP TABLE pieces_changer');
        $this->addSql('DROP TABLE reparations');
        $this->addSql('DROP TABLE type_materiels');
    }
}
