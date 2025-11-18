<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118052718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('DROP INDEX users_username_key');
        $this->addSql('ALTER TABLE users ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE users DROP username');
        $this->addSql('ALTER TABLE users DROP created_at');
        $this->addSql('ALTER TABLE users DROP updated_at');
        $this->addSql('ALTER TABLE users ALTER email TYPE VARCHAR(180)');
        $this->addSql('ALTER INDEX users_email_key RENAME TO UNIQ_1483A5E9E7927C74');
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
        $this->addSql('ALTER TABLE employe ALTER id DROP DEFAULT');
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
        $this->addSql('ALTER TABLE users ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE users ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE users DROP roles');
        $this->addSql('ALTER TABLE users ALTER email TYPE VARCHAR(255)');
        $this->addSql('CREATE UNIQUE INDEX users_username_key ON users (username)');
        $this->addSql('ALTER INDEX uniq_1483a5e9e7927c74 RENAME TO users_email_key');
        $this->addSql('ALTER TABLE fonction ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE service ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE departement ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE visite_medical ADD type_visite VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE visite_medical ADD conclusion TEXT NOT NULL');
        $this->addSql('ALTER TABLE visite_medical DROP prochaine_visite');
        $this->addSql('ALTER TABLE visite_medical DROP resultats');
        $this->addSql('ALTER TABLE visite_medical DROP aptitude');
        $this->addSql('ALTER TABLE visite_medical ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE contrat ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE contrat ALTER type_contrat SET NOT NULL');
        $this->addSql('ALTER TABLE contrat ALTER type_contrat TYPE VARCHAR(50)');
    }
}
