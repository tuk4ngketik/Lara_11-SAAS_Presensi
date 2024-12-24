-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: sas-presensi
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi` (
  `id_absensi` int(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `id_karyawan` int(10) NOT NULL,
  `latlong_masuk` varchar(100) DEFAULT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `foto_masuk` text DEFAULT NULL,
  `latlong_pulang` varchar(100) DEFAULT NULL,
  `jam_pulang` datetime DEFAULT NULL,
  `foto_pulang` text DEFAULT NULL,
  `total_waktu` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_absensi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi`
--

LOCK TABLES `absensi` WRITE;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `absensi_jadwal`
--

DROP TABLE IF EXISTS `absensi_jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi_jadwal` (
  `id_jadwal` int(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `id_karyawan` int(10) NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `id_lokasi` int(10) DEFAULT NULL COMMENT 'tb => absensi lokasi, jika val "0" = tdk ditentukan lokasinya',
  `id_waktu` int(10) DEFAULT NULL COMMENT 'tb => absensi waktu, jika val "0" = tdk ditentukan waktunya',
  `max_jarak` varchar(10) DEFAULT '10',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi_jadwal`
--

LOCK TABLES `absensi_jadwal` WRITE;
/*!40000 ALTER TABLE `absensi_jadwal` DISABLE KEYS */;
INSERT INTO `absensi_jadwal` VALUES (1,1,2,'2024-05-24','2024-05-29',1,3,'10',NULL,NULL,'2024-05-24 08:23:13',NULL),(2,1,1,'2024-05-27','2024-05-31',0,0,'10',NULL,NULL,'2024-05-24 16:27:08',NULL),(3,1,2,'2024-05-27','2024-05-31',2,1,'10',NULL,NULL,'2024-05-24 13:21:24',NULL);
/*!40000 ALTER TABLE `absensi_jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `absensi_lokasi`
--

DROP TABLE IF EXISTS `absensi_lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi_lokasi` (
  `id_lokasi` int(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(20) NOT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `alamat_lokasi` text DEFAULT NULL,
  `deskripsi_lokasi` text DEFAULT NULL,
  `lat` varchar(30) DEFAULT NULL,
  `lgt` varchar(30) DEFAULT NULL,
  `max_jarak` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi_lokasi`
--

LOCK TABLES `absensi_lokasi` WRITE;
/*!40000 ALTER TABLE `absensi_lokasi` DISABLE KEYS */;
INSERT INTO `absensi_lokasi` VALUES (1,1,'Kantor Pusat','bangbun 2','bangbun 3','-6.165385675287019','106.83360180427977','1.9','2024-05-17 20:38:25',1,'2024-05-21 07:18:12',1),(2,1,'Kantor Cabang','jln Cikungunya','tempat nyamuk','-6.185694836238937','106.9242390055104','2','2024-05-17 20:51:29',1,'2024-05-21 07:18:32',NULL),(3,2,'Konor Pusat ( Gunsa )','jln gunung sahari no. 20',NULL,'-6.1513771881772366','106.8357531374805','10','2024-06-18 07:40:14',2,'2024-06-18 07:40:14',NULL);
/*!40000 ALTER TABLE `absensi_lokasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `absensi_waktu`
--

DROP TABLE IF EXISTS `absensi_waktu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi_waktu` (
  `id_waktu` int(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `shift` enum('1','2','3') DEFAULT NULL,
  `masuk` time DEFAULT NULL,
  `pulang` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_waktu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi_waktu`
--

LOCK TABLES `absensi_waktu` WRITE;
/*!40000 ALTER TABLE `absensi_waktu` DISABLE KEYS */;
INSERT INTO `absensi_waktu` VALUES (1,1,'2','18:00:00','00:00:00','2024-05-18 21:12:41',1,'2024-05-18 15:21:43',1),(2,2,'1','08:30:00','17:30:00','2024-05-18 22:12:29',2,'2024-05-18 22:12:29',NULL),(3,1,'1','08:00:00','18:00:00','2024-05-18 22:13:14',1,'2024-05-18 22:13:14',NULL);
/*!40000 ALTER TABLE `absensi_waktu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alpa`
--

DROP TABLE IF EXISTS `alpa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alpa` (
  `id_alpa` int(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `id_karyawan` int(10) NOT NULL,
  `keterangan` enum('Izin','Sakit') DEFAULT 'Izin',
  `deskripsi_alpa` text DEFAULT NULL,
  `foto_alpa` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id_alpa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alpa`
--

LOCK TABLES `alpa` WRITE;
/*!40000 ALTER TABLE `alpa` DISABLE KEYS */;
/*!40000 ALTER TABLE `alpa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attr_pendidikan`
--

DROP TABLE IF EXISTS `attr_pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attr_pendidikan` (
  `pendidikan` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attr_pendidikan`
--

LOCK TABLES `attr_pendidikan` WRITE;
/*!40000 ALTER TABLE `attr_pendidikan` DISABLE KEYS */;
INSERT INTO `attr_pendidikan` VALUES ('-','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('SD','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('SLTP','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('SLTA','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('D1','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('D2','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('D3','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('S1','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('S2','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL),('S3','2024-05-17 00:23:36',0,'2024-05-16 17:23:36',NULL);
/*!40000 ALTER TABLE `attr_pendidikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuti`
--

DROP TABLE IF EXISTS `cuti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuti` (
  `id_cuti` int(20) NOT NULL AUTO_INCREMENT,
  `id_jeniscuti` int(20) DEFAULT NULL,
  `id_perusahaan` int(10) NOT NULL,
  `id_karyawan` int(10) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  PRIMARY KEY (`id_cuti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuti`
--

LOCK TABLES `cuti` WRITE;
/*!40000 ALTER TABLE `cuti` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuti_jenis`
--

DROP TABLE IF EXISTS `cuti_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuti_jenis` (
  `id_jeniscuti` int(20) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `jenis_cuti` varchar(50) DEFAULT NULL,
  `lama_cuti` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_jeniscuti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuti_jenis`
--

LOCK TABLES `cuti_jenis` WRITE;
/*!40000 ALTER TABLE `cuti_jenis` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuti_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daftars`
--

DROP TABLE IF EXISTS `daftars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daftars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftars`
--

LOCK TABLES `daftars` WRITE;
/*!40000 ALTER TABLE `daftars` DISABLE KEYS */;
/*!40000 ALTER TABLE `daftars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawan_keluarga`
--

DROP TABLE IF EXISTS `karyawan_keluarga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `karyawan_keluarga` (
  `id_keluarga` int(10) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(10) NOT NULL,
  `id_perusahaan` int(10) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `hubungan` enum('Ayah','Ibu','Anak','Kakak','Adik') DEFAULT NULL,
  `pendidikan` enum('-','SD','SMP','SLTA','D3','S1','S2','S3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_keluarga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan_keluarga`
--

LOCK TABLES `karyawan_keluarga` WRITE;
/*!40000 ALTER TABLE `karyawan_keluarga` DISABLE KEYS */;
/*!40000 ALTER TABLE `karyawan_keluarga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawan_keluargas`
--

DROP TABLE IF EXISTS `karyawan_keluargas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `karyawan_keluargas` (
  `id_keluarga` int(10) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(10) NOT NULL,
  `id_perusahaan` int(10) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `hubungan` enum('Ayah','Ibu','Anak','Kakak','Adik') DEFAULT NULL,
  `pendidikan` enum('-','SD','SMP','SLTA','D3','S1','S2','S3') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_keluarga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan_keluargas`
--

LOCK TABLES `karyawan_keluargas` WRITE;
/*!40000 ALTER TABLE `karyawan_keluargas` DISABLE KEYS */;
/*!40000 ALTER TABLE `karyawan_keluargas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawan_nonaktif_recs`
--

DROP TABLE IF EXISTS `karyawan_nonaktif_recs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `karyawan_nonaktif_recs` (
  `id_nonaktif` int(20) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(10) NOT NULL,
  `id_perusahaan` int(10) NOT NULL,
  `alasan` enum('Keluar','Pensiun','Pecat') NOT NULL,
  `keterangan` text DEFAULT NULL,
  `approved_by` int(10) DEFAULT NULL COMMENT 'id Yang menyetujui',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_nonaktif`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan_nonaktif_recs`
--

LOCK TABLES `karyawan_nonaktif_recs` WRITE;
/*!40000 ALTER TABLE `karyawan_nonaktif_recs` DISABLE KEYS */;
INSERT INTO `karyawan_nonaktif_recs` VALUES (1,1,1,'Keluar',NULL,NULL,'2024-06-08 19:43:45',1,'2024-06-08 19:43:45',NULL),(2,1,1,'Pecat','saoi',NULL,'2024-06-16 20:18:13',1,'2024-06-16 20:18:13',NULL),(3,2,1,'Keluar',NULL,NULL,'2024-06-16 20:19:54',1,'2024-06-16 20:19:54',NULL),(4,1,1,'Keluar',NULL,NULL,'2024-06-16 20:22:01',1,'2024-06-16 20:22:01',NULL),(5,2,1,'Pecat',NULL,NULL,'2024-06-16 20:23:05',1,'2024-06-16 20:23:05',NULL),(6,1,1,'Keluar',NULL,NULL,'2024-06-16 20:27:12',1,'2024-06-16 20:27:12',NULL),(7,2,1,'Keluar',NULL,NULL,'2024-06-16 20:27:49',1,'2024-06-16 20:27:49',NULL);
/*!40000 ALTER TABLE `karyawan_nonaktif_recs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawans`
--

DROP TABLE IF EXISTS `karyawans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `karyawans` (
  `id_karyawan` int(10) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `id_department` int(10) DEFAULT NULL,
  `id_jabatan` int(10) DEFAULT NULL,
  `id_lokasi` int(10) DEFAULT NULL,
  `nik` varchar(30) NOT NULL,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `pendidikan` enum('-','SD','SMP','SLTA','D3','S1','S2','S3') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `telp_karyawan` varchar(20) DEFAULT NULL,
  `email_karyawan` varchar(50) DEFAULT NULL,
  `password_karyawan` varchar(225) DEFAULT NULL,
  `alamat_karyawan` text DEFAULT NULL,
  `tgl_bergabung` date DEFAULT NULL,
  `status_karyawan` enum('Karyawan Tetap','Karyawan Kontrak','Harian','Magang') DEFAULT NULL,
  `status_pernikahan` enum('Menikah','Belum Menikah') DEFAULT NULL,
  `status_aktif` enum('Aktif','Tidak') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawans`
--

LOCK TABLES `karyawans` WRITE;
/*!40000 ALTER TABLE `karyawans` DISABLE KEYS */;
INSERT INTO `karyawans` VALUES (1,1,2,1,2,'1234','Fuad','S2','1970-02-19',NULL,'09876543210','aa@mail.com',NULL,'rancho','2024-05-01','Karyawan Tetap','Menikah','Aktif','2024-06-24 16:44:21',1,'2024-06-24 09:44:21',1),(2,1,2,2,1,'6666','Samura','S1','1980-05-03',NULL,'098765432101','ab@mail.com',NULL,'nias','2024-05-02','Karyawan Tetap','Menikah','Aktif','2024-05-17 09:27:42',1,'2024-06-18 02:46:49',1),(3,2,4,5,NULL,'1234','Rifki Jangkung','S2','2024-05-04',NULL,'098765432123','ba@mail.com','123456','priok','2024-05-04','Karyawan Kontrak','Menikah','Aktif','2024-05-16 17:45:37',2,'2024-05-16 17:45:37',NULL),(4,2,4,6,NULL,'1221','Baim vkool','S1','2024-05-04',NULL,'098765432121','bb@mail.com','123456','devok','2024-05-05','Karyawan Kontrak','Menikah','Aktif','2024-05-16 17:47:54',2,'2024-05-16 17:47:54',NULL),(5,2,5,7,NULL,'1222','Gebi','S1','2024-05-04','senen','098765432122','bc@mail.com','123456','senen','2024-05-17','Karyawan Kontrak','Menikah','Aktif','2024-05-16 17:53:35',2,'2024-05-16 17:53:35',NULL),(7,1,3,2,NULL,'32145','Pardigo','SD','2024-06-25','Jakarta','09876543211','ad@mail.com','123456','cadas raya','2024-06-25','Karyawan Tetap','Menikah','Aktif','2024-06-24 17:14:52',1,'2024-06-24 17:14:52',NULL);
/*!40000 ALTER TABLE `karyawans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_05_08_021024_create_daftars_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perusahaan`
--

DROP TABLE IF EXISTS `perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perusahaan` (
  `id_perusahaan` int(10) NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int(10) DEFAULT NULL,
  `logo_perusahaan` varchar(100) DEFAULT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `email_perusahaan` varchar(50) DEFAULT NULL,
  `telp_perusahaan` varchar(20) DEFAULT NULL,
  `industri` varchar(100) DEFAULT NULL,
  `deskripsi_perusahaan` text DEFAULT NULL,
  `status_aktif` enum('0','1') DEFAULT '0',
  `status_berlangganan` enum('Free','Premium') DEFAULT 'Free',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perusahaan`
--

LOCK TABLES `perusahaan` WRITE;
/*!40000 ALTER TABLE `perusahaan` DISABLE KEYS */;
INSERT INTO `perusahaan` VALUES (1,1,NULL,'PT IKIKs','favasvasva','ikik@mail.com','0980978798','finance',NULL,'0','Free',NULL,NULL,NULL,NULL),(2,2,NULL,'PT Maarsose','jln tikus','bp@mail.com','0987654321','JAsa',NULL,'0','Free',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perusahaan_department`
--

DROP TABLE IF EXISTS `perusahaan_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perusahaan_department` (
  `id_department` int(10) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `nama_department` varchar(100) DEFAULT NULL,
  `deskripsi_department` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_department`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perusahaan_department`
--

LOCK TABLES `perusahaan_department` WRITE;
/*!40000 ALTER TABLE `perusahaan_department` DISABLE KEYS */;
INSERT INTO `perusahaan_department` VALUES (1,1,'HRD',NULL,'2024-05-13 15:39:45',1,'2024-05-13 15:39:45',NULL),(2,1,'IT','ed','2024-05-13 15:41:13',1,'2024-05-13 08:54:25',1),(3,1,'Akunting',NULL,'2024-05-13 16:46:10',1,'2024-05-13 16:46:10',NULL),(4,2,'HRD',NULL,'2024-05-16 17:41:49',2,'2024-05-16 17:41:49',NULL),(5,2,'Akunting',NULL,'2024-05-16 17:42:31',2,'2024-05-16 17:42:31',NULL);
/*!40000 ALTER TABLE `perusahaan_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perusahaan_jabatan`
--

DROP TABLE IF EXISTS `perusahaan_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perusahaan_jabatan` (
  `id_jabatan` int(10) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(10) NOT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL,
  `kode_jabatan` varchar(100) DEFAULT NULL,
  `deskripsi_jabatan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perusahaan_jabatan`
--

LOCK TABLES `perusahaan_jabatan` WRITE;
/*!40000 ALTER TABLE `perusahaan_jabatan` DISABLE KEYS */;
INSERT INTO `perusahaan_jabatan` VALUES (1,1,'General Manager','GM',NULL,'2024-05-16 17:24:21',1,'2024-05-16 17:24:21',NULL),(2,1,'Manager','MG',NULL,'2024-05-16 17:27:39',1,'2024-05-16 17:27:39',NULL),(3,1,'Senio Supervisor','S-SPV',NULL,'2024-05-16 17:28:56',1,'2024-05-16 17:28:56',NULL),(4,1,'Supervisor','SPV',NULL,'2024-05-16 17:29:09',1,'2024-05-16 17:29:09',NULL),(5,2,'Manager','Mg',NULL,'2024-05-16 17:42:53',2,'2024-05-16 17:42:53',NULL),(6,2,'Supervisor','Spv',NULL,'2024-05-16 17:43:12',2,'2024-05-16 17:43:12',NULL),(7,2,'Staff','stf',NULL,'2024-05-16 17:43:29',2,'2024-05-16 17:43:29',NULL);
/*!40000 ALTER TABLE `perusahaan_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perusahaan_pendaftar`
--

DROP TABLE IF EXISTS `perusahaan_pendaftar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perusahaan_pendaftar` (
  `id_pendaftar` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `aipi` varchar(10) DEFAULT NULL,
  `hash_verifikasi` varchar(100) DEFAULT NULL,
  `maks_verifikasi` datetime DEFAULT NULL,
  `terverifikasi` enum('Y','N') DEFAULT 'N',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pendaftar`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perusahaan_pendaftar`
--

LOCK TABLES `perusahaan_pendaftar` WRITE;
/*!40000 ALTER TABLE `perusahaan_pendaftar` DISABLE KEYS */;
INSERT INTO `perusahaan_pendaftar` VALUES (1,'agaus riadi','a@mail.com','$2y$12$nwQaEzWj6T/b9TS/W7Wn9OCpIVNYANoT6F5eIE6WSVfx6a7wp1H6m',NULL,NULL,'847b59052594e8441762d80584076720','2024-05-13 09:29:13','Y','2024-05-12 09:29:13','2024-05-12 09:29:23'),(2,'cuang co','b@mail.com','$2y$12$ilP2l6aQ6oE2xCEgVSkEN.Jc6iw1gCiBr3xaJPTf0.PSQxM6SdTjC',NULL,NULL,'982b67da526bb983a0968f2ebfb6244b','2024-05-13 09:44:20','Y','2024-05-12 09:44:20','2024-05-12 09:44:44'),(3,'gang nam','c@mail.com','$2y$12$886hhx6hlS5dm8aCU/dz2.1a0/VU9qNgiO4A7QdxUOCfuh1l7Q072',NULL,NULL,'11a551cc666ede6ced1074cb3097f1a4','2024-05-18 19:43:47','Y','2024-05-17 19:43:47','2024-05-17 19:44:03');
/*!40000 ALTER TABLE `perusahaan_pendaftar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('34osN73q6VtlGhJCjJtRLnSSM5aKLAWOMA4SyhKR',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZTZmd2Y3OW5ScGM2ZG10UkNET2hJN3QxbVJjN24yVGVVZEFqcmxPViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXBhcnRtZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1722021678),('DZlLUxSrde7Qs8owwdRSINfJJKrkNIlSVLkKVhEf',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiejFwcDdvdjBSbGc0ZG9SbkxieVJneFdBZk9aRFptNkpsSkVjSHNRQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lZGl0LXBlcnVzYWhhYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1722610813),('elpoP8xlRXVlKKUfLUIjghs9Niv8KpNokQFe6k0R',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWUxxaHlSQzRhOEZoYzQ4RTJta2Q2ekZiWUdHYVBpOEhhZmREeWx3UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iZXJhbmRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9',1721926172),('fI2S1qjZnosdErUZuKhZqgw1Luk08Gidep4nrWbw',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUnR5djNrWExSNjhxejVGd1JId2RoSmxjSGRLQnppdWRERTdZeHh0MSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2JlcmFuZGEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2J1YXQtcGVydXNhaGFhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',1722610776),('oI7Epur6TJGFKDufJ5tYknVDdr112VpmZulTQM9X',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNHFjMzdhaGdqbkozNlpJUklGWDhMM1o5dlN2NVQ1dXRqWDZlbm5XWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iZXJhbmRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2JlcmFuZGEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1721845548),('vxzTWZFcGquNVJVrhumbvADDgWL1qHf61PlCPQP0',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXM2ZjhiOVpjNTFPNDNZWWVnZVpRdDAwbkp5VFI5VjcwMHM0MEczSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zcHYtbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1721844928);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sas-presensi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-02 22:14:41
