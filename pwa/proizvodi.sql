-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 12:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proizvodi`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(32) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Ivan', 'Horvat', 'IHor', '$2y$10$JTMvtlGe01RXwzSPP5f1yOkpFc.W4xReN6GajFFt/L8jOOGSb9YgG', 1),
(2, 'Marko', 'Ivić', 'mar', '$2y$10$3BkcK1qNzeoTVOV.SUHEAuGhNtAeoTq36x3RMFvDuyzo.tr7K2nCG', 1),
(3, 'daw', 'grg', 'erd', '$2y$10$9MOlOujL0W9/qxSVrPmqDOubW7j81ZiwqqnMBXK7UCagIjgIQvgWy', 0),
(4, 'sf', 'vr', 'brt', '$2y$10$w8D0iodLTxUSb8QnKo7voufezYgWt4qWKyxL7HSRLEU6Uo6Toi75K', 0);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `id` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `slika` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `kategorija` varchar(50) NOT NULL,
  `skriven` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`id`, `naziv`, `slika`, `opis`, `kategorija`, `skriven`) VALUES
(1, 'Acer Aspire 89', 'lap1.jpg', 'Procesor: Intel i5-12450H 3.3 GHz; Octajezgreni (Osam)\r\nRadna memorija: DDR4 SDRAM 32 GB\r\nGrafika: NVIDIA GeForce RTX 2050 4GB GDDR6\r\nZaslon: 15.6\" LCD Full HD 1920x1080; 144Hz\r\nPohrana podataka:\r\n- SSD 512 GB PCi M.2\r\nI/O priključci\r\n- 4x USB priključka\r\n- 1x Mreža (RJ-45)\r\n- 1x HDMI', 'Laptop', 0),
(2, 'Notebook Lenovo IdeaPad Slim 3', 'lap2.jpg', 'PERFORMANCE\r\nProcessor AMD Ryzen 3 7320U (4C / 8T, 2.4 / 4.1GHz, 2MB L2 / 4MB L3)\r\nGraphics Integrated AMD Radeon 610M Graphics\r\nChipset AMD SoC Platform\r\nMemory 8GB Soldered LPDDR5-5500\r\nMemory Slots Memory soldered to systemboard, no slots, dual-channel\r\nMax Memory 8GB soldered memory, not upgradable\r\nStorage 512GB SSD M.2 2242 PCIe 4.0x4 NVMe\r\nStorage Support One drive, up to 512GB M.2 2242 SSD\r\nStorage Slot One M.2 PCIe 3.0 x2 slot\r\nCard Reader SD Card Reader', 'laptop', 0),
(3, 'DELL XPS 13', 'lap3.jpg', 'Intel Core processor i7-1260P 3.4GHz - 4.7GHz / 18MB Smart Cache / 12 Cores\r\nDisplay: 13.4 OLED 3.5K (3456x2160) InfinityEdge Touch Anti-Reflective 400-Nit\r\nRAM: 16GB, LPDDR5, 5200 MHz, integrated, dual channel\r\nHard Disk: 1TB M.2 PCIe Gen 4 NVMe Solid State Drive', 'Laptop', 0),
(4, 'Xiaomi Redmi Note 13 Pro', 'mob3.jpg\r\n', 'Zaslon:6.67\" AMOLED display\r\nRefresh rate: Up to 120Hz\r\nBrightness: 1300nits peak brightness\r\nContrast ratio: 5,000,000:1\r\nCorning® Gorilla® Glass 5\r\nResolution: 2400 x 1080\r\nMemorija: 256 GB\r\nRAM: 8 GB', 'mobitel', 0),
(7, 'Apple Iphone 14 Plus', 'mob1.jpg', 'Zaslon:6,7\" IPS LCD, 90Hz, 450 nits (typ), 600 nits (HBM)\r\nMemorija: 256GB\r\nRAM: 8GB\r\nOS: Android 13, MIUI 14\r\nKamera stražnja: 50 MP, f/1.8, 28mm (wide), PDAF + 2 MP, f/2.4, (macro)\r\nKamera prednja: 8 MP, f/2.0\r\nProcesor: Mediatek MT6769Z Helio G85 (12nm) Octa-core (2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nPovezivost: Wi-Fi 802.11 a/b/g/n/ac, dual-band, Bluetooth: 5.3\r\nSenzori: Fingerprint (side-mounted), accelerometer,virtual proximity, compass\r\nDual-SIM\r\nUSB Tip-C 2.0', 'mobitel', 0),
(13, 'Asus Gaming TUF A15', 'lap4.jpg', 'Model Name FA507NU-LP031\r\nMarketing Name ASUS TUF Gaming A15\r\nColor Mecha Gray\r\nProcessor AMD Ryzen 7 7735HS Mobile Processor (8-core/16-thread, 16MB L3 cache, up to 4.7 GHz max boost)\r\nDiscrete/Optimus MUX Switch + NVIDIA Advanced Optimus\r\nGraphic NVIDIA GeForce RTX 4050 Laptop GPU\r\nGraphic Wattage 2420MHz at 140W (2370MHz Boost Clock+50MHz OC, 115W+25W Dynamic Boost)\r\nMax Total Graphic Power 140W\r\nGraphic Memory 6GB GDDR6\r\nIGPU AMD Radeon Navi2 Graphics\r\nPanel Size 15.6-inch\r\nResolution FHD (1920 x 1080) 16:9\r\nRefresh Rate 144Hz', 'laptop', 1),
(14, 'Xiaomi 14', 'mob4.jpg', 'Operativni sistem Android 14\r\nKapacitet radne memorije 12 GB\r\nProcesor: Snapdragon 8 Gen 3\r\nEkran veličina 6,36\" TPO AMOLED 120Hz Corning Gorilla glass Victus front\r\nMemorija za pohranu 512 GB\r\nRezolucija 2670 x 1200\r\nEkran vrsta AMOLED\r\nVrsta konektora USB Type C\r\nKamera prednja 32 MP LEICA VARIO-SUMMILUX 1:1.6-2.2/14-75mm ASPH\r\nKamera stražnja 50MP+50MP+50MP\r\nUtor za memorijsku karticu NE\r\nBluetooth DA\r\nDual SIM DA', 'mobitel', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
