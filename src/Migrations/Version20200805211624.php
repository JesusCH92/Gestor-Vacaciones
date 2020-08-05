<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805211624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id_user CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_department INT NOT NULL, id_company INT NOT NULL, email VARCHAR(180) NOT NULL, user_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, phone_number VARCHAR(30) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6496897615D (id_department), INDEX IDX_8D93D6499122A03F (id_company), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id_company INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(50) NOT NULL, PRIMARY KEY(id_company)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id_department INT AUTO_INCREMENT NOT NULL, id_company INT NOT NULL, department_name VARCHAR(50) NOT NULL, department_code VARCHAR(10) NOT NULL, INDEX IDX_CD1DE18A9122A03F (id_company), PRIMARY KEY(id_department)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496897615D FOREIGN KEY (id_department) REFERENCES department (id_department)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499122A03F FOREIGN KEY (id_company) REFERENCES company (id_company)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A9122A03F FOREIGN KEY (id_company) REFERENCES company (id_company)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499122A03F');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A9122A03F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496897615D');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE department');
    }
}
