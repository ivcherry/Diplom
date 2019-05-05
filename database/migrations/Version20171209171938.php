<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20171209171938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7ED20E0CFED20E0CFE');
        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7E83BA58EA83BA58EA');
        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7ED6C0E06FD6C0E06F');
        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7EF17CD97EF17CD97E');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED20E0CFED20E0CFE FOREIGN KEY (second_type_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7E83BA58EA83BA58EA FOREIGN KEY (second_feature_id) REFERENCES features (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED6C0E06FD6C0E06F FOREIGN KEY (first_type_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7EF17CD97EF17CD97E FOREIGN KEY (first_feature_id) REFERENCES features (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7EF17CD97EF17CD97E');
        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7E83BA58EA83BA58EA');
        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7ED6C0E06FD6C0E06F');
        $this->addSql('ALTER TABLE compatibilities DROP FOREIGN KEY FK_B85D7B7ED20E0CFED20E0CFE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7EF17CD97EF17CD97E FOREIGN KEY (first_feature_id) REFERENCES features (id)');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7E83BA58EA83BA58EA FOREIGN KEY (second_feature_id) REFERENCES features (id)');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED6C0E06FD6C0E06F FOREIGN KEY (first_type_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED20E0CFED20E0CFE FOREIGN KEY (second_type_id) REFERENCES types (id)');
    }
}
