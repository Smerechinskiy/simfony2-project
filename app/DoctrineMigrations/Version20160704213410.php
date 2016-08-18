<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160704213410 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oder (id BIGINT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created DATETIME NOT NULL, INDEX IDX_AB5ED447A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oder_item (id BIGINT AUTO_INCREMENT NOT NULL, order_id BIGINT NOT NULL, product_id BIGINT NOT NULL, quantity INT NOT NULL, INDEX IDX_2A0A990A8D9F6D38 (order_id), INDEX IDX_2A0A990A4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oder ADD CONSTRAINT FK_AB5ED447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE oder_item ADD CONSTRAINT FK_2A0A990A8D9F6D38 FOREIGN KEY (order_id) REFERENCES oder (id)');
        $this->addSql('ALTER TABLE oder_item ADD CONSTRAINT FK_2A0A990A4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oder_item DROP FOREIGN KEY FK_2A0A990A8D9F6D38');
        $this->addSql('DROP TABLE oder');
        $this->addSql('DROP TABLE oder_item');
    }
}
