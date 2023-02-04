-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Oca 2023, 19:00:32
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `e_ticaret_proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `adresler`
--

CREATE TABLE `adresler` (
  `id` int(10) UNSIGNED NOT NULL,
  `UyeId` int(10) UNSIGNED NOT NULL,
  `AdresBaslik` varchar(50) NOT NULL,
  `adiSoyadi` varchar(100) NOT NULL,
  `Adres` varchar(255) NOT NULL,
  `Ilce` varchar(100) NOT NULL,
  `Sehir` varchar(100) NOT NULL,
  `TelefonNumarasi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `SiteAdi` varchar(50) NOT NULL,
  `SiteTitle` varchar(60) NOT NULL,
  `SiteDecscription` varchar(150) NOT NULL,
  `SiteKeywords` varchar(255) NOT NULL,
  `SiteCopyrightMetni` varchar(255) NOT NULL,
  `SiteLogosu` varchar(30) NOT NULL,
  `SiteEmailHostAdresi` varchar(255) NOT NULL,
  `siteLinki` varchar(255) NOT NULL,
  `SiteEmailAdresi` varchar(50) NOT NULL,
  `SiteEmailSifresi` varchar(50) NOT NULL,
  `FacebookLink` varchar(255) NOT NULL,
  `TwitterLink` varchar(255) NOT NULL,
  `LinkedinLink` varchar(255) NOT NULL,
  `InstagramLink` varchar(255) NOT NULL,
  `PinterestLink` varchar(255) NOT NULL,
  `YouTubeLink` varchar(255) NOT NULL,
  `DolarKuru` double UNSIGNED NOT NULL,
  `EuroKuru` double UNSIGNED NOT NULL,
  `ucretsizKargoBaraji` double UNSIGNED NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `StoreKey` varchar(100) NOT NULL,
  `ApiKullanicisi` varchar(100) NOT NULL,
  `ApiSifresi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `SiteAdi`, `SiteTitle`, `SiteDecscription`, `SiteKeywords`, `SiteCopyrightMetni`, `SiteLogosu`, `SiteEmailHostAdresi`, `siteLinki`, `SiteEmailAdresi`, `SiteEmailSifresi`, `FacebookLink`, `TwitterLink`, `LinkedinLink`, `InstagramLink`, `PinterestLink`, `YouTubeLink`, `DolarKuru`, `EuroKuru`, `ucretsizKargoBaraji`, `ClientID`, `StoreKey`, `ApiKullanicisi`, `ApiSifresi`) VALUES
(1, 'eAyakkabiStore', 'BTK eğitim örnek basic | e ticaret sitesi', 'Uygun fiyat ödeme koşulları ile eAyakkabiStore alışveriş için tıklayınız.', 'e ticaret, satış, kadın giyim, erkek giyim', 'Copyright 2022 eStore tüm hakları saklıdır.', './resimler/Logo.png', '', '', 'kisacasumderler@yandex.com', 'smy7699', 'https://www.facebook.com/kisacasumderler', 'https://twitter.com/kisacasumderler', 'https://www.linkedin.com/kisacasumderler', 'https://www.instagram.com/kisacasumderler', 'https://tr.pinterest.com/kisacasumderler', 'https://www.youtube.com/kisacasumderler', 18, 20, 250, '00000000', '11111111', '3DKullanicim', '3DSifrem');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bankahesaplarimiz`
--

CREATE TABLE `bankahesaplarimiz` (
  `id` int(10) UNSIGNED NOT NULL,
  `BankLogo` varchar(255) NOT NULL,
  `bankaAdi` varchar(100) NOT NULL,
  `KonumSehir` varchar(100) NOT NULL,
  `KonumUlke` varchar(100) NOT NULL,
  `SubeAdi` varchar(100) NOT NULL,
  `SubeKodu` varchar(100) NOT NULL,
  `ParaBirimi` varchar(100) NOT NULL,
  `HesapSahibi` varchar(255) NOT NULL,
  `HesapNumarasi` varchar(100) NOT NULL,
  `IbanNumarasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bannerlar`
--

CREATE TABLE `bannerlar` (
  `id` int(10) UNSIGNED NOT NULL,
  `bannerAlani` varchar(100) NOT NULL,
  `BannerResmi` varchar(30) NOT NULL,
  `GosterimSayisi` int(10) UNSIGNED NOT NULL,
  `bannerAdi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favoriler`
--

CREATE TABLE `favoriler` (
  `id` int(10) UNSIGNED NOT NULL,
  `urunId` int(10) UNSIGNED NOT NULL,
  `uyeId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `havalebildirimleri`
--

CREATE TABLE `havalebildirimleri` (
  `id` int(10) UNSIGNED NOT NULL,
  `bankaId` int(10) UNSIGNED NOT NULL,
  `adiSoyadi` varchar(100) NOT NULL,
  `emailAdresi` varchar(255) NOT NULL,
  `telefonNumarasi` varchar(11) NOT NULL,
  `aciklama` text NOT NULL,
  `islemTarihi` int(10) UNSIGNED NOT NULL,
  `durum` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kargofirmalari`
--

CREATE TABLE `kargofirmalari` (
  `id` int(10) UNSIGNED NOT NULL,
  `KargoFirmaLogo` varchar(50) NOT NULL,
  `KargoFirmaAdi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuler`
--

CREATE TABLE `menuler` (
  `id` int(10) UNSIGNED NOT NULL,
  `urunTuru` varchar(100) NOT NULL,
  `MenuAdi` varchar(50) NOT NULL,
  `urunSayisi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(10) UNSIGNED NOT NULL,
  `sepetNumarasi` int(10) UNSIGNED NOT NULL,
  `UyeId` int(10) UNSIGNED NOT NULL,
  `urunId` int(10) UNSIGNED NOT NULL,
  `VaryantId` int(10) UNSIGNED NOT NULL,
  `AdresId` int(10) NOT NULL,
  `urunAdedi` tinyint(3) UNSIGNED NOT NULL,
  `KargoFirmaId` tinyint(2) UNSIGNED NOT NULL,
  `varyantSecimi` varchar(100) NOT NULL,
  `odemeSecimi` varchar(50) NOT NULL,
  `TaksitSecimi` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(10) UNSIGNED NOT NULL,
  `siparisNumarasi` int(10) UNSIGNED NOT NULL,
  `urunId` int(10) UNSIGNED NOT NULL,
  `urunTuru` varchar(50) NOT NULL,
  `UyeId` int(10) UNSIGNED NOT NULL,
  `urunFiyati` double UNSIGNED NOT NULL,
  `urunAdi` varchar(255) NOT NULL,
  `kdvOrani` int(2) UNSIGNED NOT NULL,
  `urunAdedi` int(3) UNSIGNED NOT NULL,
  `topamUrunFiyati` double UNSIGNED NOT NULL,
  `kargoFirmasiSecimi` varchar(100) NOT NULL,
  `kargoUcreti` double UNSIGNED NOT NULL,
  `urunResmiBir` varchar(30) NOT NULL,
  `varyantBasligi` varchar(100) NOT NULL,
  `varyantSecimi` varchar(100) NOT NULL,
  `AdresAdiSoyadi` varchar(100) NOT NULL,
  `AdresDetay` varchar(255) NOT NULL,
  `AdresTelefon` varchar(11) NOT NULL,
  `odemeSecimi` varchar(25) NOT NULL,
  `TaksitSecimi` int(2) UNSIGNED NOT NULL,
  `siparisTarihi` int(10) UNSIGNED NOT NULL,
  `OnayDurumu` int(11) NOT NULL,
  `kargoDurumu` tinyint(3) UNSIGNED NOT NULL,
  `kargoGonderiKodu` varchar(30) NOT NULL,
  `siparisIdAdresi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorular`
--

CREATE TABLE `sorular` (
  `id` int(10) UNSIGNED NOT NULL,
  `soru` varchar(255) NOT NULL,
  `cevap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sozlesmelervemetinler`
--

CREATE TABLE `sozlesmelervemetinler` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `hakkimizda` text NOT NULL,
  `uyelikSozlesmesi` text NOT NULL,
  `kullanimKosullari` text NOT NULL,
  `gizlilikSozlesmesi` text NOT NULL,
  `mesafeliSatisSozlesmesi` text NOT NULL,
  `teslimat` text NOT NULL,
  `iptalIadeDegisim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sozlesmelervemetinler`
--

INSERT INTO `sozlesmelervemetinler` (`id`, `hakkimizda`, `uyelikSozlesmesi`, `kullanimKosullari`, `gizlilikSozlesmesi`, `mesafeliSatisSozlesmesi`, `teslimat`, `iptalIadeDegisim`) VALUES
(1, 'Hakkımızda \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.', 'üyelik sözleşmesi ve koşulları \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.', 'Kullanım Koşulları \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur at lorem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.', 'Gizlilik Sözleşmesi \r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, puvel, luctus ultrices ligula.', 'Mesafeli Satış Sözleşmesi \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla era diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.', 'Teslimat \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla eraem eros. Nulla ornare venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.', 'İptal iade ve Değişim Koşulları \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla dapibus congue. Curabitur accumsan leo non ullamcorper vehicula. Mauris vel semper turpis. Nulla nec interdum mi, vitae hendrerit nibh. Aliquam placerat nisl magna, sed ultrices nunc placerat eu. Aliquam ut viverra massa, in pulvinar mauris. Praesent id eros ut erat scelerisque pharetra. Maecenas mollis volutpat diam, at iaculis sapien pretium sed. Maecenas blandit posuere nisl, pellentesque egestas orci tempor et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam et faucibus nibh. In tempor nisl convallis lectus tempor, vitae malesuada ipsum congue. Nullam maximus augue sit amet ante ornare, at ullamcorper velit cursus. Nunc ornare consequat mauris id lacinia. Etiam fermentum ac nibh et hendrerit. Pellentesque ultricies laoreet mauris sed dapibus.\r\n\r\nCras non lectus in libero varius fringilla in sit amet elit. Donec eget efficitur mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut fringilla, neque vel volutpat pretium, purus neque convallis felis, sit amet dignissim metus nunc non sapien. Ut fringilla erat eu augue porta molestie. Donec semper, augue ac porttitor imperdiet, purus lacus eleifend libero, ut mattis enim libero quis nisi. Curabitur a venenatis velit eu maximus. Ut a nunc vulputate, aliquet ipsum nec, laoreet nisi. Phasellus interdum risus sed risus efficitur cursus. Sed commodo magna ex. Donec vitae rhoncus nibh. Vivamus vulputate dignissim varius. Nulla diam nisl, volutpat tincidunt nibh vel, luctus ultrices ligula.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(10) UNSIGNED NOT NULL,
  `urunAdi` varchar(255) NOT NULL,
  `urunFiyati` double UNSIGNED NOT NULL,
  `paraBirimi` char(3) NOT NULL,
  `KdvOrani` int(2) UNSIGNED NOT NULL,
  `urunAciklamasi` text NOT NULL,
  `urunResmiBir` varchar(30) NOT NULL,
  `urunResmiIki` varchar(30) NOT NULL,
  `UrunResmiUc` varchar(30) NOT NULL,
  `UrunResmiDort` varchar(30) NOT NULL,
  `Durumu` tinyint(1) UNSIGNED NOT NULL,
  `ToplamSatisSayisi` int(10) UNSIGNED NOT NULL,
  `yorumSayisi` tinyint(1) UNSIGNED NOT NULL,
  `toplamyorumpuani` int(10) UNSIGNED NOT NULL,
  `goruntulenmeSayisi` int(10) UNSIGNED NOT NULL,
  `varyantBasligi` varchar(100) NOT NULL,
  `urunTuru` varchar(100) NOT NULL,
  `MenuId` int(10) UNSIGNED NOT NULL,
  `kargoUcreti` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunvaryantlari`
--

CREATE TABLE `urunvaryantlari` (
  `id` int(10) UNSIGNED NOT NULL,
  `urunId` int(10) UNSIGNED NOT NULL,
  `varyantAdi` varchar(100) NOT NULL,
  `StokAdedi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(10) UNSIGNED NOT NULL,
  `emailAdres` varchar(255) NOT NULL,
  `sifre` varchar(100) NOT NULL,
  `isimSoyisim` varchar(100) NOT NULL,
  `telefonNumarasi` varchar(11) NOT NULL,
  `cinsiyet` varchar(5) NOT NULL,
  `durumu` tinyint(1) NOT NULL,
  `silinmeDurumu` tinyint(3) UNSIGNED NOT NULL,
  `kayitTarihi` int(10) NOT NULL,
  `kayitIpAdresi` varchar(20) NOT NULL,
  `AktivasyonKodu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

CREATE TABLE `yoneticiler` (
  `id` int(10) UNSIGNED NOT NULL,
  `kullaniciAdi` varchar(100) NOT NULL,
  `emailAdres` varchar(255) NOT NULL,
  `sifre` varchar(100) NOT NULL,
  `isimSoyisim` varchar(255) NOT NULL,
  `telefonNumarasi` varchar(11) NOT NULL,
  `yoneticiDurumu` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`id`, `kullaniciAdi`, `emailAdres`, `sifre`, `isimSoyisim`, `telefonNumarasi`, `yoneticiDurumu`) VALUES
(1, 'kisacasumderler', 'sumeyya@utku.com.tr', '8ed9978d343fe2d9dee42d876e661ff2', 'Sümeyya Utku', '0', 1),
(3, 'kullanici2', 'deneme@utku.com.tr', '827ccb0eea8a706c4c34a16891f84e7b', 'utku', '5050000000', 0),
(5, 'oylesin', 'q@q.com', '827ccb0eea8a706c4c34a16891f84e7b', 'oylesine', '0', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(10) UNSIGNED NOT NULL,
  `urunId` int(10) UNSIGNED NOT NULL,
  `uyeId` int(10) UNSIGNED NOT NULL,
  `puan` tinyint(1) UNSIGNED NOT NULL,
  `yorumMetni` text NOT NULL,
  `yorumTarihi` int(10) UNSIGNED NOT NULL,
  `YorumIpAdresi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `adresler`
--
ALTER TABLE `adresler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bankahesaplarimiz`
--
ALTER TABLE `bankahesaplarimiz`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bannerlar`
--
ALTER TABLE `bannerlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `favoriler`
--
ALTER TABLE `favoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `havalebildirimleri`
--
ALTER TABLE `havalebildirimleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kargofirmalari`
--
ALTER TABLE `kargofirmalari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `menuler`
--
ALTER TABLE `menuler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sorular`
--
ALTER TABLE `sorular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sozlesmelervemetinler`
--
ALTER TABLE `sozlesmelervemetinler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunvaryantlari`
--
ALTER TABLE `urunvaryantlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailAdres` (`emailAdres`);

--
-- Tablo için indeksler `yoneticiler`
--
ALTER TABLE `yoneticiler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailAdres` (`emailAdres`),
  ADD UNIQUE KEY `kullaniciAdi` (`kullaniciAdi`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `adresler`
--
ALTER TABLE `adresler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `bankahesaplarimiz`
--
ALTER TABLE `bankahesaplarimiz`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `bannerlar`
--
ALTER TABLE `bannerlar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `favoriler`
--
ALTER TABLE `favoriler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `havalebildirimleri`
--
ALTER TABLE `havalebildirimleri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kargofirmalari`
--
ALTER TABLE `kargofirmalari`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `menuler`
--
ALTER TABLE `menuler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sorular`
--
ALTER TABLE `sorular`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sozlesmelervemetinler`
--
ALTER TABLE `sozlesmelervemetinler`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `urunvaryantlari`
--
ALTER TABLE `urunvaryantlari`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yoneticiler`
--
ALTER TABLE `yoneticiler`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
