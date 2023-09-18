-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 18 Eyl 2023, 09:20:04
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `personel_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_tbl`
--

DROP TABLE IF EXISTS `kullanici_tbl`;
CREATE TABLE IF NOT EXISTS `kullanici_tbl` (
  `kullanici_id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL,
  `yetki` bit(1) DEFAULT NULL,
  PRIMARY KEY (`kullanici_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `kullanici_tbl`
--

INSERT INTO `kullanici_tbl` (`kullanici_id`, `ad`, `soyad`, `mail`, `sifre`, `yetki`) VALUES
(1, 'yetkisiz', 'kullanici', 'yetkisiz@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', b'0'),
(2, 'alperen ', 'gökçek', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', b'1'),
(10, 'alperen', ' gökçek', 'yetkisiz2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', b'0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel_tbl`
--

DROP TABLE IF EXISTS `personel_tbl`;
CREATE TABLE IF NOT EXISTS `personel_tbl` (
  `personel_id` int NOT NULL AUTO_INCREMENT,
  `personel_tc` varchar(11) NOT NULL,
  `personel_ad` varchar(55) NOT NULL,
  `personel_soyad` varchar(55) NOT NULL,
  `personel_dogum` varchar(10) NOT NULL,
  `personel_cinsiyet` varchar(15) NOT NULL,
  `personel_medeni` varchar(10) NOT NULL,
  `personel_gorev` varchar(20) NOT NULL,
  `personel_adres` text NOT NULL,
  `personel_telefon` varchar(15) NOT NULL,
  `personel_egitim` varchar(20) NOT NULL,
  `personel_mail` varchar(50) NOT NULL,
  `personel_resim` varchar(255) NOT NULL,
  PRIMARY KEY (`personel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=609 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `personel_tbl`
--

INSERT INTO `personel_tbl` (`personel_id`, `personel_tc`, `personel_ad`, `personel_soyad`, `personel_dogum`, `personel_cinsiyet`, `personel_medeni`, `personel_gorev`, `personel_adres`, `personel_telefon`, `personel_egitim`, `personel_mail`, `personel_resim`) VALUES
(608, '22222', 'adem', 'gökçek', '', 'kadın', 'bekar', '', '', '', 'İlkokul', '', 'personel/personel_adem_gökçek.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
