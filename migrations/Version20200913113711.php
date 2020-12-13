<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200913113711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        // Add qty column to product table
        $this->addSql('ALTER TABLE product ADD qty INT NOT NULL');

        // Add unique index to sku column in product table
        $this->addSql('ALTER TABLE product ADD CONSTRAINT UNIQ_PRODUCT_SKU UNIQUE (sku)');

        // insert data attribute_type table
        $this->addSql('INSERT INTO attribute_type (type) VALUES ("int")');
        $this->addSql('INSERT INTO attribute_type (type) VALUES ("varchar")');
        $this->addSql('INSERT INTO attribute_type (type) VALUES ("decimal")');

        // add unique index to column code in product_attribute table
        $this->addSql('ALTER TABLE product_attribute ADD CONSTRAINT PRODUCT_ATTRIBUTE_CODE UNIQUE KEY (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

        // Drop unique index for product table
        $this->addSql('ALTER TABLE DROP INDEX UNIQ_PRODUCT_SKU');

        // Drop qty column from product table
        $this->addSql('ALTER TABLE product DROP COLUMN qty');

        // drop unique index for column code in product_attribute table
        $this->addSql('ALTER TABLE product_attribute DROP INDEX PRODUCT_ATTRIBUTE_CODE');
    }
}
