<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191009191621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE resposta (id INT AUTO_INCREMENT NOT NULL, caso_id INT DEFAULT NULL, descricao LONGTEXT NOT NULL, pontuacao DOUBLE PRECISION NOT NULL, INDEX IDX_62A96906A0AD3491 (caso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, candidato_id INT DEFAULT NULL, descricao LONGTEXT NOT NULL, INDEX IDX_D2294458FE0067E5 (candidato_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidato (id INT AUTO_INCREMENT NOT NULL, endereco_id INT DEFAULT NULL, talentos_id INT DEFAULT NULL, auto_descricao LONGTEXT DEFAULT NULL, pontuacao DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2867675A1BB76823 (endereco_id), UNIQUE INDEX UNIQ_2867675A89D7A81F (talentos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recrutador (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE talentos (id INT AUTO_INCREMENT NOT NULL, comunicador INT NOT NULL, executor INT NOT NULL, analista INT NOT NULL, planejador INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contratador (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE endereco (id INT AUTO_INCREMENT NOT NULL, cep INT DEFAULT NULL, logradouro VARCHAR(255) DEFAULT NULL, cidade VARCHAR(255) DEFAULT NULL, estado VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caso (id INT AUTO_INCREMENT NOT NULL, feedback_id INT DEFAULT NULL, area_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, descricao LONGTEXT NOT NULL, pergunta VARCHAR(255) NOT NULL, imagens VARCHAR(255) DEFAULT NULL, videos VARCHAR(255) DEFAULT NULL, arquivos VARCHAR(255) DEFAULT NULL, data_de_criacao DATETIME NOT NULL, UNIQUE INDEX UNIQ_98DD701AD249A887 (feedback_id), INDEX IDX_98DD701ABD0F409C (area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestor (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, area_id INT DEFAULT NULL, candidato_id INT DEFAULT NULL, contratador_id INT DEFAULT NULL, recrutador_id INT DEFAULT NULL, gestor_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, sobrenome VARCHAR(255) NOT NULL, cpf VARCHAR(255) NOT NULL, data_de_nascimento DATETIME NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(255) NOT NULL, password VARCHAR(100) NOT NULL, imagem VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), INDEX IDX_2265B05DBD0F409C (area_id), UNIQUE INDEX UNIQ_2265B05DFE0067E5 (candidato_id), UNIQUE INDEX UNIQ_2265B05DEB5283A5 (contratador_id), UNIQUE INDEX UNIQ_2265B05D3179B68D (recrutador_id), UNIQUE INDEX UNIQ_2265B05D486747D4 (gestor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, icone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A96906A0AD3491 FOREIGN KEY (caso_id) REFERENCES caso (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458FE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id)');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675A1BB76823 FOREIGN KEY (endereco_id) REFERENCES endereco (id)');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675A89D7A81F FOREIGN KEY (talentos_id) REFERENCES talentos (id)');
        $this->addSql('ALTER TABLE caso ADD CONSTRAINT FK_98DD701AD249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE caso ADD CONSTRAINT FK_98DD701ABD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DBD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DFE0067E5 FOREIGN KEY (candidato_id) REFERENCES candidato (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DEB5283A5 FOREIGN KEY (contratador_id) REFERENCES contratador (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D3179B68D FOREIGN KEY (recrutador_id) REFERENCES recrutador (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D486747D4 FOREIGN KEY (gestor_id) REFERENCES gestor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE caso DROP FOREIGN KEY FK_98DD701AD249A887');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458FE0067E5');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DFE0067E5');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D3179B68D');
        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675A89D7A81F');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DEB5283A5');
        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675A1BB76823');
        $this->addSql('ALTER TABLE resposta DROP FOREIGN KEY FK_62A96906A0AD3491');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D486747D4');
        $this->addSql('ALTER TABLE caso DROP FOREIGN KEY FK_98DD701ABD0F409C');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DBD0F409C');
        $this->addSql('DROP TABLE resposta');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE candidato');
        $this->addSql('DROP TABLE recrutador');
        $this->addSql('DROP TABLE talentos');
        $this->addSql('DROP TABLE contratador');
        $this->addSql('DROP TABLE endereco');
        $this->addSql('DROP TABLE caso');
        $this->addSql('DROP TABLE gestor');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE area');
    }
}
