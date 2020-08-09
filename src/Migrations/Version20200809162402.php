<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200809162402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calendar ADD working_year INT NOT NULL, DROP init_date_work_year, DROP end_date_work_year');
        $this->addSql('ALTER TABLE feastday ADD working_year INT NOT NULL');
        $this->addSql('ALTER TABLE remaining_day_off_summary_by_user ADD working_year INT NOT NULL');
        $this->addSql('ALTER TABLE type_day_off ADD working_year INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calendar ADD init_date_work_year DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', ADD end_date_work_year DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', DROP working_year');
        $this->addSql('ALTER TABLE feastday DROP working_year');
        $this->addSql('ALTER TABLE remaining_day_off_summary_by_user DROP working_year');
        $this->addSql('ALTER TABLE type_day_off DROP working_year');
    }
}
