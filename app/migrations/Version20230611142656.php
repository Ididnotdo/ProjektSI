<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230611142656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, UNIQUE INDEX uq_categories_title (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, INDEX IDX_5058659712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_5058659712469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE wizyta DROP FOREIGN KEY wizyta_ibfk_1');
        $this->addSql('DROP TABLE parametry_gracza');
        $this->addSql('DROP TABLE kolokwium_ksiazki');
        $this->addSql('DROP TABLE lekarz');
        $this->addSql('DROP TABLE kolokwium_czytelnicy');
        $this->addSql('DROP TABLE mecze');
        $this->addSql('DROP TABLE pacjent');
        $this->addSql('DROP TABLE gracze');
        $this->addSql('DROP TABLE druzyny');
        $this->addSql('DROP TABLE wizyta');
        $this->addSql('DROP TABLE Produkty_2');
        $this->addSql('DROP TABLE zwierzak');
        $this->addSql('DROP TABLE Produkty');
        $this->addSql('DROP TABLE zwierzak_2');
        $this->addSql('DROP TABLE Kupujacy');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parametry_gracza (gracz_id INT NOT NULL, wzrost INT NOT NULL, waga INT NOT NULL, PRIMARY KEY(gracz_id)) DEFAULT CHARACTER SET latin2 COLLATE `latin2_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kolokwium_ksiazki (id_ksiazki INT AUTO_INCREMENT NOT NULL, tytul VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, imie_autora VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, nazwisko_autora VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, wydawnictwo VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, PRIMARY KEY(id_ksiazki)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lekarz (id_lekarza INT AUTO_INCREMENT NOT NULL, imie VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, nazwisko VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, specjalizacja VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, PRIMARY KEY(id_lekarza)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE kolokwium_czytelnicy (id_czytelnika INT AUTO_INCREMENT NOT NULL, imie_czytelnika VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, nazwisko_czytelnika VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, nr_telefonu VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, PRIMARY KEY(id_czytelnika)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mecze (mecz_id INT NOT NULL, data DATETIME NOT NULL, gospodarze_id INT NOT NULL, goscie_id INT NOT NULL, PRIMARY KEY(mecz_id)) DEFAULT CHARACTER SET latin2 COLLATE `latin2_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pacjent (id_pacjenta INT AUTO_INCREMENT NOT NULL, PESEL VARCHAR(11) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, imie VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, nazwisko VARCHAR(30) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, data_urodzenia DATE DEFAULT NULL, telefon INT DEFAULT NULL, płeć CHAR(1) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, UNIQUE INDEX PESEL (PESEL), PRIMARY KEY(id_pacjenta)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gracze (gracz_id INT AUTO_INCREMENT NOT NULL, imie VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, nazwisko VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, druzyna_id INT DEFAULT NULL, numer INT NOT NULL, PRIMARY KEY(gracz_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE druzyny (druzyna_id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(20) CHARACTER SET latin2 NOT NULL COLLATE `latin2_general_ci`, PRIMARY KEY(druzyna_id)) DEFAULT CHARACTER SET latin2 COLLATE `latin2_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE wizyta (id_wizyty INT AUTO_INCREMENT NOT NULL, id_lekarza INT DEFAULT NULL, id_pacjenta INT DEFAULT NULL, data_wizyty DATE DEFAULT NULL, INDEX id_lekarza (id_lekarza), INDEX id_pacjenta (id_pacjenta), PRIMARY KEY(id_wizyty)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Produkty_2 (idprodukt INT AUTO_INCREMENT NOT NULL, produkt VARCHAR(45) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, producent VARCHAR(45) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, PRIMARY KEY(idprodukt)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE zwierzak (imie VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, wlasciciel VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, gatunek VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, plec CHAR(1) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, data_urodzenia DATE NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Produkty (idprodukt INT AUTO_INCREMENT NOT NULL, produkt VARCHAR(45) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, producent VARCHAR(45) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, PRIMARY KEY(idprodukt)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE zwierzak_2 (imie VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, wlasciciel VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, gatunek VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, plec CHAR(1) CHARACTER SET utf8 NOT NULL COLLATE `utf8_polish_ci`, data_urodzenia DATE NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE Kupujacy (idkupujacy INT AUTO_INCREMENT NOT NULL, idprodukt INT DEFAULT NULL, imie VARCHAR(45) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_polish_ci`, ilosc INT DEFAULT NULL, PRIMARY KEY(idkupujacy)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_polish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE wizyta ADD CONSTRAINT wizyta_ibfk_1 FOREIGN KEY (id_lekarza) REFERENCES lekarz (id_lekarza) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_5058659712469DE2');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
