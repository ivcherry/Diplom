<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20171130210852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_features (product_id INT UNSIGNED NOT NULL, feature_id INT UNSIGNED NOT NULL, value VARCHAR(100) DEFAULT NULL, INDEX IDX_7470B6844584665A (product_id), INDEX IDX_7470B68460E4B879 (feature_id), PRIMARY KEY(product_id, feature_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_features ADD CONSTRAINT FK_7470B6844584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_features ADD CONSTRAINT FK_7470B68460E4B879 FOREIGN KEY (feature_id) REFERENCES features (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_features');
    }
}
