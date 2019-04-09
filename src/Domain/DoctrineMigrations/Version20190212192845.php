<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212192845 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE figure_group (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7FEDC2FC2B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', trick_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, typeMedia_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_6A2CA10C5E237E06 (name), INDEX IDX_6A2CA10C4F8031AB (typeMedia_id), INDEX IDX_6A2CA10CB281BE2E (trick_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_media (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_642026FB8CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4F8031AB FOREIGN KEY (typeMedia_id) REFERENCES type_media (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('ALTER TABLE trick ADD user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD figureGroup_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', DROP figure_group');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E7935E3EE FOREIGN KEY (figureGroup_id) REFERENCES figure_group (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E7935E3EE ON trick (figureGroup_id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EA76ED395 ON trick (user_id)');
        $this->addSql('ALTER TABLE user ADD media_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649EA9FDD75 ON user (media_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E7935E3EE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EA9FDD75');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C4F8031AB');
        $this->addSql('DROP TABLE figure_group');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE type_media');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EA76ED395');
        $this->addSql('DROP INDEX IDX_D8F0A91E7935E3EE ON trick');
        $this->addSql('DROP INDEX IDX_D8F0A91EA76ED395 ON trick');
        $this->addSql('ALTER TABLE trick ADD figure_group VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_id, DROP figureGroup_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649EA9FDD75 ON user');
        $this->addSql('ALTER TABLE user DROP media_id');
    }
}
