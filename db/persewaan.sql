-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               11.3.2-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for persewaan
CREATE DATABASE IF NOT EXISTS `persewaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `persewaan`;

-- Dumping structure for table persewaan.m_barang
DROP TABLE IF EXISTS `m_barang`;
CREATE TABLE IF NOT EXISTS `m_barang` (
  `ID_BARANG` varchar(50) NOT NULL,
  `ID_KATEGORI` varchar(50) DEFAULT NULL,
  `NAMA_BARANG` varchar(100) DEFAULT NULL,
  `KETERANGAN` varchar(150) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT '1',
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_BARANG`),
  KEY `ID_KATEGORI` (`ID_KATEGORI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.m_barang: ~3 rows (approximately)
REPLACE INTO `m_barang` (`ID_BARANG`, `ID_KATEGORI`, `NAMA_BARANG`, `KETERANGAN`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
	('BRG-202412-0001', 'KAT-202412-001', 'SUUNTO', '', '1', 'admin', '2024-12-02 10:58:12', 'admin', '2024-12-03 23:26:08'),
	('BRG-202412-0002', 'KAT-202412-002', 'Montana 680', 'Include Memory', '1', 'admin', '2024-12-03 16:29:37', NULL, NULL),
	('BRG-202412-0003', 'KAT-202412-002', 'Map 76 CSx', 'Include Memory', '1', 'admin', '2024-12-03 16:31:58', 'admin', '2024-12-03 16:46:22');

-- Dumping structure for table persewaan.m_kategori
DROP TABLE IF EXISTS `m_kategori`;
CREATE TABLE IF NOT EXISTS `m_kategori` (
  `ID_KATEGORI` varchar(50) NOT NULL,
  `NAMA_KATEGORI` varchar(50) DEFAULT NULL,
  `DESKRIPSI` varchar(150) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT '1',
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_KATEGORI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.m_kategori: ~4 rows (approximately)
REPLACE INTO `m_kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `DESKRIPSI`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
	('KAT-202412-001', 'Kompas', '', '1', 'admin', '2024-12-02 10:50:04', 'admin', '2024-12-03 16:26:12'),
	('KAT-202412-002', 'GPS Garmin', '', '1', 'admin', '2024-12-02 10:50:19', 'admin', '2024-12-03 23:59:24'),
	('KAT-202412-003', 'GPS Trimble', '', '1', 'admin', '2024-12-02 10:50:35', NULL, NULL),
	('KAT-202412-004', 'Drone', '', '1', NULL, NULL, 'admin', '2024-12-03 16:27:01');

-- Dumping structure for table persewaan.m_pekerjaan
DROP TABLE IF EXISTS `m_pekerjaan`;
CREATE TABLE IF NOT EXISTS `m_pekerjaan` (
  `ID_PEKERJAAN` varchar(50) NOT NULL,
  `NAMA_PEKERJAAN` varchar(200) DEFAULT NULL,
  `KETERANGAN` text DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT '1',
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PEKERJAAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.m_pekerjaan: ~6 rows (approximately)
REPLACE INTO `m_pekerjaan` (`ID_PEKERJAAN`, `NAMA_PEKERJAAN`, `KETERANGAN`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
	('JNS-202411-001', 'Update Landscape', '', '1', NULL, NULL, 'admin', '2024-12-03 23:48:00'),
	('JNS-202411-002', 'Dokumentasi', NULL, '1', NULL, NULL, NULL, NULL),
	('JNS-202411-003', 'Foto Kebun', '', '1', NULL, NULL, 'admin', '2024-12-03 16:55:16'),
	('JNS-202411-004', 'Hotspot / Kebakaran', NULL, '1', NULL, NULL, NULL, NULL),
	('JNS-202411-005', 'HCV', NULL, '1', NULL, NULL, NULL, NULL),
	('JNS-202411-006', 'Social Problem / Konflik Area', NULL, '1', NULL, NULL, NULL, NULL),
	('JNS-202411-007', 'Rencana Plasma / Kemitraan', NULL, '1', NULL, NULL, NULL, NULL);

-- Dumping structure for table persewaan.m_user
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE IF NOT EXISTS `m_user` (
  `ID_USER` varchar(50) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `USERPASSWORD` text DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `AKSES` varchar(50) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.m_user: ~1 rows (approximately)
REPLACE INTO `m_user` (`ID_USER`, `USERNAME`, `USERPASSWORD`, `NAMA`, `EMAIL`, `AKSES`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
	('USR-202411-001', 'admin', '$2y$12$F0qtp9zUusLf6MidKuX4deuItKIu1h7PF3XNFyy8j4FK4U7qIZJU.', 'admin', 'mail@mail.com', 'Admin', '1', 'husniaditya', '2024-11-17 16:56:29', 'admin', '2024-12-06 16:25:21');

-- Dumping structure for table persewaan.t_pemasukan
DROP TABLE IF EXISTS `t_pemasukan`;
CREATE TABLE IF NOT EXISTS `t_pemasukan` (
  `ID_PEMASUKAN` varchar(50) NOT NULL,
  `ID_PENGELUARAN` varchar(50) NOT NULL,
  `TANGGAL_MASUK` date DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `OPERATING_UNIT` varchar(50) DEFAULT NULL,
  `DIVISI` varchar(50) DEFAULT NULL,
  `KETERANGAN` varchar(100) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT '1',
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PEMASUKAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.t_pemasukan: ~2 rows (approximately)
REPLACE INTO `t_pemasukan` (`ID_PEMASUKAN`, `ID_PENGELUARAN`, `TANGGAL_MASUK`, `NAMA`, `OPERATING_UNIT`, `DIVISI`, `KETERANGAN`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
	('MSK-202412-001', 'BALANCE', '2024-12-04', 'Husni Aditya A', 'Regional', 'Technical Dev', '', '1', 'admin', '2024-12-04 16:26:53', 'admin', '2024-12-04 17:19:19'),
	('MSK-202412-002', 'KLR-202412-001', '2024-12-06', 'Simon Siburat', 'HO JKT', 'PHI', '', '1', 'admin', '2024-12-06 10:05:17', NULL, NULL);

-- Dumping structure for table persewaan.t_pengeluaran
DROP TABLE IF EXISTS `t_pengeluaran`;
CREATE TABLE IF NOT EXISTS `t_pengeluaran` (
  `ID_PENGELUARAN` varchar(50) NOT NULL,
  `TANGGAL_KELUAR` date DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `OPERATING_UNIT` varchar(50) DEFAULT NULL,
  `DIVISI` varchar(50) DEFAULT NULL,
  `ID_PEKERJAAN` varchar(50) DEFAULT NULL,
  `KETERANGAN` varchar(150) DEFAULT NULL,
  `STATUS_APPROVAL` varchar(50) DEFAULT '0',
  `TANGGAL_APPROVAL` datetime DEFAULT NULL,
  `USER_APPROVAL` varchar(50) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT '1',
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `UPDATED_BY` varchar(50) DEFAULT NULL,
  `UPDATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PENGELUARAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.t_pengeluaran: ~3 rows (approximately)
REPLACE INTO `t_pengeluaran` (`ID_PENGELUARAN`, `TANGGAL_KELUAR`, `NAMA`, `OPERATING_UNIT`, `DIVISI`, `ID_PEKERJAAN`, `KETERANGAN`, `STATUS_APPROVAL`, `TANGGAL_APPROVAL`, `USER_APPROVAL`, `STATUS`, `CREATED_BY`, `CREATED_DATE`, `UPDATED_BY`, `UPDATED_DATE`) VALUES
	('KLR-202412-001', '2024-12-06', 'Simon Siburat', 'HO JKT', 'PHI', 'JNS-202411-005', '', '1', '2024-12-06 10:03:13', 'admin', '1', 'admin', '2024-12-06 10:02:13', NULL, NULL),
	('KLR-202412-002', '2024-12-06', 'Lo Koon Wai', 'Regional', 'PH', 'JNS-202411-007', '', '1', '2024-12-06 10:04:31', 'admin', '1', 'admin', '2024-12-06 10:03:51', NULL, NULL),
	('KLR-202412-003', '2024-12-06', 'Suwardi', 'Regional', 'GM', 'JNS-202411-004', '', '0', NULL, NULL, '1', 'admin', '2024-12-06 20:06:53', NULL, NULL);

-- Dumping structure for table persewaan.t_persediaan
DROP TABLE IF EXISTS `t_persediaan`;
CREATE TABLE IF NOT EXISTS `t_persediaan` (
  `ID_PERSEDIAAN` varchar(50) NOT NULL,
  `ID_TRANSAKSI` varchar(50) DEFAULT NULL,
  `ID_BARANG` varchar(50) DEFAULT NULL,
  `DK` varchar(50) DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `FOTO` text DEFAULT NULL,
  `KONDISI` varchar(50) DEFAULT NULL,
  `KETERANGAN` varchar(200) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT '1',
  PRIMARY KEY (`ID_PERSEDIAAN`),
  KEY `ID_TRANSAKSI` (`ID_TRANSAKSI`),
  KEY `ID_BARANG` (`ID_BARANG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table persewaan.t_persediaan: ~5 rows (approximately)
REPLACE INTO `t_persediaan` (`ID_PERSEDIAAN`, `ID_TRANSAKSI`, `ID_BARANG`, `DK`, `QTY`, `FOTO`, `KONDISI`, `KETERANGAN`, `STATUS`) VALUES
	('PER-202412-001', 'MSK-202412-001', 'BRG-202412-0003', 'D', 12, './assets/image/foto/pengembalian/MSK-202412-001 garmin 76 Csx.jpg', 'Rusak', 'ada kerusakan baterai', '1'),
	('PER-202412-002', 'KLR-202412-001', 'BRG-202412-0003', 'K', -3, './assets/image/foto/peminjaman/KLR-202412-001 garmin 76 Csx.jpg', 'Baik', 'SN : 76356786, 1QF081353, 1QF090697', '1'),
	('PER-202412-003', 'KLR-202412-002', 'BRG-202412-0003', 'K', -1, './assets/image/foto/peminjaman/KLR-202412-002 wilfest logo.jpg', 'Baik', 'SN : 76356786', '1'),
	('PER-202412-004', 'MSK-202412-002', 'BRG-202412-0003', 'D', 3, './assets/image/foto/pengembalian/MSK-202412-002 wilfest logo.jpg', 'Baik', 'SN : 76356786, 1QF081353, 1QF090697', '1'),
	('PER-202412-005', 'KLR-202412-003', 'BRG-202412-0003', 'K', -3, './assets/image/foto/peminjaman/KLR-202412-003 ERD - Material.png', 'Baik', 'SN : 76356786, 1QF081353, 1QF090697', '1');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
