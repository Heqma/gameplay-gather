<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220521180701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, category VARCHAR(100) NOT NULL, platform VARCHAR(100) NOT NULL, image VARCHAR(255) NOT NULL, release_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C5E237E06 ON game (name)');
        $this->addSql('COMMENT ON COLUMN game.release_date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, name VARCHAR(64) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, role VARCHAR(100) DEFAULT \'player\' NOT NULL, status BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE user_game (user_id INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(user_id, game_id))');
        $this->addSql('CREATE INDEX IDX_59AA7D45A76ED395 ON user_game (user_id)');
        $this->addSql('CREATE INDEX IDX_59AA7D45E48FD905 ON user_game (game_id)');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_game DROP CONSTRAINT FK_59AA7D45E48FD905');
        $this->addSql('ALTER TABLE user_game DROP CONSTRAINT FK_59AA7D45A76ED395');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_game');
    }
}
