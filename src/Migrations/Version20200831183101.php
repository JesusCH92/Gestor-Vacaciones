<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831183101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id_user CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_department INT NOT NULL, id_company INT NOT NULL, email VARCHAR(180) NOT NULL, user_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, phone_number VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6496897615D (id_department), INDEX IDX_8D93D6499122A03F (id_company), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id_calendar CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_company INT NOT NULL, init_date_day_off_request DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_date_day_off_request DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', work_days JSON NOT NULL, working_year INT NOT NULL, UNIQUE INDEX UNIQ_6EA9A146E5F8C1CD (working_year), INDEX IDX_6EA9A1469122A03F (id_company), PRIMARY KEY(id_calendar)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id_company INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(50) NOT NULL, PRIMARY KEY(id_company)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day_off_form (code_day_off_form VARCHAR(36) NOT NULL, id_user CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_calendar CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type_day_off VARCHAR(30) NOT NULL, observation VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', id_supervisor VARCHAR(36) DEFAULT NULL, status_day_off_form VARCHAR(15) NOT NULL, count_day_off_request INT NOT NULL, INDEX IDX_90E3A5D36B3CA4B (id_user), INDEX IDX_90E3A5D33E724DD3 (id_calendar), PRIMARY KEY(code_day_off_form)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day_off_form_request (id INT AUTO_INCREMENT NOT NULL, code_day_off_form VARCHAR(36) NOT NULL, day_off_selected DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_9308ADE85BCB57B6 (code_day_off_form), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id_department INT AUTO_INCREMENT NOT NULL, id_company INT NOT NULL, department_name VARCHAR(50) NOT NULL, department_code VARCHAR(10) NOT NULL, INDEX IDX_CD1DE18A9122A03F (id_company), PRIMARY KEY(id_department)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feastday (id_feastday INT AUTO_INCREMENT NOT NULL, id_calendar CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', feastday_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_294E94BE3E724DD3 (id_calendar), PRIMARY KEY(id_feastday)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_day_off (id_type_day_off INT AUTO_INCREMENT NOT NULL, id_calendar CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type_day_off VARCHAR(30) NOT NULL, count_day_off INT NOT NULL, INDEX IDX_BA4D1D993E724DD3 (id_calendar), PRIMARY KEY(id_type_day_off)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496897615D FOREIGN KEY (id_department) REFERENCES department (id_department)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499122A03F FOREIGN KEY (id_company) REFERENCES company (id_company)');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A1469122A03F FOREIGN KEY (id_company) REFERENCES company (id_company)');
        $this->addSql('ALTER TABLE day_off_form ADD CONSTRAINT FK_90E3A5D36B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE day_off_form ADD CONSTRAINT FK_90E3A5D33E724DD3 FOREIGN KEY (id_calendar) REFERENCES calendar (id_calendar)');
        $this->addSql('ALTER TABLE day_off_form_request ADD CONSTRAINT FK_9308ADE85BCB57B6 FOREIGN KEY (code_day_off_form) REFERENCES day_off_form (code_day_off_form)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A9122A03F FOREIGN KEY (id_company) REFERENCES company (id_company)');
        $this->addSql('ALTER TABLE feastday ADD CONSTRAINT FK_294E94BE3E724DD3 FOREIGN KEY (id_calendar) REFERENCES calendar (id_calendar)');
        $this->addSql('ALTER TABLE type_day_off ADD CONSTRAINT FK_BA4D1D993E724DD3 FOREIGN KEY (id_calendar) REFERENCES calendar (id_calendar)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE day_off_form DROP FOREIGN KEY FK_90E3A5D36B3CA4B');
        $this->addSql('ALTER TABLE day_off_form DROP FOREIGN KEY FK_90E3A5D33E724DD3');
        $this->addSql('ALTER TABLE feastday DROP FOREIGN KEY FK_294E94BE3E724DD3');
        $this->addSql('ALTER TABLE type_day_off DROP FOREIGN KEY FK_BA4D1D993E724DD3');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499122A03F');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A1469122A03F');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A9122A03F');
        $this->addSql('ALTER TABLE day_off_form_request DROP FOREIGN KEY FK_9308ADE85BCB57B6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496897615D');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE day_off_form');
        $this->addSql('DROP TABLE day_off_form_request');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE feastday');
        $this->addSql('DROP TABLE type_day_off');
    }
}
