<?php declare(strict_types=1);

namespace App\Domain\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402020646 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EA2A2FE40 FOREIGN KEY (userCreate_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91E992AC972 FOREIGN KEY (userUpdate_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EA2A2FE40 ON trick (userCreate_id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91E992AC972 ON trick (userUpdate_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EA2A2FE40');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91E992AC972');
        $this->addSql('DROP INDEX IDX_D8F0A91EA2A2FE40 ON trick');
        $this->addSql('DROP INDEX IDX_D8F0A91E992AC972 ON trick');
    }
}
