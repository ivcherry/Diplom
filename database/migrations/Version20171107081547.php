<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20171107081547 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE features (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_feature (feature_id INT UNSIGNED NOT NULL, type_id INT UNSIGNED NOT NULL, INDEX IDX_37F61A9360E4B879 (feature_id), INDEX IDX_37F61A93C54C8C93 (type_id), PRIMARY KEY(feature_id, type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_feature ADD CONSTRAINT FK_37F61A9360E4B879 FOREIGN KEY (feature_id) REFERENCES features (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_feature ADD CONSTRAINT FK_37F61A93C54C8C93 FOREIGN KEY (type_id) REFERENCES types (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_feature DROP FOREIGN KEY FK_37F61A9360E4B879');
        $this->addSql('DROP TABLE features');
        $this->addSql('DROP TABLE type_feature');
    }
}
