<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429190618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE pockets (id UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, client_id VARCHAR(32) NOT NULL, network VARCHAR(32) NOT NULL, pocket_id UUID NOT NULL, invite_token_token VARCHAR(255) DEFAULT NULL, invite_token_expires TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_76505AFA19EB6921 ON pockets (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_76505AFACB37BCE1 ON pockets (invite_token_token)');
        $this->addSql('COMMENT ON COLUMN pockets.id IS \'(DC2Type:pocket_id)\'');
        $this->addSql('COMMENT ON COLUMN pockets.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN pockets.pocket_id IS \'(DC2Type:pocket_pocket_id)\'');
        $this->addSql('COMMENT ON COLUMN pockets.invite_token_expires IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE pockets');
    }
}
