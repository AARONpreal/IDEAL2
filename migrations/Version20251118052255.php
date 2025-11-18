<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118052255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE dossier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vaccin_id_seq CASCADE');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('ALTER TABLE vaccin DROP CONSTRAINT fk_b5dca0a71b65292');
        $this->addSql('ALTER TABLE formation DROP CONSTRAINT fk_404021bf1b65292');
        $this->addSql('ALTER TABLE dossier DROP CONSTRAINT fk_3d48e0371b65292');
        $this->addSql('DROP TABLE vaccin');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('ALTER TABLE contrat ADD numero_contrat VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE contrat ADD salaire NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat DROP salaire_base');
        $this->addSql('CREATE SEQUENCE contrat_id_seq');
        $this->addSql('SELECT setval(\'contrat_id_seq\', (SELECT MAX(id) FROM contrat))');
        $this->addSql('ALTER TABLE contrat ALTER id SET DEFAULT nextval(\'contrat_id_seq\')');
        $this->addSql('ALTER TABLE contrat ALTER type_contrat DROP NOT NULL');
        $this->addSql('ALTER TABLE contrat ALTER type_contrat TYPE VARCHAR(255)');
        $this->addSql('CREATE SEQUENCE departement_id_seq');
        $this->addSql('SELECT setval(\'departement_id_seq\', (SELECT MAX(id) FROM departement))');
        $this->addSql('ALTER TABLE departement ALTER id SET DEFAULT nextval(\'departement_id_seq\')');
        $this->addSql('CREATE SEQUENCE employe_id_seq');
        $this->addSql('SELECT setval(\'employe_id_seq\', (SELECT MAX(id) FROM employe))');
        $this->addSql('ALTER TABLE employe ALTER id SET DEFAULT nextval(\'employe_id_seq\')');
        $this->addSql('ALTER TABLE fiche_medical ADD nee VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_medical ADD groupe_sanguin_rhesus VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_medical DROP groupe_sanguin');
        $this->addSql('ALTER TABLE fiche_medical DROP date_naissance');
        $this->addSql('ALTER TABLE fiche_medical DROP rhesus');
        $this->addSql('CREATE SEQUENCE fiche_medical_id_seq');
        $this->addSql('SELECT setval(\'fiche_medical_id_seq\', (SELECT MAX(id) FROM fiche_medical))');
        $this->addSql('ALTER TABLE fiche_medical ALTER id SET DEFAULT nextval(\'fiche_medical_id_seq\')');
        $this->addSql('ALTER TABLE fiche_medical ALTER numero_dossier TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE fiche_medical ALTER telephone TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE fiche_medical ALTER profession SET NOT NULL');
        $this->addSql('ALTER TABLE fiche_medical ALTER date DROP NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FDA5C80FB1CFE96 ON fiche_medical (numero_dossier)');
        $this->addSql('CREATE SEQUENCE fonction_id_seq');
        $this->addSql('SELECT setval(\'fonction_id_seq\', (SELECT MAX(id) FROM fonction))');
        $this->addSql('ALTER TABLE fonction ALTER id SET DEFAULT nextval(\'fonction_id_seq\')');
        $this->addSql('CREATE SEQUENCE service_id_seq');
        $this->addSql('SELECT setval(\'service_id_seq\', (SELECT MAX(id) FROM service))');
        $this->addSql('ALTER TABLE service ALTER id SET DEFAULT nextval(\'service_id_seq\')');
        $this->addSql('ALTER TABLE visite_medical ADD prochaine_visite DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE visite_medical ADD resultats TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE visite_medical ADD aptitude BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE visite_medical DROP type_visite');
        $this->addSql('ALTER TABLE visite_medical DROP conclusion');
        $this->addSql('CREATE SEQUENCE visite_medical_id_seq');
        $this->addSql('SELECT setval(\'visite_medical_id_seq\', (SELECT MAX(id) FROM visite_medical))');
        $this->addSql('ALTER TABLE visite_medical ALTER id SET DEFAULT nextval(\'visite_medical_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE dossier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vaccin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vaccin (id INT NOT NULL, employe_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date_vaccination DATE NOT NULL, statut VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b5dca0a71b65292 ON vaccin (employe_id)');
        $this->addSql('CREATE TABLE formation (id INT NOT NULL, employe_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date_formation DATE NOT NULL, statut VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_404021bf1b65292 ON formation (employe_id)');
        $this->addSql('CREATE TABLE dossier (id INT NOT NULL, employe_id INT NOT NULL, type_document VARCHAR(255) NOT NULL, fichier VARCHAR(255) DEFAULT NULL, est_present BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_3d48e0371b65292 ON dossier (employe_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('ALTER TABLE vaccin ADD CONSTRAINT fk_b5dca0a71b65292 FOREIGN KEY (employe_id) REFERENCES employe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT fk_404021bf1b65292 FOREIGN KEY (employe_id) REFERENCES employe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT fk_3d48e0371b65292 FOREIGN KEY (employe_id) REFERENCES employe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE fonction ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE service ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE departement ALTER id DROP DEFAULT');
        $this->addSql('DROP INDEX UNIQ_6FDA5C80FB1CFE96');
        $this->addSql('ALTER TABLE fiche_medical ADD date_naissance DATE NOT NULL');
        $this->addSql('ALTER TABLE fiche_medical ADD rhesus VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_medical DROP nee');
        $this->addSql('ALTER TABLE fiche_medical ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE fiche_medical ALTER numero_dossier TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_medical ALTER telephone TYPE VARCHAR(20)');
        $this->addSql('ALTER TABLE fiche_medical ALTER profession DROP NOT NULL');
        $this->addSql('ALTER TABLE fiche_medical ALTER date SET NOT NULL');
        $this->addSql('ALTER TABLE fiche_medical RENAME COLUMN groupe_sanguin_rhesus TO groupe_sanguin');
        $this->addSql('ALTER TABLE visite_medical ADD type_visite VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE visite_medical ADD conclusion TEXT NOT NULL');
        $this->addSql('ALTER TABLE visite_medical DROP prochaine_visite');
        $this->addSql('ALTER TABLE visite_medical DROP resultats');
        $this->addSql('ALTER TABLE visite_medical DROP aptitude');
        $this->addSql('ALTER TABLE visite_medical ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE employe ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE contrat ADD salaire_base NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE contrat DROP numero_contrat');
        $this->addSql('ALTER TABLE contrat DROP salaire');
        $this->addSql('ALTER TABLE contrat ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE contrat ALTER type_contrat SET NOT NULL');
        $this->addSql('ALTER TABLE contrat ALTER type_contrat TYPE VARCHAR(50)');
    }
}
