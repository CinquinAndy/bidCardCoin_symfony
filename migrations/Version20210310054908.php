<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310054908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, prix_proposer DOUBLE PRECISION NOT NULL, est_adjuger TINYINT(1) NOT NULL, date_heure_vente DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (id INT AUTO_INCREMENT NOT NULL, paiement_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_B81291B2A4C4478 (paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_achat (id INT AUTO_INCREMENT NOT NULL, user_ordre_achat_id INT DEFAULT NULL, lot_ordre_achat_id INT DEFAULT NULL, autobot TINYINT(1) NOT NULL, montant_max DOUBLE PRECISION NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_71306AD93657A726 (user_ordre_achat_id), INDEX IDX_71306AD97461C345 (lot_ordre_achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, user_paiement_id INT DEFAULT NULL, type_paiement VARCHAR(255) NOT NULL, validation_paiement TINYINT(1) NOT NULL, INDEX IDX_B1DC7A1E83578DED (user_paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, lot_produit_id INT DEFAULT NULL, user_produit_id INT DEFAULT NULL, enchere_gagnante_id INT DEFAULT NULL, stock_produit_id INT DEFAULT NULL, nom_artiste VARCHAR(255) NOT NULL, nom_style VARCHAR(255) NOT NULL, nom_produit VARCHAR(255) NOT NULL, prix_reserve DOUBLE PRECISION NOT NULL, reference_catalogue VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, est_envoyer TINYINT(1) NOT NULL, INDEX IDX_29A5EC277EA4ED4C (lot_produit_id), INDEX IDX_29A5EC27A853B817 (user_produit_id), UNIQUE INDEX UNIQ_29A5EC2772FCB4 (enchere_gagnante_id), INDEX IDX_29A5EC27A17D8957 (stock_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_categorie (produit_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_CDEA88D8F347EFB (produit_id), INDEX IDX_CDEA88D8BCF5E72D (categorie_id), PRIMARY KEY(produit_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_4B3656604DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, numero_mobile VARCHAR(255) DEFAULT NULL, numero_fixe VARCHAR(255) DEFAULT NULL, verif_solvabilite TINYINT(1) NOT NULL, verif_identite TINYINT(1) NOT NULL, verif_ressortissant TINYINT(1) NOT NULL, est_commissaire_priseur TINYINT(1) NOT NULL, liste_mot_cle VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6494DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, adresse_vente_id INT DEFAULT NULL, lot_vente_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, INDEX IDX_888A2A4C1DD98760 (adresse_vente_id), INDEX IDX_888A2A4CDF0DE63E (lot_vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B2A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD93657A726 FOREIGN KEY (user_ordre_achat_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD97461C345 FOREIGN KEY (lot_ordre_achat_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E83578DED FOREIGN KEY (user_paiement_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC277EA4ED4C FOREIGN KEY (lot_produit_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A853B817 FOREIGN KEY (user_produit_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2772FCB4 FOREIGN KEY (enchere_gagnante_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A17D8957 FOREIGN KEY (stock_produit_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produit_categorie ADD CONSTRAINT FK_CDEA88D8F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_categorie ADD CONSTRAINT FK_CDEA88D8BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656604DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C1DD98760 FOREIGN KEY (adresse_vente_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CDF0DE63E FOREIGN KEY (lot_vente_id) REFERENCES lot (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656604DE7DC5C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494DE7DC5C');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C1DD98760');
        $this->addSql('ALTER TABLE produit_categorie DROP FOREIGN KEY FK_CDEA88D8BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2772FCB4');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD97461C345');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC277EA4ED4C');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4CDF0DE63E');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B2A4C4478');
        $this->addSql('ALTER TABLE produit_categorie DROP FOREIGN KEY FK_CDEA88D8F347EFB');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD93657A726');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E83578DED');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A853B817');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A17D8957');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE ordre_achat');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_categorie');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vente');
    }
}
