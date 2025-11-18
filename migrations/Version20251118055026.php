<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118055026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contrat (id SERIAL NOT NULL, employe_id INT NOT NULL, numero_contrat VARCHAR(50) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, type_contrat VARCHAR(255) DEFAULT NULL, salaire NUMERIC(10, 2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_603499931B65292 ON contrat (employe_id)');
        $this->addSql('CREATE TABLE departement (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE employe (id SERIAL NOT NULL, departement_id INT NOT NULL, service_id INT NOT NULL, fonction_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_entree DATE NOT NULL, matricule VARCHAR(50) NOT NULL, numero_cnps VARCHAR(50) DEFAULT NULL, categorie_contrat VARCHAR(50) NOT NULL, situation_matrimoniale VARCHAR(50) DEFAULT NULL, date_naissance DATE DEFAULT NULL, age INT DEFAULT NULL, genre VARCHAR(20) DEFAULT NULL, groupe_sanguin VARCHAR(10) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F804D3B912B2DC9C ON employe (matricule)');
        $this->addSql('CREATE INDEX IDX_F804D3B9CCF9E01E ON employe (departement_id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9ED5CA9E6 ON employe (service_id)');
        $this->addSql('CREATE INDEX IDX_F804D3B957889920 ON employe (fonction_id)');
        $this->addSql('CREATE TABLE fiche_medical (id SERIAL NOT NULL, employe_id INT NOT NULL, numero_dossier VARCHAR(50) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom_jeune_fille VARCHAR(255) DEFAULT NULL, nee VARCHAR(255) DEFAULT NULL, adresse TEXT DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, personne_acontacter VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) NOT NULL, groupe_sanguin_rhesus VARCHAR(10) DEFAULT NULL, allergie TEXT DEFAULT NULL, antecedents_familiaux TEXT DEFAULT NULL, antecedents_personnels TEXT DEFAULT NULL, correspondants_medicaux TEXT DEFAULT NULL, date DATE DEFAULT NULL, diagnostic TEXT DEFAULT NULL, conduite_avenir TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FDA5C80FB1CFE96 ON fiche_medical (numero_dossier)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FDA5C801B65292 ON fiche_medical (employe_id)');
        $this->addSql('CREATE TABLE fonction (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service (id SERIAL NOT NULL, departement_id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E19D9AD2CCF9E01E ON service (departement_id)');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE visite_medical (id SERIAL NOT NULL, employe_id INT NOT NULL, date_visite DATE NOT NULL, prochaine_visite DATE DEFAULT NULL, resultats TEXT DEFAULT NULL, aptitude BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BDDA727C1B65292 ON visite_medical (employe_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499931B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B957889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche_medical ADD CONSTRAINT FK_6FDA5C801B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE visite_medical ADD CONSTRAINT FK_BDDA727C1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contrat DROP CONSTRAINT FK_603499931B65292');
        $this->addSql('ALTER TABLE employe DROP CONSTRAINT FK_F804D3B9CCF9E01E');
        $this->addSql('ALTER TABLE employe DROP CONSTRAINT FK_F804D3B9ED5CA9E6');
        $this->addSql('ALTER TABLE employe DROP CONSTRAINT FK_F804D3B957889920');
        $this->addSql('ALTER TABLE fiche_medical DROP CONSTRAINT FK_6FDA5C801B65292');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2CCF9E01E');
        $this->addSql('ALTER TABLE visite_medical DROP CONSTRAINT FK_BDDA727C1B65292');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE fiche_medical');
        $this->addSql('DROP TABLE fonction');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE visite_medical');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
