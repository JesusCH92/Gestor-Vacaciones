<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805220431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE day_off_form (code_day_off_form CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_user CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', id_supervisor CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type_day_off VARCHAR(30) NOT NULL, status_day_off_form VARCHAR(15) NOT NULL, observation VARCHAR(255) DEFAULT NULL, count_day_off_request INT NOT NULL, created_at DATE NOT NULL, INDEX IDX_90E3A5D36B3CA4B (id_user), INDEX IDX_90E3A5D3E81B122F (id_supervisor), PRIMARY KEY(code_day_off_form)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE day_off_form ADD CONSTRAINT FK_90E3A5D36B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE day_off_form ADD CONSTRAINT FK_90E3A5D3E81B122F FOREIGN KEY (id_supervisor) REFERENCES user (id_user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE day_off_form');
    }
}
