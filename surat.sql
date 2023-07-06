-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table app_surat.failed_jobs: ~0 rows (approximately)

-- Dumping data for table app_surat.instansi: ~0 rows (approximately)

-- Dumping data for table app_surat.kode_surat: ~0 rows (approximately)

-- Dumping data for table app_surat.migrations: ~15 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_06_20_103851_create_instansi_table', 1),
	(6, '2023_06_20_104411_create_perusahaan_table', 1),
	(7, '2023_06_20_105106_create_kode_surat_table', 1),
	(8, '2023_06_23_083551_create_projek_table', 1),
	(9, '2023_06_24_022948_create_surat_table', 1),
	(10, '2023_06_24_094313_add_id_projek_to_projek_table', 1),
	(11, '2023_06_24_153618_add_no_projek_to_projek_table', 1),
	(12, '2023_06_26_074229_create_tahapan_table', 1),
	(13, '2023_06_26_075951_add_kode_instansi_to_instansi_table', 1),
	(14, '2023_06_26_082041_add_nilai_to_table', 1),
	(15, '2023_07_03_042609_add_user_id_to_surat_table', 1);

-- Dumping data for table app_surat.password_resets: ~0 rows (approximately)

-- Dumping data for table app_surat.personal_access_tokens: ~0 rows (approximately)

-- Dumping data for table app_surat.perusahaan: ~0 rows (approximately)

-- Dumping data for table app_surat.projek: ~0 rows (approximately)

-- Dumping data for table app_surat.surat: ~0 rows (approximately)

-- Dumping data for table app_surat.tahapan: ~0 rows (approximately)

-- Dumping data for table app_surat.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
