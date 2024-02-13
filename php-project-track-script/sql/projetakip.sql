-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Ara 2023, 11:14:07
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `projetakip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) DEFAULT NULL,
  `site_aciklama` varchar(300) DEFAULT NULL,
  `site_sahibi` varchar(100) DEFAULT NULL,
  `mail_onayi` int(11) DEFAULT NULL,
  `duyuru_onayi` int(11) DEFAULT NULL,
  `site_logo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `site_sahibi`, `mail_onayi`, `duyuru_onayi`, `site_logo`) VALUES
(1, 'İş Takip Scripti', 'İş Takip Scripti', 'Sinan &Ouml;z&ccedil;elik', 0, 0, '970552letter-s.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(5) NOT NULL,
  `kul_isim` varchar(200) DEFAULT NULL,
  `kul_mail` varchar(250) DEFAULT NULL,
  `kul_sifre` varchar(250) DEFAULT NULL,
  `kul_telefon` varchar(50) DEFAULT NULL,
  `kul_unvan` varchar(250) DEFAULT NULL,
  `kul_yetki` int(11) DEFAULT NULL,
  `kul_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) DEFAULT NULL,
  `session_mail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_telefon`, `kul_unvan`, `kul_yetki`, `kul_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Sinan Özçelik', 'sinanozcelik@yaani.com', '202cb962ac59075b964b07152d234b70', '05555555555', 'Yazılımcı | Admin', 1, '3269579442letter-s.png', '::1', '1c71d51e7d4a7ef52612ec76efd655d4');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proje`
--

CREATE TABLE `proje` (
  `proje_id` int(5) NOT NULL,
  `proje_baslik` varchar(250) DEFAULT NULL,
  `proje_detay` text DEFAULT NULL,
  `proje_teslim_tarihi` varchar(100) DEFAULT NULL,
  `proje_baslama_tarihi` date DEFAULT NULL,
  `proje_durum` int(1) NOT NULL DEFAULT 0,
  `proje_aciliyet` int(1) NOT NULL DEFAULT 0,
  `dosya_yolu` varchar(500) DEFAULT NULL,
  `yuzde` int(11) NOT NULL DEFAULT 0,
  `eklenme_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `proje`
--

INSERT INTO `proje` (`proje_id`, `proje_baslik`, `proje_detay`, `proje_teslim_tarihi`, `proje_baslama_tarihi`, `proje_durum`, `proje_aciliyet`, `dosya_yolu`, `yuzde`, `eklenme_tarihi`) VALUES
(26, 'Web Site Projesi', '<p>Proje açıklama.</p>', '2023-04-01', '2023-01-01', 0, 1, NULL, 0, '2023-12-06 13:05:30'),
(27, 'Script Yapımı', '<p>Proje açıklama.</p>', '2023-12-30', '2023-12-01', 0, 0, NULL, 50, '2023-12-06 13:06:08'),
(28, 'Site Yedekleme', '<p>Biten proje.</p>', '2023-05-10', '2023-05-05', 2, 1, NULL, 100, '2023-12-06 13:06:53');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `sip_id` int(5) NOT NULL,
  `musteri_isim` varchar(250) DEFAULT NULL,
  `musteri_mail` varchar(250) DEFAULT NULL,
  `musteri_telefon` varchar(50) DEFAULT NULL,
  `sip_baslik` varchar(300) DEFAULT NULL,
  `sip_teslim_tarihi` varchar(100) DEFAULT NULL,
  `sip_aciliyet` int(1) NOT NULL DEFAULT 0,
  `sip_durum` int(1) NOT NULL DEFAULT 0,
  `sip_detay` mediumtext DEFAULT NULL,
  `sip_ucret` varchar(100) DEFAULT NULL,
  `sip_baslama_tarih` date DEFAULT NULL,
  `dosya_yolu` varchar(500) DEFAULT NULL,
  `yuzde` int(11) NOT NULL DEFAULT 0,
  `eklenme_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`sip_id`, `musteri_isim`, `musteri_mail`, `musteri_telefon`, `sip_baslik`, `sip_teslim_tarihi`, `sip_aciliyet`, `sip_durum`, `sip_detay`, `sip_ucret`, `sip_baslama_tarih`, `dosya_yolu`, `yuzde`, `eklenme_tarihi`) VALUES
(22, 'Sinan Özçelik', 'sinanozcelik@yaani.com', '05555555555', 'Web Sitesi Yapımı', '2023-12-30', 0, 1, '<p>Devam eden proje.</p>', '40000', '2023-01-01', NULL, 30, '2023-12-06 13:08:17');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`),
  ADD UNIQUE KEY `kul_mail` (`kul_mail`);

--
-- Tablo için indeksler `proje`
--
ALTER TABLE `proje`
  ADD PRIMARY KEY (`proje_id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`sip_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `proje`
--
ALTER TABLE `proje`
  MODIFY `proje_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `sip_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
