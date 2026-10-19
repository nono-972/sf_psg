<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261018161153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joueur_position (joueur_id INT NOT NULL, position_id INT NOT NULL, INDEX IDX_CCADCA6DA9E2D76C (joueur_id), INDEX IDX_CCADCA6DDD842E46 (position_id), PRIMARY KEY (joueur_id, position_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recompense_joueur (recompense_id INT NOT NULL, joueur_id INT NOT NULL, INDEX IDX_F8461E474D714096 (recompense_id), INDEX IDX_F8461E47A9E2D76C (joueur_id), PRIMARY KEY (recompense_id, joueur_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE joueur_position ADD CONSTRAINT FK_CCADCA6DA9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur_position ADD CONSTRAINT FK_CCADCA6DDD842E46 FOREIGN KEY (position_id) REFERENCES position (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recompense_joueur ADD CONSTRAINT FK_F8461E474D714096 FOREIGN KEY (recompense_id) REFERENCES recompense (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recompense_joueur ADD CONSTRAINT FK_F8461E47A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur ADD effectif_id INT NOT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5180D113E FOREIGN KEY (effectif_id) REFERENCES effectif (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FD71A9C5180D113E ON joueur (effectif_id)');
        $this->addSql('ALTER TABLE recompense ADD trophee_id INT NOT NULL');
        $this->addSql('ALTER TABLE recompense ADD CONSTRAINT FK_1E9BC0DE753AAE2 FOREIGN KEY (trophee_id) REFERENCES trophee (id)');
        $this->addSql('CREATE INDEX IDX_1E9BC0DE753AAE2 ON recompense (trophee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur_position DROP FOREIGN KEY FK_CCADCA6DA9E2D76C');
        $this->addSql('ALTER TABLE joueur_position DROP FOREIGN KEY FK_CCADCA6DDD842E46');
        $this->addSql('ALTER TABLE recompense_joueur DROP FOREIGN KEY FK_F8461E474D714096');
        $this->addSql('ALTER TABLE recompense_joueur DROP FOREIGN KEY FK_F8461E47A9E2D76C');
        $this->addSql('DROP TABLE joueur_position');
        $this->addSql('DROP TABLE recompense_joueur');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5180D113E');
        $this->addSql('DROP INDEX UNIQ_FD71A9C5180D113E ON joueur');
        $this->addSql('ALTER TABLE joueur DROP effectif_id');
        $this->addSql('ALTER TABLE recompense DROP FOREIGN KEY FK_1E9BC0DE753AAE2');
        $this->addSql('DROP INDEX IDX_1E9BC0DE753AAE2 ON recompense');
        $this->addSql('ALTER TABLE recompense DROP trophee_id');
    }
}
