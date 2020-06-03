<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200603153055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces ADD users_id INT NOT NULL, ADD categorie_id INT NOT NULL, ADD etat_id INT NOT NULL, ADD region_id INT NOT NULL, ADD quartier_id INT NOT NULL, ADD zone_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6FDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
        $this->addSql('ALTER TABLE annonces ADD CONSTRAINT FK_CB988C6F9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CB988C6F989D9B62 ON annonces (slug)');
        $this->addSql('CREATE INDEX IDX_CB988C6F67B3B43D ON annonces (users_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6FBCF5E72D ON annonces (categorie_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6FD5E86FF ON annonces (etat_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F98260155 ON annonces (region_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6FDF1E57AB ON annonces (quartier_id)');
        $this->addSql('CREATE INDEX IDX_CB988C6F9F2C3FAB ON annonces (zone_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_497DD634989D9B62 ON categorie (slug)');
        $this->addSql('ALTER TABLE images ADD annonces_id INT NOT NULL, CHANGE image_principale image_principale TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonces (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A4C2885D7 ON images (annonces_id)');
        $this->addSql('ALTER TABLE rubrique CHANGE nom nom VARCHAR(70) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F67B3B43D');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FBCF5E72D');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FD5E86FF');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F98260155');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6FDF1E57AB');
        $this->addSql('ALTER TABLE annonces DROP FOREIGN KEY FK_CB988C6F9F2C3FAB');
        $this->addSql('DROP INDEX UNIQ_CB988C6F989D9B62 ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6F67B3B43D ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6FBCF5E72D ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6FD5E86FF ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6F98260155 ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6FDF1E57AB ON annonces');
        $this->addSql('DROP INDEX IDX_CB988C6F9F2C3FAB ON annonces');
        $this->addSql('ALTER TABLE annonces DROP users_id, DROP categorie_id, DROP etat_id, DROP region_id, DROP quartier_id, DROP zone_id');
        $this->addSql('DROP INDEX UNIQ_497DD634989D9B62 ON categorie');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4C2885D7');
        $this->addSql('DROP INDEX IDX_E01FBE6A4C2885D7 ON images');
        $this->addSql('ALTER TABLE images DROP annonces_id, CHANGE image_principale image_principale VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE rubrique CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
