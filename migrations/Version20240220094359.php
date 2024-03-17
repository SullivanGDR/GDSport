<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220094359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6686E7942B');
        $this->addSql('DROP TABLE tendance');
        $this->addSql('DROP INDEX IDX_23A0E6686E7942B ON article');
        $this->addSql('ALTER TABLE article ADD tendance TINYINT(1) NOT NULL, DROP tendance_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tendance (id INT AUTO_INCREMENT NOT NULL, yes_or_no VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article ADD tendance_id INT NOT NULL, DROP tendance');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6686E7942B FOREIGN KEY (tendance_id) REFERENCES tendance (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6686E7942B ON article (tendance_id)');
    }
}
