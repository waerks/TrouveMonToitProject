<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209134137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, createur_id INT NOT NULL, localisation_id INT NOT NULL, energie_id INT NOT NULL, caracteristiques_id INT NOT NULL, statistiques_id INT NOT NULL, categorie_id INT NOT NULL, type_annonce_id INT NOT NULL, description LONGTEXT DEFAULT NULL, prix NUMERIC(12, 2) NOT NULL, charges NUMERIC(10, 2) DEFAULT NULL, date_publication DATETIME NOT NULL, etat VARCHAR(255) DEFAULT NULL, nombre_etages INT NOT NULL, nombre_facades INT NOT NULL, parking INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_F65593E573A201E5 (createur_id), UNIQUE INDEX UNIQ_F65593E5C68BE09C (localisation_id), UNIQUE INDEX UNIQ_F65593E5B732A364 (energie_id), UNIQUE INDEX UNIQ_F65593E5B2639FE4 (caracteristiques_id), INDEX IDX_F65593E533BC25D3 (statistiques_id), INDEX IDX_F65593E5BCF5E72D (categorie_id), INDEX IDX_F65593E595067D0A (type_annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_equipement (annonce_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_A6C013708805AB2F (annonce_id), INDEX IDX_A6C01370806F0F5C (equipement_id), PRIMARY KEY(annonce_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, annee_construction INT NOT NULL, surface_habitable NUMERIC(10, 2) NOT NULL, nombre_salles_de_bain INT NOT NULL, nombre_toilettes INT NOT NULL, surface_cuisine NUMERIC(7, 2) NOT NULL, surface_salon NUMERIC(7, 2) NOT NULL, surface_terrain NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, type_achat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, caracteristique_id INT NOT NULL, surface NUMERIC(7, 2) NOT NULL, INDEX IDX_C509E4FF1704EEB7 (caracteristique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chauffage (id INT AUTO_INCREMENT NOT NULL, type_chauffage VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, message LONGTEXT NOT NULL, date_envoi DATETIME NOT NULL, INDEX IDX_4C62E6388805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energie (id INT AUTO_INCREMENT NOT NULL, chauffage_id INT NOT NULL, classe_energetique VARCHAR(255) NOT NULL, consomation_energetique NUMERIC(7, 0) NOT NULL, double_vitrage TINYINT(1) NOT NULL, pompes_chaleur TINYINT(1) NOT NULL, panneaux_solaires TINYINT(1) NOT NULL, INDEX IDX_2287DAA0C9BF5A6C (chauffage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, disponible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, user_id INT NOT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_EF85A2CC8805AB2F (annonce_id), INDEX IDX_EF85A2CCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation (id INT AUTO_INCREMENT NOT NULL, adresse_complete VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal INT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, zone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localisation_proximite (localisation_id INT NOT NULL, proximite_id INT NOT NULL, INDEX IDX_7A8B74A3C68BE09C (localisation_id), INDEX IDX_7A8B74A31D207A2 (proximite_id), PRIMARY KEY(localisation_id, proximite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, expediteur_id INT NOT NULL, destinataire_id INT NOT NULL, contenu LONGTEXT NOT NULL, date_envoi DATETIME NOT NULL, INDEX IDX_B6BD307F8805AB2F (annonce_id), INDEX IDX_B6BD307F10335F61 (expediteur_id), INDEX IDX_B6BD307FA4F84F6E (destinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_14B784188805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proximite (id INT AUTO_INCREMENT NOT NULL, type_proximite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique (id INT AUTO_INCREMENT NOT NULL, nombre_visites BIGINT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_annonce (id INT AUTO_INCREMENT NOT NULL, type_annonce VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E573A201E5 FOREIGN KEY (createur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5B732A364 FOREIGN KEY (energie_id) REFERENCES energie (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5B2639FE4 FOREIGN KEY (caracteristiques_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E533BC25D3 FOREIGN KEY (statistiques_id) REFERENCES statistique (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E595067D0A FOREIGN KEY (type_annonce_id) REFERENCES type_annonce (id)');
        $this->addSql('ALTER TABLE annonce_equipement ADD CONSTRAINT FK_A6C013708805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_equipement ADD CONSTRAINT FK_A6C01370806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF1704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6388805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE energie ADD CONSTRAINT FK_2287DAA0C9BF5A6C FOREIGN KEY (chauffage_id) REFERENCES chauffage (id)');
        $this->addSql('ALTER TABLE favori ADD CONSTRAINT FK_EF85A2CC8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE favori ADD CONSTRAINT FK_EF85A2CCA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE localisation_proximite ADD CONSTRAINT FK_7A8B74A3C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE localisation_proximite ADD CONSTRAINT FK_7A8B74A31D207A2 FOREIGN KEY (proximite_id) REFERENCES proximite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F10335F61 FOREIGN KEY (expediteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784188805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E573A201E5');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5C68BE09C');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5B732A364');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5B2639FE4');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E533BC25D3');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5BCF5E72D');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E595067D0A');
        $this->addSql('ALTER TABLE annonce_equipement DROP FOREIGN KEY FK_A6C013708805AB2F');
        $this->addSql('ALTER TABLE annonce_equipement DROP FOREIGN KEY FK_A6C01370806F0F5C');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF1704EEB7');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6388805AB2F');
        $this->addSql('ALTER TABLE energie DROP FOREIGN KEY FK_2287DAA0C9BF5A6C');
        $this->addSql('ALTER TABLE favori DROP FOREIGN KEY FK_EF85A2CC8805AB2F');
        $this->addSql('ALTER TABLE favori DROP FOREIGN KEY FK_EF85A2CCA76ED395');
        $this->addSql('ALTER TABLE localisation_proximite DROP FOREIGN KEY FK_7A8B74A3C68BE09C');
        $this->addSql('ALTER TABLE localisation_proximite DROP FOREIGN KEY FK_7A8B74A31D207A2');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F8805AB2F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F10335F61');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784188805AB2F');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_equipement');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE chauffage');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE energie');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE localisation_proximite');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE proximite');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('DROP TABLE type_annonce');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
