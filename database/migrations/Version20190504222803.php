<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20190504222803 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compatibilities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, first_feature_id INT UNSIGNED NOT NULL, second_feature_id INT UNSIGNED NOT NULL, first_type_id INT UNSIGNED NOT NULL, second_type_id INT UNSIGNED NOT NULL, rule VARCHAR(100) DEFAULT NULL, INDEX IDX_B85D7B7EF17CD97E (first_feature_id), INDEX IDX_B85D7B7E83BA58EA (second_feature_id), INDEX IDX_B85D7B7ED6C0E06F (first_type_id), INDEX IDX_B85D7B7ED20E0CFE (second_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedules (id INT UNSIGNED AUTO_INCREMENT NOT NULL, day VARCHAR(150) NOT NULL, time_slots VARCHAR(1500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_schedulers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_id INT UNSIGNED NOT NULL, order_id INT UNSIGNED DEFAULT NULL, date DATETIME DEFAULT NULL, time_slot VARCHAR(1500) DEFAULT NULL, status INT DEFAULT NULL, INDEX IDX_1347C662A76ED395 (user_id), UNIQUE INDEX UNIQ_1347C6628D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7EF17CD97EF17CD97E FOREIGN KEY (first_feature_id) REFERENCES features (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7E83BA58EA83BA58EA FOREIGN KEY (second_feature_id) REFERENCES features (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED6C0E06FD6C0E06F FOREIGN KEY (first_type_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compatibilities ADD CONSTRAINT FK_B85D7B7ED20E0CFED20E0CFE FOREIGN KEY (second_type_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_schedulers ADD CONSTRAINT FK_1347C662A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE work_schedulers ADD CONSTRAINT FK_1347C6628D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE products CHANGE name name VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE product_orders CHANGE price price NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE orders DROP date_of_receiving, CHANGE total_price total_price NUMERIC(10, 2) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE compatibilities');
        $this->addSql('DROP TABLE schedules');
        $this->addSql('DROP TABLE work_schedulers');
        $this->addSql('ALTER TABLE orders ADD date_of_receiving DATETIME NOT NULL, CHANGE total_price total_price NUMERIC(4, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE product_orders CHANGE price price NUMERIC(4, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE products CHANGE name name VARCHAR(30) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
