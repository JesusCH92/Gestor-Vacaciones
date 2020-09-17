<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Common\Infrastructure\Constants\Constants;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200910023630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `company` VALUES (1,'MPWAR')");  // ! Company Default Values
        $this->addSql("INSERT INTO `department` VALUES (1,1,'Trabajo Final de Master','TFM')");     // ! Department in Company
        // ! create config by calendars 2019 and 2020
        $this->addSql("INSERT INTO `calendar` VALUES ('1a2edc8e-8b1c-4769-81ae-2a53d148b7d8',1,'2019-01-01','2020-01-25','[\"2\", \"3\", \"4\", \"5\"]',2019),('3bef8293-9dfb-4648-8fe7-373185240766',1,'2020-01-01','2021-01-31','[\"1\", \"2\", \"4\", \"5\"]',2020)");
        // ! create day off by calendar 2019 and 2020
        $this->addSql("INSERT INTO `type_day_off` VALUES (1,'3bef8293-9dfb-4648-8fe7-373185240766','Holiday',20),(2,'3bef8293-9dfb-4648-8fe7-373185240766','Personal',20),(3,'1a2edc8e-8b1c-4769-81ae-2a53d148b7d8','Holiday',10),(4,'1a2edc8e-8b1c-4769-81ae-2a53d148b7d8','Personal',10)");
        $this->addSql(
            <<<SQL
INSERT INTO `user`
(id_user, id_department,id_company, email,user_name,last_name,phone_number, password, roles)
VALUES(:id,:id_department, :id_company, :email, :user_name, :last_name, :phone_number,:password, :roles);
SQL
            ,
            [
                'id'       => Constants::ADMIN_ID,
                'id_department' => 1,
                'id_company' => 1,
                'email'    => 'admin@admin',
                'user_name' =>'Admin',
                'last_name'=>'Administrator',
                'phone_number'=> '123456789',
                'password' => '$argon2id$v=19$m=65536,t=4,p=1$8CBdVuKZUB0uKdXUmYbMdw$Qmt8eopV40r4U3Laq9ft5V8cI+fdR/pD7EchRxOTmaI',
                'roles'    => '["ROLE_ADMIN"]',
            ]
        );
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