<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310060058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(255) DEFAULT NULL, CHANGE rue rue VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE enchere CHANGE prix_proposer prix_proposer DOUBLE PRECISION DEFAULT NULL, CHANGE est_adjuger est_adjuger TINYINT(1) DEFAULT NULL, CHANGE date_heure_vente date_heure_vente DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE lot CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ordre_achat CHANGE autobot autobot TINYINT(1) DEFAULT NULL, CHANGE montant_max montant_max DOUBLE PRECISION DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE type_paiement type_paiement VARCHAR(255) DEFAULT NULL, CHANGE validation_paiement validation_paiement TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE nom_artiste nom_artiste VARCHAR(255) DEFAULT NULL, CHANGE nom_style nom_style VARCHAR(255) DEFAULT NULL, CHANGE nom_produit nom_produit VARCHAR(255) DEFAULT NULL, CHANGE prix_reserve prix_reserve DOUBLE PRECISION DEFAULT NULL, CHANGE reference_catalogue reference_catalogue VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE est_envoyer est_envoyer TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE numero_mobile numero_mobile VARCHAR(255) DEFAULT NULL, CHANGE numero_fixe numero_fixe VARCHAR(255) DEFAULT NULL, CHANGE verif_solvabilite verif_solvabilite TINYINT(1) DEFAULT NULL, CHANGE verif_identite verif_identite TINYINT(1) DEFAULT NULL, CHANGE verif_ressortissant verif_ressortissant TINYINT(1) DEFAULT NULL, CHANGE est_commissaire_priseur est_commissaire_priseur TINYINT(1) DEFAULT NULL, CHANGE liste_mot_cle liste_mot_cle VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vente CHANGE date_debut date_debut DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse CHANGE pays pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE rue rue VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE enchere CHANGE prix_proposer prix_proposer DOUBLE PRECISION NOT NULL, CHANGE est_adjuger est_adjuger TINYINT(1) NOT NULL, CHANGE date_heure_vente date_heure_vente DATETIME NOT NULL');
        $this->addSql('ALTER TABLE lot CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ordre_achat CHANGE autobot autobot TINYINT(1) NOT NULL, CHANGE montant_max montant_max DOUBLE PRECISION NOT NULL, CHANGE date_creation date_creation DATETIME NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE type_paiement type_paiement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE validation_paiement validation_paiement TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE produit CHANGE nom_artiste nom_artiste VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_style nom_style VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_produit nom_produit VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prix_reserve prix_reserve DOUBLE PRECISION NOT NULL, CHANGE reference_catalogue reference_catalogue VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE est_envoyer est_envoyer TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE age age INT NOT NULL, CHANGE numero_mobile numero_mobile VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE numero_fixe numero_fixe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE verif_solvabilite verif_solvabilite TINYINT(1) NOT NULL, CHANGE verif_identite verif_identite TINYINT(1) NOT NULL, CHANGE verif_ressortissant verif_ressortissant TINYINT(1) NOT NULL, CHANGE est_commissaire_priseur est_commissaire_priseur TINYINT(1) NOT NULL, CHANGE liste_mot_cle liste_mot_cle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vente CHANGE date_debut date_debut DATETIME NOT NULL');
    }
}
