<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315062351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C35F0816DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_user (adresse_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7D95019F4DE7DC5C (adresse_id), INDEX IDX_7D95019FA76ED395 (user_id), PRIMARY KEY(adresse_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (categorie_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_76264285BCF5E72D (categorie_id), INDEX IDX_76264285F347EFB (produit_id), PRIMARY KEY(categorie_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, lot_id INT DEFAULT NULL, vente_id INT DEFAULT NULL, prix_proposer DOUBLE PRECISION DEFAULT NULL, est_adjuger TINYINT(1) DEFAULT NULL, date_heure_vente DATETIME DEFAULT NULL, INDEX IDX_38D1870FA8CBA5F7 (lot_id), INDEX IDX_38D1870F7DC7170A (vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere_user (enchere_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B9BC5CFDE80B6EFB (enchere_id), INDEX IDX_B9BC5CFDA76ED395 (user_id), PRIMARY KEY(enchere_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, date DATETIME NOT NULL, prix DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_D0527024A76ED395 (user_id), INDEX IDX_D0527024F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (id INT AUTO_INCREMENT NOT NULL, vente_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_B81291B7DC7170A (vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot_user (lot_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_19BF4809A8CBA5F7 (lot_id), INDEX IDX_19BF4809A76ED395 (user_id), PRIMARY KEY(lot_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_achat (id INT AUTO_INCREMENT NOT NULL, enchere_id INT DEFAULT NULL, user_id INT DEFAULT NULL, lot_id INT DEFAULT NULL, autobot TINYINT(1) DEFAULT NULL, montant_max DOUBLE PRECISION DEFAULT NULL, date_creation DATETIME DEFAULT NULL, INDEX IDX_71306AD9E80B6EFB (enchere_id), INDEX IDX_71306AD9A76ED395 (user_id), INDEX IDX_71306AD9A8CBA5F7 (lot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, lot_id INT DEFAULT NULL, type_paiement VARCHAR(255) DEFAULT NULL, validation_paiement TINYINT(1) DEFAULT NULL, INDEX IDX_B1DC7A1EA76ED395 (user_id), UNIQUE INDEX UNIQ_B1DC7A1EA8CBA5F7 (lot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_14B78418F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, lot_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, nom_artiste VARCHAR(255) DEFAULT NULL, nom_style VARCHAR(255) DEFAULT NULL, nom_produit VARCHAR(255) DEFAULT NULL, prix_reserve DOUBLE PRECISION DEFAULT NULL, reference_catalogue VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, est_envoyer TINYINT(1) DEFAULT NULL, INDEX IDX_29A5EC27A8CBA5F7 (lot_id), INDEX IDX_29A5EC27DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, numero_mobile VARCHAR(255) DEFAULT NULL, numero_fixe VARCHAR(255) DEFAULT NULL, verif_solvabilite TINYINT(1) DEFAULT NULL, verif_identite TINYINT(1) DEFAULT NULL, verif_ressortissant TINYINT(1) DEFAULT NULL, est_commissaire_priseur TINYINT(1) DEFAULT NULL, liste_mot_cle VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, date_debut DATETIME DEFAULT NULL, INDEX IDX_888A2A4C4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019F4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE enchere_user ADD CONSTRAINT FK_B9BC5CFDE80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enchere_user ADD CONSTRAINT FK_B9BC5CFDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE estimation ADD CONSTRAINT FK_D0527024F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE lot_user ADD CONSTRAINT FK_19BF4809A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lot_user ADD CONSTRAINT FK_19BF4809A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9E80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_user DROP FOREIGN KEY FK_7D95019F4DE7DC5C');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C4DE7DC5C');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285BCF5E72D');
        $this->addSql('ALTER TABLE enchere_user DROP FOREIGN KEY FK_B9BC5CFDE80B6EFB');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9E80B6EFB');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FA8CBA5F7');
        $this->addSql('ALTER TABLE lot_user DROP FOREIGN KEY FK_19BF4809A8CBA5F7');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9A8CBA5F7');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA8CBA5F7');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A8CBA5F7');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285F347EFB');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024F347EFB');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418F347EFB');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816DCD6110');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27DCD6110');
        $this->addSql('ALTER TABLE adresse_user DROP FOREIGN KEY FK_7D95019FA76ED395');
        $this->addSql('ALTER TABLE enchere_user DROP FOREIGN KEY FK_B9BC5CFDA76ED395');
        $this->addSql('ALTER TABLE estimation DROP FOREIGN KEY FK_D0527024A76ED395');
        $this->addSql('ALTER TABLE lot_user DROP FOREIGN KEY FK_19BF4809A76ED395');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9A76ED395');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA76ED395');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F7DC7170A');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B7DC7170A');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE adresse_user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE enchere_user');
        $this->addSql('DROP TABLE estimation');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE lot_user');
        $this->addSql('DROP TABLE ordre_achat');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vente');
    }
}
