<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20171209112531 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compatibilities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, first_feature_id INT UNSIGNED NOT NULL, second_feature_id INT UNSIGNED NOT NULL, first_type_id INT UNSIGNED NOT NULL, second_type_id INT UNSIGNED NOT NULL, rule VARCHAR(100) DEFAULT NULL, INDEX IDX_B85D7B7EF17CD97E (first_feature_id), INDEX IDX_B85D7B7E83BA58EA (second_feature_id), INDEX IDX_B85D7B7ED6C0E06F (first_type_id), INDEX IDX_B85D7B7ED20E0CFE (second_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7EF17CD97EF17CD97E FOREIGN KEY (first_feature_id) REFERENCES features (id)');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7E83BA58EA83BA58EA FOREIGN KEY (second_feature_id) REFERENCES features (id)');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED6C0E06FD6C0E06F FOREIGN KEY (first_type_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED20E0CFED20E0CFE FOREIGN KEY (second_type_id) REFERENCES types (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE compatibilities');
    }
}
