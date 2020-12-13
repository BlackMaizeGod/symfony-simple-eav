<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201213190929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ATTRIBUTE_DECIMAL_ATTRIBUTE_ID_ENTITY_ID ON attribute_decimal (attribute_id, entity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ATTRIBUTE_INT_ATTRIBUTE_ID_ENTITY_ID ON attribute_int (attribute_id, entity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ATTRIBUTE_VARCHAR_ATTRIBUTE_ID_ENTITY_ID ON attribute_varchar (attribute_id, entity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_ATTRIBUTE_DECIMAL_ATTRIBUTE_ID_ENTITY_ID ON attribute_decimal');
        $this->addSql('DROP INDEX UNIQ_ATTRIBUTE_INT_ATTRIBUTE_ID_ENTITY_ID ON attribute_int');
        $this->addSql('DROP INDEX UNIQ_ATTRIBUTE_VARCHAR_ATTRIBUTE_ID_ENTITY_ID ON attribute_varchar');
    }
}
