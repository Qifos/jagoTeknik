-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 07:54 AM
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
-- Database: `jago_teknik`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli_matkul`
--

CREATE TABLE `beli_matkul` (
  `id_beli_matkul` int(11) NOT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `cara_pembayaran` varchar(100) DEFAULT NULL,
  `sub_total` decimal(12,2) DEFAULT NULL,
  `diskon` decimal(12,2) DEFAULT NULL,
  `biaya_admin` decimal(12,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `benefit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beli_matkul`
--

INSERT INTO `beli_matkul` (`id_beli_matkul`, `id_matkul`, `id_user`, `cara_pembayaran`, `sub_total`, `diskon`, `biaya_admin`, `total`, `benefit`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'VA BNI', 100000.00, 0.00, 2500.00, 102500.00, 'Akses 30 hari', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(2, 2, 2, 'QRIS', 150000.00, 10.00, 3000.00, 138000.00, 'Akses 45 hari', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(3, 5, 3, 'VA BRI', 200000.00, 0.00, 3000.00, 203000.00, 'Akses 60 hari', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(4, 3, 3, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(5, 4, 4, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(6, 6, 6, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(7, 7, 7, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(8, 8, 8, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(9, 9, 9, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(10, 10, 10, 'QRIS', 100000.00, 0.00, 0.00, 100000.00, 'Akses 30 hari (auto)', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(11, 2, 20, 'wallet', 90000.00, 45000.00, 2000.00, 47000.00, 'Akses Struktur Data', '2025-11-14 01:26:49', '2025-11-14 01:26:49'),
(12, 2, 20, 'ewallet', 90000.00, 45000.00, 2000.00, 47000.00, 'Akses Struktur Data', '2025-11-14 01:32:55', '2025-11-14 01:32:55'),
(13, 2, 20, 'bca', 90000.00, 45000.00, 2000.00, 47000.00, 'Akses Struktur Data', '2025-11-16 07:32:49', '2025-11-16 07:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_status` int(11) NOT NULL,
  `status_materi` tinyint(1) DEFAULT NULL,
  `progres_precentage` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_status`, `status_materi`, `progres_precentage`, `created_at`, `updated_at`) VALUES
(1, 1, 100, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(2, 1, 90, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(3, 1, 75, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(4, 1, 60, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(5, 1, 50, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(6, 0, 40, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(7, 0, 30, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(8, 0, 20, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(9, 0, 10, '2025-11-06 08:42:15', '2025-11-06 08:42:15'),
(10, 0, 0, '2025-11-06 08:42:15', '2025-11-06 08:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_kelas`, `tanggal`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-11-10', '09:00:00', '11:00:00', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(2, 2, '2025-11-11', '13:00:00', '15:00:00', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(3, 3, '2025-11-12', '08:00:00', '10:00:00', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(4, 4, '2025-11-13', '10:00:00', '12:00:00', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(5, 5, '2025-11-14', '14:00:00', '16:00:00', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(6, 6, '2025-11-15', '09:00:00', '11:00:00', '2025-11-06 08:39:17', '2025-11-06 08:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `id_mentor` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `id_mentor`, `id_user`, `id_matkul`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Sistem Informasi', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(2, 2, 2, 2, 'Teknik Informatika', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(3, 3, 3, 3, 'Teknik Elektro', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(4, 4, 4, 4, 'Teknik Industri', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(5, 5, 5, 5, 'Teknik Mesin', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(6, 6, 6, 6, 'Teknik Komputer', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(7, 7, 7, 7, 'Teknik Sipil', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(8, 8, 8, 8, 'Statistika', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(9, 9, 9, 9, 'Teknik Fisika', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(10, 10, 10, 10, 'Data Science', '2025-11-06 08:39:17', '2025-11-06 08:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_wishlist_kelas` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `preview` text DEFAULT NULL,
  `rating_kelas` int(11) DEFAULT NULL,
  `rating_review` varchar(255) DEFAULT NULL,
  `tempat` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_matkul`, `id_jadwal`, `id_materi`, `id_wishlist_kelas`, `deskripsi`, `preview`, `rating_kelas`, `rating_review`, `tempat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 'Kelas pengantar SI batch A', 'Preview materi pengantar SI', 5, 'Mantap', 'Gedung SI-1', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(2, 2, 2, 2, 1, 'Kelas struktur data batch A', 'Preview struktur data', 4, 'Bagus', 'Lab IF-2', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(3, 3, 3, 3, 4, 'Kelas elektronika', 'Preview elektronika', 5, 'Mendalam', 'Lab Elektro', '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(4, 8, 4, 4, 5, 'Kelas statistika dasar', 'Preview statistika', 4, 'Cukup jelas', 'Ruang Stat-1', '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(5, 10, 5, 5, 3, 'Kelas DS pengantar', 'Preview DS', 5, 'Recommended', 'R. Data-01', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(6, 6, 6, 6, 6, 'Kelas arsitektur komputer', 'Preview arkom', 4, 'Sistematis', 'Lab Komputer', '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(14, 4, NULL, NULL, NULL, 'Auto kelas untuk Perencanaan Produksi', 'Preview Perencanaan Produksi', NULL, NULL, NULL, '2025-11-06 09:00:42', '2025-11-06 09:00:42'),
(15, 5, NULL, NULL, NULL, 'Auto kelas untuk Mekanika Teknik', 'Preview Mekanika Teknik', NULL, NULL, NULL, '2025-11-06 09:00:42', '2025-11-06 09:00:42'),
(16, 7, NULL, NULL, NULL, 'Auto kelas untuk Mekanika Fluida', 'Preview Mekanika Fluida', NULL, NULL, NULL, '2025-11-06 09:00:42', '2025-11-06 09:00:42'),
(17, 9, NULL, NULL, NULL, 'Auto kelas untuk Instrumentasi', 'Preview Instrumentasi', NULL, NULL, NULL, '2025-11-06 09:00:42', '2025-11-06 09:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `live_chat`
--

CREATE TABLE `live_chat` (
  `id_live_chat` int(11) NOT NULL,
  `id_mentor` int(11) DEFAULT NULL,
  `sender_type` enum('user','mentor') NOT NULL DEFAULT 'user',
  `id_user` int(11) DEFAULT NULL,
  `messages` text DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_chat`
--

INSERT INTO `live_chat` (`id_live_chat`, `id_mentor`, `sender_type`, `id_user`, `messages`, `media`, `is_read`, `time`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'user', 1, 'Halo kak, mau tanya materi UTS', NULL, 0, '09:12:00', '2025-11-06', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(2, 2, 'user', 2, 'Silakan, bagian mana yang sulit?', NULL, 0, '09:13:10', '2025-11-06', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(3, 1, 'user', 1, 'Tentang ERD & normalisasi', NULL, 0, '09:13:40', '2025-11-06', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(4, 2, 'user', 2, 'Oke, nanti aku kirim contoh ya', 'link.pdf', 0, '09:14:25', '2025-11-06', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(5, 3, 'user', 3, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(6, 4, 'user', 4, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(7, 5, 'user', 5, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(8, 6, 'user', 6, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(9, 7, 'user', 7, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(10, 8, 'user', 8, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(11, 9, 'user', 9, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(12, 10, 'user', 10, 'Chat awal otomatis', NULL, 0, '09:00:00', '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `id_video` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `nama_materi` varchar(150) NOT NULL,
  `isi_materi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_video`, `id_kelas`, `id_matkul`, `nama_materi`, `isi_materi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Pendahuluan SI', 'Materi pengantar SI', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(2, 2, 2, 2, 'Array & Linked List', 'Struktur data dasar', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(3, 3, 3, 3, 'Dioda & Transistor', 'Komponen aktif', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(4, 4, 4, 8, 'Distribusi Normal', 'Konsep distribusi', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(5, 5, 5, 10, 'Pipeline Data DS', 'Alur dasar data science', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(6, 6, 6, 6, 'Arsitektur Komputer — Pengantar', 'Materi awal Arkom', '2025-11-06 08:44:51', '2025-11-06 08:44:51'),
(7, 7, 14, 4, 'Materi Otomatis — Perencanaan Produksi', 'Placeholder materi untuk Perencanaan Produksi', '2025-11-06 08:50:17', '2025-11-06 09:01:08'),
(8, 8, 15, 5, 'Materi Otomatis — Mekanika Teknik', 'Placeholder materi untuk Mekanika Teknik', '2025-11-06 08:50:17', '2025-11-06 09:01:08'),
(9, 9, 16, 7, 'Materi Otomatis — Mekanika Fluida', 'Placeholder materi untuk Mekanika Fluida', '2025-11-06 08:50:17', '2025-11-06 09:01:08'),
(10, 10, 17, 9, 'Materi Otomatis — Instrumentasi', 'Placeholder materi untuk Instrumentasi', '2025-11-06 08:50:17', '2025-11-06 09:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL,
  `id_mentor` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_beli_matkul` int(11) DEFAULT NULL,
  `nama_matkul` varchar(150) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `id_mentor`, `id_materi`, `id_jurusan`, `id_kelas`, `id_beli_matkul`, `nama_matkul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 'Pengantar SI', 'Dasar-dasar Sistem Informasi', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(2, 2, 2, 2, 2, 2, 'Struktur Data', 'Struktur data dan algoritma dasar', '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(3, 3, 3, 3, 3, 4, 'Elektronika Dasar', 'Konsep dasar rangkaian elektronika', '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(4, 4, 7, 4, 14, 5, 'Perencanaan Produksi', 'Dasar perencanaan dan pengendalian produksi', '2025-11-06 08:39:17', '2025-11-06 09:00:55'),
(5, 5, 8, 5, 15, 3, 'Mekanika Teknik', 'Gaya, momen, dan struktur', '2025-11-06 08:39:17', '2025-11-06 09:00:55'),
(6, 6, 6, 6, 6, 6, 'Arsitektur Komputer', 'Struktur dan organisasi komputer', '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(7, 7, 9, 7, 16, 7, 'Mekanika Fluida', 'Prinsip dasar fluida teknik', '2025-11-06 08:39:17', '2025-11-06 09:00:55'),
(8, 8, 4, 8, 4, 8, 'Statistika Dasar', 'Statistik deskriptif dan inferensial', '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(9, 9, 10, 9, 17, 9, 'Instrumentasi', 'Sensor dan alat ukur dalam teknik', '2025-11-06 08:39:17', '2025-11-06 09:00:55'),
(10, 10, 5, 10, 5, 10, 'Pengantar Data Science', 'Konsep dasar data science', '2025-11-06 08:39:17', '2025-11-06 08:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id_mentor` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_chat` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `angkatan` int(11) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `universitas` varchar(150) DEFAULT NULL,
  `jenis_kelamin` tinyint(1) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `jumlah_video` int(11) DEFAULT NULL,
  `jumlah_kelas` int(11) DEFAULT NULL,
  `jumlah_materi` int(11) DEFAULT NULL,
  `jumlah_siswa` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id_mentor`, `id_jurusan`, `id_matkul`, `id_chat`, `nama`, `password`, `email`, `no_hp`, `angkatan`, `tanggal_lahir`, `universitas`, `jenis_kelamin`, `foto_profil`, `otp`, `rating`, `jumlah_video`, `jumlah_kelas`, `jumlah_materi`, `jumlah_siswa`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Raisya Anggita', 'pass123', 'raisya.anggi@its.ac.id', 8121110001, 2019, '2000-01-11', 'Institut Teknologi Sepuluh Nopember', 0, 'https://i.pravatar.cc/300?img=11', 332211, 5, 12, 5, 25, 100, '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(2, 2, 2, 2, 'Rafi Akmal', 'pass123', 'rafi.akmal@its.ac.id', 8121110002, 2020, '2001-05-12', 'Institut Teknologi Sepuluh Nopember', 1, 'https://i.pravatar.cc/300?img=12', 332212, 4, 10, 6, 22, 90, '2025-11-06 08:39:17', '2025-11-06 08:44:51'),
(3, 3, 3, 5, 'Dinda Larasati', 'pass123', 'dinda.laras@its.ac.id', 8121110003, 2018, '1999-07-22', 'Institut Teknologi Sepuluh Nopember', 0, 'https://i.pravatar.cc/300?img=13', 332213, 5, 13, 7, 28, 115, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(4, 4, 4, 6, 'Fakhri Adyatama', 'pass123', 'fakhri.adya@its.ac.id', 8121110004, 2021, '2002-09-02', 'Institut Teknologi Sepuluh Nopember', 1, 'https://i.pravatar.cc/300?img=14', 332214, 5, 9, 4, 18, 70, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(5, 5, 5, 7, 'Kirana Dewi', 'pass123', 'kirana.dewi@its.ac.id', 8121110005, 2020, '2001-04-10', 'Institut Teknologi Sepuluh Nopember', 0, 'https://i.pravatar.cc/300?img=15', 332215, 4, 8, 4, 15, 80, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(6, 6, 6, 8, 'Reno Prasetya', 'pass123', 'reno.pras@its.ac.id', 8121110006, 2019, '2000-06-23', 'Institut Teknologi Sepuluh Nopember', 1, 'https://i.pravatar.cc/300?img=16', 332216, 5, 11, 6, 24, 90, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(7, 7, 7, 9, 'Tania Putri', 'pass123', 'tania.putri@its.ac.id', 8121110007, 2021, '2003-02-17', 'Institut Teknologi Sepuluh Nopember', 0, 'https://i.pravatar.cc/300?img=17', 332217, 4, 7, 3, 12, 60, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(8, 8, 8, 10, 'Bagas Saputra', 'pass123', 'bagas.saputra@its.ac.id', 8121110008, 2020, '2001-11-05', 'Institut Teknologi Sepuluh Nopember', 1, 'https://i.pravatar.cc/300?img=18', 332218, 5, 10, 5, 20, 75, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(9, 9, 9, 11, 'Citra Ayuning', 'pass123', 'citra.ayu@its.ac.id', 8121110009, 2021, '2003-08-30', 'Institut Teknologi Sepuluh Nopember', 0, 'https://i.pravatar.cc/300?img=19', 332219, 5, 9, 4, 19, 82, '2025-11-06 08:39:17', '2025-11-06 08:50:17'),
(10, 10, 10, 12, 'Naufal Raditya', 'pass123', 'naufal.radi@its.ac.id', 8121110010, 2019, '2000-10-19', 'Institut Teknologi Sepuluh Nopember', 1, 'https://i.pravatar.cc/300?img=20', 332220, 4, 6, 3, 14, 55, '2025-11-06 08:39:17', '2025-11-06 08:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, 'migration 2025_11_06_000001_alter_live_chat_add_sender_read', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_chat` int(11) DEFAULT NULL,
  `id_beli_matkul` int(11) DEFAULT NULL,
  `id_wishlist_kelas` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `angkatan` int(11) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` tinyint(1) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_jurusan`, `id_chat`, `id_beli_matkul`, `id_wishlist_kelas`, `nama`, `password`, `email`, `no_hp`, `angkatan`, `tanggal_lahir`, `jenis_kelamin`, `foto_profil`, `otp`, `is_active`, `created_at`, `updated_at`, `username`, `remember_token`) VALUES
(1, 1, 1, 1, 1, 'Alya Nirmala', 'pass123', 'alya.nirmala@its.ac.id', 8132210001, 2023, '2005-03-12', 0, 'https://i.pravatar.cc/300?img=31', 771001, 1, '2025-11-06 08:39:17', '2025-11-06 08:44:51', '', NULL),
(2, 2, 2, 2, 2, 'Galang Aditya', 'pass123', 'galang.aditya@its.ac.id', 8132210002, 2022, '2004-07-18', 1, 'https://i.pravatar.cc/300?img=32', 771002, 1, '2025-11-06 08:39:17', '2025-11-06 08:44:51', '', NULL),
(3, 3, 5, 3, 3, 'Salwa Kirani', 'pass123', 'salwa.kirani@its.ac.id', 8132210003, 2023, '2005-01-27', 0, 'https://i.pravatar.cc/300?img=33', 771003, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(4, 4, 6, 5, NULL, 'Iqbal Naufal', 'pass123', 'iqbal.naufal@its.ac.id', 8132210004, 2022, '2004-12-09', 1, 'https://i.pravatar.cc/300?img=34', 771004, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(5, 5, 7, NULL, NULL, 'Nadia Zahra', 'pass123', 'nadia.zahra@its.ac.id', 8132210005, 2023, '2005-05-21', 0, 'https://i.pravatar.cc/300?img=35', 771005, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(6, 6, 8, 6, NULL, 'Davin Kurniawan', 'pass123', 'davin.kurniawan@its.ac.id', 8132210006, 2021, '2003-09-03', 1, 'https://i.pravatar.cc/300?img=36', 771006, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(7, 7, 9, 7, NULL, 'Amara Prameswari', 'pass123', 'amara.prame@its.ac.id', 8132210007, 2024, '2006-02-06', 0, 'https://i.pravatar.cc/300?img=37', 771007, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(8, 8, 10, 8, NULL, 'Yuda Mahendra', 'pass123', 'yuda.mahendra@its.ac.id', 8132210008, 2022, '2004-04-15', 1, 'https://i.pravatar.cc/300?img=38', 771008, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(9, 9, 11, 9, NULL, 'Naya Octavia', 'pass123', 'naya.octavia@its.ac.id', 8132210009, 2023, '2005-10-10', 0, 'https://i.pravatar.cc/300?img=39', 771009, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(10, 10, 12, 10, NULL, 'Reyhan Pratama', 'pass123', 'reyhan.pratama@its.ac.id', 8132210010, 2021, '2003-11-01', 1, 'https://i.pravatar.cc/300?img=40', 771010, 1, '2025-11-06 08:39:17', '2025-11-06 08:50:17', '', NULL),
(11, NULL, NULL, NULL, NULL, 'Ni Kadek Adelia Paramita Putri', '$2y$10$A96PRRuZHlyrN7hKrXD5/etLHAcjMcR1WwmVergtTe7vfB7eL51ea', 'adeliaparamitaptri@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-11-06 02:17:13', '2025-11-06 02:17:13', '', NULL),
(12, NULL, NULL, NULL, NULL, 'Siapa aja boleh', '$2y$10$2ebHRdgR5slOJgntjA8AUOq67vqew1nFNrhS93dDbaz56ejawyEvq', 'coba@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-06 02:20:14', '2025-11-06 02:20:31', '', NULL),
(13, NULL, NULL, NULL, NULL, 'coba', '$2y$10$t.QvHI8ncPUsK9ab4pgWC.uFOtFrEzjAHaPnPWjjK7hCLK2HiYNIu', 'hmm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-12 07:39:34', '2025-11-12 07:39:49', '', NULL),
(14, NULL, NULL, NULL, NULL, 'coba', '$2y$10$P8J4j0EbuuTrnm.6x5MKrellJ9nqbILAiUCWOEq/fDPjfzLKFkfr2', 'hmmm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-12 08:44:00', '2025-11-12 08:44:37', '', NULL),
(15, NULL, NULL, NULL, NULL, 'Zynt', '$2y$10$VfQmoZZC4dfBlTm0sPArGOWcz62Sw./FUH7VdPterQ1kVmFAkqN7q', 'hmmmm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-11-12 09:10:53', '2025-11-12 09:11:06', '', NULL),
(16, NULL, NULL, NULL, NULL, 'capepol', '$2y$10$Z1Ek4l1mddJWDSk6vXXlqObTVmHvxwoUTr8GVuM1H.zcSa7OQAY8K', 'capepol@gmail.com', NULL, NULL, NULL, NULL, NULL, 652, 0, '2025-11-12 10:15:34', '2025-11-12 10:15:34', NULL, NULL),
(17, 1, NULL, NULL, NULL, 'capepoll', '$2y$10$J9AMYZy8ckAdOLw.lDRJW.P4tBgaHCqYJnYZIkd7oWOCxa1soUTZG', 'capepoll@gmail.com', 85654343231, 2023, '1009-06-21', NULL, NULL, NULL, 1, '2025-11-12 10:16:33', '2025-11-12 10:30:31', 'capeplis', NULL),
(18, 1, NULL, NULL, NULL, 'Zynta', '$2y$10$zvLLVRDWcGrAMo8Rfhfc/.x3ymtCSYIS2gWSyf.NR6CfUHadrjvXW', 'zynt@gmail.com', 81222333444, 2023, '2009-06-21', NULL, NULL, NULL, 1, '2025-11-12 10:35:10', '2025-11-12 10:35:58', 'Zyntaaa', NULL),
(19, 2, NULL, NULL, NULL, 'Zyntaa', '$2y$10$arEDelAFVFLADonTuuBTG.Mpz.OFnthuQnojFEhPuXkKGdwonP.HC', 'zynta@gmail.com', 85123456777, 2023, '2006-12-12', NULL, NULL, NULL, 1, '2025-11-12 21:56:22', '2025-11-12 21:57:24', 'Zyntaaaaa', NULL),
(20, NULL, NULL, NULL, NULL, 'Fiqih', '$2y$10$AOoPE5eXlFjUW2v6MLRyBeWa6uUY1vw6ilmD.MJo58VrOh/3ApEiS', 'qifos.sda@gmail.com', NULL, NULL, NULL, NULL, NULL, 3726, 0, '2025-11-13 13:41:26', '2025-11-14 08:22:17', NULL, 'jMNJHS38OyA6pMtELDSYbOjTdb2BUJV2dU6bICdeuCTf2LYRb3ipOb3CGB6v');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `judul_video` varchar(150) NOT NULL,
  `deskripsi_video` text DEFAULT NULL,
  `isi_video` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `id_materi`, `judul_video`, `deskripsi_video`, `isi_video`, `created_at`, `updated_at`) VALUES
(1, 1, 'Video Pengantar SI', 'Video ringkas pengantar SI', 'link_video_1', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(2, 2, 'Video Struktur Data 1', 'Video array & linked list', 'link_video_2', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(3, 3, 'Video Elektronika 1', 'Video dioda & transistor', 'link_video_3', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(4, 4, 'Video Statistika 1', 'Video distribusi normal', 'link_video_4', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(5, 5, 'Video Data Science 1', 'Video pipeline data', 'link_video_5', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(6, 6, 'Video Arkom 1', 'Intro Arsitektur Komputer', 'link_video_6', '2025-11-06 08:44:51', '2025-11-06 08:44:51'),
(7, 7, 'Video Materi Otomatis — Perencanaan Produksi', 'Auto video untuk Materi Otomatis — Perencanaan Produksi', 'link_auto_video_7', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(8, 8, 'Video Materi Otomatis — Mekanika Teknik', 'Auto video untuk Materi Otomatis — Mekanika Teknik', 'link_auto_video_8', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(9, 9, 'Video Materi Otomatis — Mekanika Fluida', 'Auto video untuk Materi Otomatis — Mekanika Fluida', 'link_auto_video_9', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(10, 10, 'Video Materi Otomatis — Instrumentasi', 'Auto video untuk Materi Otomatis — Instrumentasi', 'link_auto_video_10', '2025-11-06 08:50:17', '2025-11-06 08:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_kelas`
--

CREATE TABLE `wishlist_kelas` (
  `id_wishlist_kelas` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `tanggal_wishlist` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist_kelas`
--

INSERT INTO `wishlist_kelas` (`id_wishlist_kelas`, `id_user`, `id_kelas`, `tanggal_wishlist`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-11-07', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(2, 2, 1, '2025-11-07', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(3, 3, 5, '2025-11-08', '2025-11-06 08:39:17', '2025-11-06 08:39:17'),
(4, 3, 3, '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(5, 4, 4, '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17'),
(6, 6, 6, '2025-11-06', '2025-11-06 08:50:17', '2025-11-06 08:50:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli_matkul`
--
ALTER TABLE `beli_matkul`
  ADD PRIMARY KEY (`id_beli_matkul`),
  ADD KEY `fk_beli_matkul` (`id_matkul`),
  ADD KEY `fk_beli_user` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_jadwal_kelas` (`id_kelas`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD KEY `fk_jurusan_mentor` (`id_mentor`),
  ADD KEY `fk_jurusan_user` (`id_user`),
  ADD KEY `fk_jurusan_matkul` (`id_matkul`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `fk_kelas_matkul` (`id_matkul`),
  ADD KEY `fk_kelas_jadwal` (`id_jadwal`),
  ADD KEY `fk_kelas_materi` (`id_materi`),
  ADD KEY `fk_kelas_wishlist` (`id_wishlist_kelas`);

--
-- Indexes for table `live_chat`
--
ALTER TABLE `live_chat`
  ADD PRIMARY KEY (`id_live_chat`),
  ADD KEY `fk_livechat_mentor` (`id_mentor`),
  ADD KEY `fk_livechat_user` (`id_user`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `fk_materi_video` (`id_video`),
  ADD KEY `fk_materi_kelas` (`id_kelas`),
  ADD KEY `fk_materi_matkul` (`id_matkul`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`),
  ADD KEY `fk_matkul_mentor` (`id_mentor`),
  ADD KEY `fk_matkul_materi` (`id_materi`),
  ADD KEY `fk_matkul_jurusan` (`id_jurusan`),
  ADD KEY `fk_matkul_kelas` (`id_kelas`),
  ADD KEY `fk_matkul_beli` (`id_beli_matkul`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id_mentor`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_mentor_jurusan` (`id_jurusan`),
  ADD KEY `fk_mentor_matkul` (`id_matkul`),
  ADD KEY `fk_mentor_chat` (`id_chat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_jurusan` (`id_jurusan`),
  ADD KEY `fk_user_chat` (`id_chat`),
  ADD KEY `fk_user_beli_matkul` (`id_beli_matkul`),
  ADD KEY `fk_user_wishlist` (`id_wishlist_kelas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `fk_video_materi` (`id_materi`);

--
-- Indexes for table `wishlist_kelas`
--
ALTER TABLE `wishlist_kelas`
  ADD PRIMARY KEY (`id_wishlist_kelas`),
  ADD KEY `fk_wishlist_user` (`id_user`),
  ADD KEY `fk_wishlist_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli_matkul`
--
ALTER TABLE `beli_matkul`
  MODIFY `id_beli_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `live_chat`
--
ALTER TABLE `live_chat`
  MODIFY `id_live_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id_mentor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist_kelas`
--
ALTER TABLE `wishlist_kelas`
  MODIFY `id_wishlist_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli_matkul`
--
ALTER TABLE `beli_matkul`
  ADD CONSTRAINT `fk_beli_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beli_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `fk_jurusan_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jurusan_mentor` FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id_mentor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jurusan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_kelas_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelas_materi` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelas_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kelas_wishlist` FOREIGN KEY (`id_wishlist_kelas`) REFERENCES `wishlist_kelas` (`id_wishlist_kelas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `live_chat`
--
ALTER TABLE `live_chat`
  ADD CONSTRAINT `fk_livechat_mentor` FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id_mentor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_livechat_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_materi_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_materi_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_materi_video` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `fk_matkul_beli` FOREIGN KEY (`id_beli_matkul`) REFERENCES `beli_matkul` (`id_beli_matkul`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matkul_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matkul_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matkul_materi` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matkul_mentor` FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id_mentor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `mentor`
--
ALTER TABLE `mentor`
  ADD CONSTRAINT `fk_mentor_chat` FOREIGN KEY (`id_chat`) REFERENCES `live_chat` (`id_live_chat`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mentor_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mentor_matkul` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id_matkul`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_beli_matkul` FOREIGN KEY (`id_beli_matkul`) REFERENCES `beli_matkul` (`id_beli_matkul`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_chat` FOREIGN KEY (`id_chat`) REFERENCES `live_chat` (`id_live_chat`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_wishlist` FOREIGN KEY (`id_wishlist_kelas`) REFERENCES `wishlist_kelas` (`id_wishlist_kelas`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `fk_video_materi` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `wishlist_kelas`
--
ALTER TABLE `wishlist_kelas`
  ADD CONSTRAINT `fk_wishlist_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
