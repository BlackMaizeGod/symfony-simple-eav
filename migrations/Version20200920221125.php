<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200920221125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_FA7AEFFBC54C8C93 (type_id), UNIQUE INDEX UNIQ_ATTRIBUTE_CODE (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_varchar (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, entity_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_74488478B6E62EFA (attribute_id), INDEX IDX_7448847881257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_int (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, entity_id INT NOT NULL, value INT NOT NULL, INDEX IDX_225B4F0EB6E62EFA (attribute_id), INDEX IDX_225B4F0E81257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_decimal (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, entity_id INT NOT NULL, value NUMERIC(10, 2) NOT NULL, INDEX IDX_D161EA57B6E62EFA (attribute_id), INDEX IDX_D161EA5781257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribute ADD CONSTRAINT FK_FA7AEFFBC54C8C93 FOREIGN KEY (type_id) REFERENCES attribute_type (id)');
        $this->addSql('ALTER TABLE attribute_varchar ADD CONSTRAINT FK_74488478B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('ALTER TABLE attribute_varchar ADD CONSTRAINT FK_744884784584665A FOREIGN KEY (entity_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE attribute_int ADD CONSTRAINT FK_225B4F0EB6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('ALTER TABLE attribute_int ADD CONSTRAINT FK_225B4F0E81257D5D FOREIGN KEY (entity_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE attribute_decimal ADD CONSTRAINT FK_D161EA57B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id)');
        $this->addSql('ALTER TABLE attribute_decimal ADD CONSTRAINT FK_D161EA5781257D5D FOREIGN KEY (entity_id) REFERENCES product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_decimal DROP FOREIGN KEY FK_D161EA57B6E62EFA');
        $this->addSql('ALTER TABLE attribute_int DROP FOREIGN KEY FK_225B4F0EB6E62EFA');
        $this->addSql('ALTER TABLE attribute_varchar DROP FOREIGN KEY FK_74488478B6E62EFA');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_decimal');
        $this->addSql('DROP TABLE attribute_int');
        $this->addSql('DROP TABLE attribute_varchar');
    }
}
