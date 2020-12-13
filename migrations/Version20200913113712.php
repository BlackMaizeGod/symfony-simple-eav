<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200913113712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Implementing deficit inventory';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        // Create excluded_deficit_inventory table
        $this->addSql('CREATE TABLE excluded_deficit_inventory (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, need_to_up INT NOT NULL, updated_at DATETIME DEFAULT NOW(), INDEX IDX_DEFICIT_INVENTORY_PRODUCT_ID (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE excluded_deficit_inventory ADD CONSTRAINT FK_DEFICIT_INVENTORY_PRODUCT_ID FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');

        // Create trigger, which will be fill need_to_up column in excluded_deficit_inventory table
        $this->addSql(<<<SQL
CREATE TRIGGER FILL_DEFICIT_INVENTORY
    AFTER INSERT
    ON product FOR EACH ROW
IF NEW.qty < 1
    THEN
        INSERT INTO excluded_deficit_inventory (product_id, need_to_up) VALUES (NEW.id, 1);
END IF;
SQL);

        // Create trigger, which will be update need_to_up column in excluded_deficit_inventory table
        $this->addSql(<<<SQL
CREATE TRIGGER CALCULATE_DEFICIT_INVENTORY
    AFTER UPDATE
    ON product FOR EACH ROW
IF NEW.qty < 1 
	THEN
    	SET @EXISTS_PRODUCT_ID = (SELECT COUNT(*) FROM excluded_deficit_inventory WHERE product_id = NEW.id);
	    IF @EXISTS_PRODUCT_ID > 0
	        THEN
		        UPDATE excluded_deficit_inventory SET need_to_up = 1, updated_at = NOW() WHERE product_id = NEW.id;
		    ELSE
		        INSERT INTO excluded_deficit_inventory (product_id, need_to_up) VALUES (NEW.id, 1);
		END IF;
    ELSE
    	DELETE FROM excluded_deficit_inventory WHERE product_id = NEW.id;
END IF;
SQL);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

        // Drop triggers
        $this->addSql('DROP TRIGGER FILL_DEFICIT_INVENTORY');
        $this->addSql('DROP TRIGGER CALCULATE_DEFICIT_INVENTORY');

        // Drop excluded_deficit_inventory table
        $this->addSql('ALTER TABLE excluded_deficit_inventory DROP FOREIGN KEY FK_DEFICIT_INVENTORY_PRODUCT_ID');
        $this->addSql('DROP TABLE excluded_deficit_inventory');
    }
}
