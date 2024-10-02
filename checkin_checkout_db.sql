-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.33 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Membuang data untuk tabel checkin_checkout_db.checkin: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `checkin` DISABLE KEYS */;
INSERT INTO `checkin` (`id`, `name`, `barcode`, `checkin_time`) VALUES
	(1, 'Rizqy Alfajri', 'RI02', '2024-10-02 11:28:16');
/*!40000 ALTER TABLE `checkin` ENABLE KEYS */;

-- Membuang data untuk tabel checkin_checkout_db.checkout: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `checkout` DISABLE KEYS */;
INSERT INTO `checkout` (`id`, `name`, `barcode`, `checkout_time`) VALUES
	(1, 'Rizqy Alfajri', 'RI02', '2024-10-02 11:25:14'),
	(2, 'FUAD', 'RI03', '2024-10-02 11:43:43');
/*!40000 ALTER TABLE `checkout` ENABLE KEYS */;

-- Membuang data untuk tabel checkin_checkout_db.sampelbarang: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `sampelbarang` DISABLE KEYS */;
INSERT INTO `sampelbarang` (`id`, `kodebarang`, `namabarang`) VALUES
	(1, 'RI02', 'BATU'),
	(2, 'RI03', 'BATU KIOK'),
	(4, 'RI04', 'ANGIN');
/*!40000 ALTER TABLE `sampelbarang` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
