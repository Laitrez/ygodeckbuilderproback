<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025122304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cards (id INT AUTO_INCREMENT NOT NULL, konami_id INT DEFAULT NULL, occurs INT DEFAULT NULL, decks_id INT DEFAULT NULL, INDEX IDX_4C258FD68053A92 (decks_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE decks (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, is_public TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_A3FCC6325E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, rate INT NOT NULL, user_id INT DEFAULT NULL, deck_id INT DEFAULT NULL, INDEX IDX_D8892622A76ED395 (user_id), INDEX IDX_D8892622111948DC (deck_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_cards (id INT AUTO_INCREMENT NOT NULL, konami_id INT NOT NULL, favorites TINYINT(1) NOT NULL, occurs INT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_E600A3A5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, create_at DATE NOT NULL, delete_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FD68053A92 FOREIGN KEY (decks_id) REFERENCES decks (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622111948DC FOREIGN KEY (deck_id) REFERENCES decks (id)');
        $this->addSql('ALTER TABLE user_cards ADD CONSTRAINT FK_E600A3A5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cards DROP FOREIGN KEY FK_4C258FD68053A92');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622111948DC');
        $this->addSql('ALTER TABLE user_cards DROP FOREIGN KEY FK_E600A3A5A76ED395');
        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE decks');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE user_cards');
        $this->addSql('DROP TABLE users');
    }
}
