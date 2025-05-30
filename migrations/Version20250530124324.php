<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530124324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, table_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE order_customer (order_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_60C16CB88D9F6D38 (order_id), INDEX IDX_60C16CB89395C3F3 (customer_id), PRIMARY KEY(order_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE order_food (order_id INT NOT NULL, food_id INT NOT NULL, INDEX IDX_99C913E08D9F6D38 (order_id), INDEX IDX_99C913E0BA8E87C4 (food_id), PRIMARY KEY(order_id, food_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_customer ADD CONSTRAINT FK_60C16CB88D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_customer ADD CONSTRAINT FK_60C16CB89395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_food ADD CONSTRAINT FK_99C913E08D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_food ADD CONSTRAINT FK_99C913E0BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE order_customer DROP FOREIGN KEY FK_60C16CB88D9F6D38
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_customer DROP FOREIGN KEY FK_60C16CB89395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_food DROP FOREIGN KEY FK_99C913E08D9F6D38
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_food DROP FOREIGN KEY FK_99C913E0BA8E87C4
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `order`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE order_customer
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE order_food
        SQL);
    }
}
