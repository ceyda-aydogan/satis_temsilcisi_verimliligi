-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Oca 2023, 15:58:16
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kds`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cinsiyetoran` ()   SELECT cinsiyet.cins_ad, ROUND(COUNT(satis_temsilcisi.cins_id)/(SELECT COUNT(satis_temsilcisi.cins_id) FROM satis_temsilcisi)*100,2) AS oran
FROM satis_temsilcisi INNER JOIN cinsiyet ON cinsiyet.cins_id=satis_temsilcisi.cins_id
GROUP BY cinsiyet.cins_ad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Satistemsilci` ()  NO SQL SELECT satis_temsilcisi.temsilci_id, satis_temsilcisi.temsilci_ad_soyad, satis_temsilcisi.dogum_tarihi, satis_temsilcisi.baslama_tarihi, calisma_suresi.sure_ad, cinsiyet.cins_ad, subeler.sube_ad, satis_temsilcisi.maas
FROM subeler INNER JOIN satis_temsilcisi ON subeler.sube_id=satis_temsilcisi.sube_id INNER JOIN calisma_suresi ON calisma_suresi.sure_id=satis_temsilcisi.sure_id INNER JOIN cinsiyet ON satis_temsilcisi.cins_id=cinsiyet.cins_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `kullanici_adi` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(250) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `kullanici_adi`, `sifre`) VALUES
(1, 'ceyda', '12345'),
(2, 'emre', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `calisma_suresi`
--

CREATE TABLE `calisma_suresi` (
  `sure_id` int(11) NOT NULL,
  `sure_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `calisma_suresi`
--

INSERT INTO `calisma_suresi` (`sure_id`, `sure_ad`) VALUES
(1, 'Yarı Zamanlı'),
(2, 'Tam Zamanlı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cinsiyet`
--

CREATE TABLE `cinsiyet` (
  `cins_id` int(11) NOT NULL,
  `cins_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `cinsiyet`
--

INSERT INTO `cinsiyet` (`cins_id`, `cins_ad`) VALUES
(1, 'Kadın'),
(2, 'Erkek');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `eski_maas`
--

CREATE TABLE `eski_maas` (
  `ad_soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `eski_maas` int(11) NOT NULL,
  `degistirme_tarihi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `eski_maas`
--

INSERT INTO `eski_maas` (`ad_soyad`, `eski_maas`, `degistirme_tarihi`) VALUES
('Buket Eren', 4500, '2023-01-04 03:18:09'),
('Buket Eren', 4500, '2023-01-04 03:18:32'),
('İsmail Tok', 8990, '2023-01-04 03:19:02'),
('İsmail Tok', 8990, '2023-01-04 03:19:36'),
('Yaşar Akın', 8500, '2023-01-04 03:20:06'),
('Yaşar Akın', 8500, '2023-01-04 03:20:25'),
('Okan Ay', 4425, '2023-01-04 03:20:43'),
('Okan Ay', 4425, '2023-01-04 03:20:59'),
('Berk Aslan', 9890, '2023-01-04 03:21:19'),
('Berk Aslan', 9890, '2023-01-04 03:21:39'),
('Gizem Işık', 3790, '2023-01-04 03:23:16'),
('Gizem Işık', 3790, '2023-01-04 03:23:33'),
('Özge Armağan', 9500, '2023-01-04 03:24:17'),
('Özge Armağan', 9500, '2023-01-04 03:25:32'),
('Beril Esen', 9750, '2023-01-04 03:25:50'),
('Beril Esen', 9750, '2023-01-04 03:26:09'),
('Pınar Keser', 3500, '2023-01-04 03:26:31'),
('Pınar Keser', 3500, '2023-01-04 03:26:46'),
('Serkan Tuna', 0, '2023-01-04 03:28:53'),
('Serkan Tuna', 0, '2023-01-04 03:29:28'),
('Dilara Aydın', 0, '2023-01-04 03:37:41'),
('Leyla Ermiş', 0, '2023-01-04 03:37:51'),
('Filiz Keskin', 0, '2023-01-04 03:38:14'),
('Ece Ertaş', 0, '2023-01-04 03:38:51'),
('Furkan Kaya', 0, '2023-01-04 03:39:02'),
('Dilek Poyraz', 0, '2023-01-04 03:39:15'),
('Ali Türkoğlu', 0, '2023-01-04 03:39:31'),
('Derya Dinçer', 0, '2023-01-04 03:39:46'),
('Resul Yıldız', 0, '2023-01-04 03:39:56'),
('Yunus Özbilen', 0, '2023-01-04 03:40:11'),
('Yunus Özbilen', 4500, '2023-01-04 03:40:26'),
('Dilara Kutlu', 0, '2023-01-04 03:40:40'),
('Filiz Keskin', 9500, '2023-01-04 03:41:54'),
('Filiz Keskin', 9500, '2023-01-04 03:42:11'),
('Leyla Ermiş', 8800, '2023-01-04 03:42:46'),
('Leyla Ermiş', 8800, '2023-01-04 03:43:02'),
('Dilara Aydın', 8750, '2023-01-04 03:43:20'),
('Dilara Aydın', 8750, '2023-01-04 03:43:40'),
('Ramazan Çınar', 0, '2023-01-04 03:44:56'),
('Sanem Paylan', 0, '2023-01-04 03:45:03'),
('Hasan Eroğlu', 0, '2023-01-04 03:45:33'),
('Berna Deniz Aksak', 0, '2023-01-04 03:45:41'),
('Ali Pamuk', 0, '2023-01-04 03:45:49'),
('Ömer Faruk Gezer', 0, '2023-01-04 03:45:57'),
('Hasan Eroğlu', 4300, '2023-01-04 03:50:21'),
('Hasan Eroğlu', 4300, '2023-01-04 03:50:46'),
('Berna Deniz Aksak', 4000, '2023-01-04 03:51:09'),
('Berna Deniz Aksak', 4000, '2023-01-04 03:51:29'),
('Ali Pamuk', 3675, '2023-01-04 03:51:47'),
('Ömer Faruk Gezer', 3700, '2023-01-04 03:52:16'),
('Ali Pamuk', 3675, '2023-01-04 03:53:05'),
('Ömer Faruk Gezer', 3700, '2023-01-04 03:53:29'),
('Buket Eren', 4500, '2023-01-04 04:08:03'),
('Buket Eren', 4600, '2023-01-04 04:25:30'),
('Buket Eren', 4500, '2023-01-04 04:25:38'),
('Buket Eren', 4500, '2023-01-04 04:27:32'),
('Buket Eren', 4500, '2023-01-04 04:27:47'),
('Buket Eren', 4000, '2023-01-04 04:29:51'),
('Buket Eren', 0, '2023-01-04 04:30:17'),
('Buket Eren', 0, '2023-01-04 04:30:37'),
('Buket Eren', 0, '2023-01-04 04:31:37'),
('Seda Yılmaz', 9000, '2023-01-04 04:33:41'),
('Buket Eren', 4500, '2023-01-04 04:33:59'),
('Buket Eren', 4600, '2023-01-04 04:36:48'),
('Buket Eren', 4600, '2023-01-04 04:51:47'),
('Buket Eren', 4500, '2023-01-04 04:56:00'),
('Seda Yılmaz', 9000, '2023-01-04 05:13:04'),
('Seda Yılmaz', 50000, '2023-01-04 05:13:04'),
('Seda Yılmaz', 0, '2023-01-04 05:14:22'),
('Seda Yılmaz', 0, '2023-01-04 05:14:22'),
('Seda Yılmaz', 30000, '2023-01-04 05:14:32'),
('Seda Yılmaz', 30000, '2023-01-04 05:14:32'),
('Buket Eren', 4500, '2023-01-04 05:25:31'),
('Buket Eren', 9000, '2023-01-04 05:25:41'),
('Buket Eren', 4500, '2023-01-04 05:47:18'),
('Buket Eren', 5000, '2023-01-04 05:47:31'),
('Buket Eren', 4500, '2023-01-04 07:28:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satis`
--

CREATE TABLE `satis` (
  `temsilci_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `islem_tarihi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `satis`
--

INSERT INTO `satis` (`temsilci_id`, `urun_id`, `islem_tarihi`) VALUES
(226, 34, '2022-12-09'),
(226, 38, '2022-12-09'),
(226, 18, '2022-12-11'),
(226, 12, '2022-12-15'),
(226, 20, '2022-12-12'),
(226, 49, '2022-12-15'),
(226, 2, '2022-12-16'),
(226, 26, '2022-12-17'),
(226, 35, '2022-12-25'),
(226, 34, '2022-12-27'),
(225, 19, '2022-09-06'),
(225, 44, '2022-09-08'),
(225, 46, '2022-09-09'),
(225, 49, '2022-09-09'),
(225, 33, '2022-09-11'),
(225, 36, '2022-09-20'),
(225, 16, '2022-09-20'),
(225, 19, '2022-10-20'),
(225, 18, '2022-11-03'),
(225, 32, '2022-11-15'),
(224, 29, '2022-05-11'),
(224, 22, '2022-05-16'),
(224, 33, '2022-05-16'),
(224, 35, '2022-06-11'),
(224, 41, '2022-07-01'),
(224, 32, '2022-07-03'),
(226, 29, '2022-12-16'),
(226, 38, '2022-12-18'),
(226, 33, '2022-12-19'),
(208, 50, '2022-12-30'),
(216, 19, '2022-12-11'),
(207, 3, '2023-01-23'),
(212, 34, '2023-01-01'),
(211, 13, '2023-01-01'),
(204, 48, '2023-01-02'),
(213, 41, '2022-12-21'),
(223, 33, '2022-12-07'),
(210, 32, '2022-12-04'),
(221, 48, '2022-12-02'),
(220, 35, '2022-12-09'),
(209, 19, '2022-12-02'),
(214, 50, '2022-12-05'),
(206, 1, '2022-12-11'),
(206, 39, '2022-12-10'),
(222, 34, '2023-01-15'),
(215, 2, '2022-12-11'),
(200, 45, '2022-12-12'),
(201, 29, '2022-12-10'),
(217, 5, '2022-12-12'),
(205, 34, '2022-12-13'),
(202, 20, '2022-12-13'),
(218, 33, '2023-01-01'),
(203, 43, '2023-01-01'),
(219, 5, '2023-01-01'),
(207, 2, '2023-01-01'),
(203, 49, '2023-01-01'),
(222, 5, '2023-01-01'),
(222, 20, '2023-01-01'),
(223, 15, '2023-01-01'),
(223, 21, '2023-01-01'),
(208, 43, '2023-01-01'),
(208, 19, '2023-01-01'),
(209, 34, '2023-01-01'),
(210, 19, '2023-01-01'),
(219, 20, '2023-01-01'),
(220, 48, '2023-01-01'),
(226, 22, '2023-01-01'),
(225, 3, '2023-01-01'),
(208, 18, '2023-01-01'),
(208, 47, '2023-01-01'),
(223, 11, '2023-01-01'),
(223, 1, '2023-01-01'),
(223, 49, '2023-01-01'),
(223, 27, '2023-01-01'),
(224, 43, '2023-01-01'),
(224, 50, '2023-01-01'),
(224, 41, '2023-01-01'),
(226, 18, '2023-01-01'),
(208, 18, '2023-01-01'),
(208, 38, '2023-01-01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satis_temsilcisi`
--

CREATE TABLE `satis_temsilcisi` (
  `temsilci_id` int(11) NOT NULL,
  `temsilci_ad_soyad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `dogum_tarihi` date NOT NULL,
  `baslama_tarihi` date NOT NULL,
  `sure_id` int(11) NOT NULL,
  `cins_id` int(11) NOT NULL,
  `sube_id` int(11) NOT NULL,
  `maas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `satis_temsilcisi`
--

INSERT INTO `satis_temsilcisi` (`temsilci_id`, `temsilci_ad_soyad`, `dogum_tarihi`, `baslama_tarihi`, `sure_id`, `cins_id`, `sube_id`, `maas`) VALUES
(200, 'Buket Eren', '2001-02-12', '2022-12-05', 1, 1, 1, 3456789),
(201, 'İsmail Tok', '1998-06-16', '2022-01-09', 2, 2, 3, 8990),
(202, 'Yaşar Akın', '1999-09-12', '2022-02-20', 2, 2, 6, 8500),
(203, 'Okan Ay', '2000-03-14', '2022-12-15', 1, 2, 2, 4425),
(204, 'Berk Aslan', '1999-07-25', '2021-07-13', 2, 2, 5, 9890),
(205, 'Gizem Işık', '2002-08-11', '2022-12-25', 1, 1, 4, 3790),
(206, 'Özge Armağan', '1997-10-22', '2021-03-15', 2, 1, 7, 9500),
(207, 'Beril Esen', '1998-12-04', '2020-12-26', 2, 1, 8, 9750),
(208, 'Pınar Keser', '2000-05-13', '2022-12-29', 1, 1, 3, 3500),
(209, 'Hasan Eroğlu', '2000-05-19', '2022-02-18', 1, 2, 1, 4300),
(210, 'Dilara Aydın', '1999-11-19', '2021-12-05', 2, 1, 8, 8750),
(211, 'Leyla Ermiş', '1999-07-16', '2021-12-03', 2, 1, 6, 8800),
(212, 'Berna Deniz Aksak', '2001-11-13', '2022-11-20', 1, 1, 1, 4000),
(213, 'Ali Pamuk', '2002-03-17', '2022-09-11', 1, 2, 1, 3675),
(214, 'Ömer Faruk Gezer', '2000-05-12', '2022-11-20', 1, 2, 2, 3700),
(215, 'Filiz Keskin', '1998-04-18', '2021-10-15', 2, 1, 6, 9500),
(216, 'Dilara Kutlu', '2000-07-11', '2022-04-20', 1, 1, 4, 4425),
(217, 'Yunus Özbilen', '1997-04-15', '2021-10-27', 1, 2, 2, 4450),
(218, 'Resul Yıldız', '1999-03-11', '2022-09-28', 1, 2, 5, 3890),
(219, 'Derya Dinçer', '2000-06-19', '2022-04-15', 1, 1, 5, 4400),
(220, 'Ali Türkoğlu', '2000-02-05', '2022-10-26', 1, 2, 4, 3690),
(221, 'Dilek Poyraz', '1999-06-22', '2021-10-03', 1, 1, 7, 4500),
(222, 'Furkan Kaya', '1998-09-01', '2022-10-18', 1, 2, 3, 3800),
(223, 'Ece Ertaş', '2001-04-26', '2022-12-25', 1, 1, 8, 3760),
(224, 'Serkan Tuna', '2002-08-22', '2022-05-04', 1, 2, 2, 4469),
(225, 'Ramazan Çınar', '2000-05-30', '2022-08-31', 1, 1, 7, 4380),
(226, 'Sanem Paylan', '1999-11-01', '2022-12-04', 1, 1, 2, 4250),
(239, 'Seda Yılmaz', '2023-01-03', '2023-01-02', 1, 1, 1, 34567);

--
-- Tetikleyiciler `satis_temsilcisi`
--
DELIMITER $$
CREATE TRIGGER `eski_maas` BEFORE UPDATE ON `satis_temsilcisi` FOR EACH ROW INSERT INTO eski_maas VALUES(old.temsilci_ad_soyad, old.maas, now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `subeler`
--

CREATE TABLE `subeler` (
  `sube_id` int(11) NOT NULL,
  `sube_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `subeler`
--

INSERT INTO `subeler` (`sube_id`, `sube_ad`) VALUES
(1, 'BUCA'),
(2, 'BORNOVA'),
(3, 'GAZİEMİR'),
(4, 'KARABAĞLAR'),
(5, 'KONAK'),
(6, 'KARŞIYAKA'),
(7, 'GÜZELBAHÇE'),
(8, 'URLA');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_ad`, `fiyat`) VALUES
(1, 'Elbise', '120.00'),
(2, 'Elbise', '169.99'),
(3, 'Elbise', '236.00'),
(4, 'Tişört', '47.00'),
(5, 'Tişört', '52.00'),
(6, 'Tişört', '75.00'),
(7, 'Tişört', '49.00'),
(8, 'Tişört', '59.00'),
(9, 'Tişört', '55.00'),
(10, 'Kazak', '89.00'),
(11, 'Kazak', '110.00'),
(12, 'Kazak', '125.00'),
(13, 'Kazak', '135.00'),
(14, 'Gömlek', '199.00'),
(15, 'Gömlek', '233.00'),
(16, 'Gömlek', '245.00'),
(17, 'Gömlek', '256.00'),
(18, 'Ceket', '480.00'),
(19, 'Ceket', '510.00'),
(20, 'Ceket', '545.00'),
(21, 'Pantolon', '350.00'),
(22, 'Pantolon', '249.00'),
(23, 'Pantolon', '269.00'),
(24, 'Pantolon', '475.00'),
(25, 'Pantolon', '299.00'),
(26, 'Pantolon', '315.00'),
(27, 'Pantolon', '289.00'),
(28, 'Mont', '799.00'),
(29, 'Mont', '649.00'),
(30, 'Mont', '550.00'),
(31, 'Mont', '725.00'),
(32, 'Ayakkabı', '175.00'),
(33, 'Ayakkabı', '199.00'),
(34, 'Ayakkabı', '260.90'),
(35, 'Ayakkabı', '275.00'),
(36, 'Ayakkabı', '299.00'),
(37, 'Çanta', '95.00'),
(38, 'Çanta', '70.00'),
(39, 'Çanta', '110.00'),
(40, 'Pijama Takımı', '175.00'),
(41, 'Pijama Takımı', '189.00'),
(42, 'Pijama Takımı', '200.00'),
(43, 'Eşofman', '250.00'),
(44, 'Eşofman', '245.00'),
(45, 'Eşofman', '267.00'),
(46, 'Eşofman', '278.00'),
(47, 'Aksesuar', '25.00'),
(48, 'Aksesuar', '29.99'),
(49, 'Aksesuar', '32.00'),
(50, 'Aksesuar', '45.00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `calisma_suresi`
--
ALTER TABLE `calisma_suresi`
  ADD PRIMARY KEY (`sure_id`);

--
-- Tablo için indeksler `cinsiyet`
--
ALTER TABLE `cinsiyet`
  ADD PRIMARY KEY (`cins_id`);

--
-- Tablo için indeksler `satis`
--
ALTER TABLE `satis`
  ADD KEY `temsilci_id` (`temsilci_id`),
  ADD KEY `urun_id` (`urun_id`);

--
-- Tablo için indeksler `satis_temsilcisi`
--
ALTER TABLE `satis_temsilcisi`
  ADD PRIMARY KEY (`temsilci_id`),
  ADD KEY `cins_id` (`cins_id`),
  ADD KEY `sube_id` (`sube_id`),
  ADD KEY `sure_id` (`sure_id`);

--
-- Tablo için indeksler `subeler`
--
ALTER TABLE `subeler`
  ADD PRIMARY KEY (`sube_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `calisma_suresi`
--
ALTER TABLE `calisma_suresi`
  MODIFY `sure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `cinsiyet`
--
ALTER TABLE `cinsiyet`
  MODIFY `cins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `satis_temsilcisi`
--
ALTER TABLE `satis_temsilcisi`
  MODIFY `temsilci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- Tablo için AUTO_INCREMENT değeri `subeler`
--
ALTER TABLE `subeler`
  MODIFY `sube_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `satis`
--
ALTER TABLE `satis`
  ADD CONSTRAINT `satis_ibfk_1` FOREIGN KEY (`temsilci_id`) REFERENCES `satis_temsilcisi` (`temsilci_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satis_ibfk_2` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`urun_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `satis_temsilcisi`
--
ALTER TABLE `satis_temsilcisi`
  ADD CONSTRAINT `satis_temsilcisi_ibfk_2` FOREIGN KEY (`cins_id`) REFERENCES `cinsiyet` (`cins_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satis_temsilcisi_ibfk_4` FOREIGN KEY (`sube_id`) REFERENCES `subeler` (`sube_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satis_temsilcisi_ibfk_5` FOREIGN KEY (`sure_id`) REFERENCES `calisma_suresi` (`sure_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
