<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20171124185833 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_orders (id INT UNSIGNED AUTO_INCREMENT NOT NULL, product_id INT UNSIGNED NOT NULL, order_id INT UNSIGNED NOT NULL, price NUMERIC(4, 2) DEFAULT NULL, amount INT UNSIGNED DEFAULT NULL, INDEX IDX_8753BC4A4584665A (product_id), INDEX IDX_8753BC4A8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT UNSIGNED AUTO_INCREMENT NOT NULL, date_of_order DATETIME NOT NULL, date_of_receiving DATETIME NOT NULL, total_price NUMERIC(4, 2) DEFAULT NULL, orderscol VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_orders ADD CONSTRAINT FK_8753BC4A4584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE product_orders ADD CONSTRAINT FK_8753BC4A8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_orders DROP FOREIGN KEY FK_8753BC4A8D9F6D38');
        $this->addSql('DROP TABLE product_orders');
        $this->addSql('DROP TABLE orders');
    }
}
