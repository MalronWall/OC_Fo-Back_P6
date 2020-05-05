<?php

declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422224324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, media_id UUID DEFAULT NULL, username VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, token_forgot_pwd VARCHAR(255) DEFAULT NULL, token_date_forgot_pwd TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649989D9B62 ON "user" (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649EA9FDD75 ON "user" (media_id)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".media_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE trick (id UUID NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_the TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_the TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, figureGroup_id UUID DEFAULT NULL, userCreate_id UUID DEFAULT NULL, userUpdate_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8F0A91E989D9B62 ON trick (slug)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E7935E3EE ON trick (figureGroup_id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EA2A2FE40 ON trick (userCreate_id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E992AC972 ON trick (userUpdate_id)');
        $this->addSql('COMMENT ON COLUMN trick.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN trick.figureGroup_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN trick.userCreate_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN trick.userUpdate_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE figure_group (id UUID NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7FEDC2FC2B36786B ON figure_group (title)');
        $this->addSql('COMMENT ON COLUMN figure_group.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE comment (id UUID NOT NULL, trick_id UUID DEFAULT NULL, comment TEXT NOT NULL, created_the TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, userCreate_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CA2A2FE40 ON comment (userCreate_id)');
        $this->addSql('CREATE INDEX IDX_9474526CB281BE2E ON comment (trick_id)');
        $this->addSql('COMMENT ON COLUMN comment.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN comment.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN comment.userCreate_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE media (id UUID NOT NULL, trick_id UUID DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, first BOOLEAN NOT NULL, typeMedia_id UUID DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4F8031AB ON media (typeMedia_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB281BE2E ON media (trick_id)');
        $this->addSql('COMMENT ON COLUMN media.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN media.trick_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN media.typeMedia_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE type_media (id UUID NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_642026FB8CDE5729 ON type_media (type)');
        $this->addSql('COMMENT ON COLUMN type_media.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E7935E3EE FOREIGN KEY (figureGroup_id) REFERENCES figure_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EA2A2FE40 FOREIGN KEY (userCreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E992AC972 FOREIGN KEY (userUpdate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA2A2FE40 FOREIGN KEY (userCreate_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4F8031AB FOREIGN KEY (typeMedia_id) REFERENCES type_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE trick DROP CONSTRAINT FK_D8F0A91EA2A2FE40');
        $this->addSql('ALTER TABLE trick DROP CONSTRAINT FK_D8F0A91E992AC972');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CA2A2FE40');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CB281BE2E');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10CB281BE2E');
        $this->addSql('ALTER TABLE trick DROP CONSTRAINT FK_D8F0A91E7935E3EE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649EA9FDD75');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C4F8031AB');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE trick');
        $this->addSql('DROP TABLE figure_group');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE type_media');
    }
}
