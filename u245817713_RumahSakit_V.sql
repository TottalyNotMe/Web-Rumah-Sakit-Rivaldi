-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 14 Okt 2026 pada 09.22
-- Versi server: 11.8.9-MariaDB-log
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u245817713_RumahSakit_V`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `booking_code` varchar(20) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `queue_number` varchar(10) DEFAULT NULL,
  `status` enum('PENDING','CONFIRMED','CHECKED-IN','COMPLETED','CANCELLED') DEFAULT 'PENDING',
  `complaint` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `appointments`
--

INSERT INTO `appointments` (`id`, `booking_code`, `patient_id`, `doctor_id`, `schedule_id`, `appointment_date`, `queue_number`, `status`, `complaint`, `created_at`) VALUES
(1, 'BK-260001', 1, 1, 1, '2026-10-13', 'A1', 'CONFIRMED', 'Sakit di bagian dada', '2026-09-30 02:33:48'),
(2, 'BK-260002', 2, 2, 2, '2026-10-01', 'A2', 'COMPLETED', 'Sakit di bagian kaki', '2026-09-30 02:33:48'),
(3, 'BK-260003', 3, 3, 3, '2026-10-28', 'A3', 'CONFIRMED', 'Sakit di bagian tangan', '2026-09-30 02:33:48'),
(4, 'BK-260004', 4, 4, 4, '2026-10-13', 'A4', 'PENDING', 'Sakit di bagian perut', '2026-09-30 02:33:48'),
(5, 'BK-260005', 5, 5, 5, '2026-10-02', 'A5', 'CONFIRMED', 'Sakit di bagian perut', '2026-09-30 02:33:48'),
(6, 'BK-260006', 6, 6, 6, '2026-10-04', 'A6', 'PENDING', 'Sakit di bagian dada', '2026-09-30 02:33:48'),
(7, 'BK-260007', 7, 7, 7, '2026-10-02', 'A7', 'COMPLETED', 'Sakit di bagian dada', '2026-09-30 02:33:48'),
(8, 'BK-260008', 8, 8, 8, '2026-10-10', 'A8', 'PENDING', 'Sakit di bagian kaki', '2026-09-30 02:33:48'),
(9, 'BK-260009', 9, 9, 9, '2026-10-09', 'A9', 'CONFIRMED', 'Sakit di bagian kaki', '2026-09-30 02:33:48'),
(10, 'BK-260010', 10, 10, 10, '2026-10-07', 'A10', 'CONFIRMED', 'Sakit di bagian kaki', '2026-09-30 02:33:48'),
(11, 'BK-260011', 11, 11, 11, '2026-10-29', 'A11', 'PENDING', 'Sakit di bagian perut', '2026-09-30 02:33:48'),
(12, 'BK-260012', 12, 12, 12, '2026-10-26', 'A12', 'COMPLETED', 'Sakit di bagian tangan', '2026-09-30 02:33:48'),
(13, 'BK-260013', 13, 13, 13, '2026-10-01', 'A13', 'CONFIRMED', 'Sakit di bagian kepala', '2026-09-30 02:33:48'),
(14, 'BK-260014', 14, 14, 14, '2026-10-17', 'A14', 'COMPLETED', 'Sakit di bagian kepala', '2026-09-30 02:33:48'),
(15, 'BK-260015', 15, 15, 15, '2026-10-17', 'A15', 'PENDING', 'Sakit di bagian kepala', '2026-09-30 02:33:48'),
(16, 'BK-260016', 16, 16, 16, '2026-10-17', 'A16', 'CONFIRMED', 'Sakit di bagian tangan', '2026-09-30 02:33:48'),
(17, 'BK-260017', 17, 17, 17, '2026-10-15', 'A17', 'CONFIRMED', 'Sakit di bagian kepala', '2026-09-30 02:33:48'),
(18, 'BK-260018', 18, 18, 18, '2026-10-16', 'A18', 'COMPLETED', 'Sakit di bagian dada', '2026-09-30 02:33:48'),
(19, 'BK-260019', 19, 19, 19, '2026-10-02', 'A19', 'PENDING', 'Sakit di bagian dada', '2026-09-30 02:33:48'),
(20, 'BK-260020', 20, 20, 20, '2026-10-08', 'A20', 'COMPLETED', 'Sakit di bagian tangan', '2026-09-30 02:33:48'),
(21, 'BK2026100267121', 21, 12, NULL, '2026-10-02', 'Q-001', 'PENDING', 'sesak napas', '2026-09-30 02:36:32'),
(22, 'BK2026093082922', 22, 3, NULL, '2026-09-30', 'Q-001', 'PENDING', 'a', '2026-09-30 02:51:35'),
(23, 'BK2026100667723', 23, 20, NULL, '2026-10-06', 'Q-001', 'PENDING', 'awwww sakkiittt', '2026-10-06 01:27:16'),
(24, 'BK2026101187425', 25, 21, NULL, '2026-10-11', 'Q-001', 'PENDING', 'uhukk uhukkk sakit pak lemas', '2026-10-10 08:40:50'),
(25, 'BK2026101064225', 25, 21, NULL, '2026-10-10', 'Q-001', 'COMPLETED', '', '2026-10-10 08:41:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `phone`, `email`, `category`, `message`, `created_at`) VALUES
(1, 'm rb', '08954423823', 'ryubellriver@gmail.com', 'Info Pendaftaran', 'test', '2026-10-14 09:19:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diseases`
--

CREATE TABLE `diseases` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `diseases`
--

INSERT INTO `diseases` (`id`, `name`, `category`, `description`) VALUES
(1, 'Kanker', 'Onkologi', 'Kategori simulasi untuk perawatan pasien kanker (kemoterapi & konsultasi spesialis).'),
(2, 'Demam Berdarah Dengue (DBD)', 'Infeksi', 'Kategori simulasi untuk perawatan pasien demam berdarah (pantau trombosit & cairan infus).'),
(3, 'Penyakit Jantung Koroner', 'Kardiologi', 'Kategori simulasi untuk pasien dengan gangguan jantung (EKG, CT Scan, obat jantung).'),
(4, 'Diabetes Mellitus', 'Endokrinologi', 'Kategori simulasi untuk pasien diabetes (pantau gula darah, fungsi ginjal, obat diabetes).'),
(5, 'Operasi Usus Buntu (Apendiktomi)', 'Bedah Umum', 'Kategori simulasi untuk pasien pascaoperasi usus buntu (tindakan bedah, rawat inap, bahan medis).');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disease_services`
--

CREATE TABLE `disease_services` (
  `disease_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `default_qty` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `disease_services`
--

INSERT INTO `disease_services` (`disease_id`, `service_id`, `default_qty`) VALUES
(1, 2, 2),
(1, 3, 1),
(1, 4, 1),
(1, 7, 1),
(1, 8, 5),
(1, 9, 2),
(1, 10, 2),
(2, 2, 1),
(2, 3, 3),
(2, 7, 1),
(2, 8, 4),
(2, 16, 1),
(3, 2, 2),
(3, 3, 1),
(3, 6, 1),
(3, 7, 1),
(3, 8, 3),
(3, 11, 1),
(3, 14, 1),
(4, 2, 1),
(4, 4, 1),
(4, 7, 1),
(4, 8, 3),
(4, 12, 3),
(4, 15, 1),
(5, 2, 1),
(5, 3, 1),
(5, 7, 1),
(5, 8, 3),
(5, 9, 1),
(5, 13, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `poly_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `poly_id`, `full_name`, `specialty`, `fee`, `status`, `created_at`) VALUES
(1, 21, 1, 'Dr. Tirta', 'Spesialis Umum', 250000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(2, 22, 2, 'Dr. Boyke', 'Spesialis Gigi', 300000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(3, 23, 3, 'Dr. Reisa Broto Asmoro', 'Spesialis Anak', 150000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(4, 24, 4, 'Dr. Tompi', 'Spesialis Kandungan', 250000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(5, 25, 5, 'Dr. Lie Dharmawan', 'Spesialis Penyakit Dalam', 200000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(6, 26, 6, 'Dr. Terawan', 'Spesialis Bedah', 200000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(7, 27, 7, 'Dr. Sonia Wibisono', 'Spesialis Mata', 200000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(8, 28, 8, 'Dr. Ryan Thamrin', 'Spesialis THT', 150000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(9, 29, 9, 'Dr. Lula Kamal', 'Spesialis Saraf', 300000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(10, 30, 10, 'Dr. Nyoman', 'Spesialis Kulit dan Kelamin', 200000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(11, 31, 11, 'Dr. Andi', 'Spesialis Jantung', 300000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(12, 32, 12, 'Dr. Budi', 'Spesialis Paru', 300000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(13, 33, 13, 'Dr. Cipto', 'Spesialis Ortopedi', 200000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(14, 34, 14, 'Dr. Danang', 'Spesialis Psikiatri', 250000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(15, 35, 15, 'Dr. Eka', 'Spesialis Gizi', 200000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(16, 36, 16, 'Dr. Faisal', 'Spesialis Fisioterapi', 150000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(17, 37, 17, 'Dr. Gita', 'Spesialis Urologi', 250000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(18, 38, 18, 'Dr. Hari', 'Spesialis Onkologi', 150000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(19, 39, 19, 'Dr. Ika', 'Spesialis Rehabilitasi Medik', 150000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(20, 40, 20, 'Dr. Junaedi', 'Spesialis Estetika', 150000.00, 'ACTIVE', '2026-09-30 02:33:48'),
(21, 43, 1, 'dr. didi', 'Umum', 100006.00, 'ACTIVE', '2026-10-10 08:32:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `quota` int(11) NOT NULL DEFAULT 20,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doctor_schedules`
--

INSERT INTO `doctor_schedules` (`id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`, `quota`, `created_at`) VALUES
(1, 1, 'Monday', '08:00:00', '14:00:00', 20, '2026-09-30 02:33:48'),
(2, 2, 'Wednesday', '08:00:00', '14:00:00', 26, '2026-09-30 02:33:48'),
(3, 3, 'Saturday', '08:00:00', '14:00:00', 28, '2026-09-30 02:33:48'),
(4, 4, 'Thursday', '08:00:00', '14:00:00', 16, '2026-09-30 02:33:48'),
(5, 5, 'Wednesday', '08:00:00', '14:00:00', 25, '2026-09-30 02:33:48'),
(6, 6, 'Tuesday', '08:00:00', '14:00:00', 29, '2026-09-30 02:33:48'),
(7, 7, 'Tuesday', '08:00:00', '14:00:00', 18, '2026-09-30 02:33:48'),
(8, 8, 'Tuesday', '08:00:00', '14:00:00', 20, '2026-09-30 02:33:48'),
(9, 9, 'Tuesday', '08:00:00', '14:00:00', 30, '2026-09-30 02:33:48'),
(10, 10, 'Tuesday', '08:00:00', '14:00:00', 28, '2026-09-30 02:33:48'),
(11, 11, 'Saturday', '08:00:00', '14:00:00', 19, '2026-09-30 02:33:48'),
(12, 12, 'Thursday', '08:00:00', '14:00:00', 22, '2026-09-30 02:33:48'),
(13, 13, 'Saturday', '08:00:00', '14:00:00', 25, '2026-09-30 02:33:48'),
(14, 14, 'Monday', '08:00:00', '14:00:00', 19, '2026-09-30 02:33:48'),
(15, 15, 'Monday', '08:00:00', '14:00:00', 20, '2026-09-30 02:33:48'),
(16, 16, 'Thursday', '08:00:00', '14:00:00', 16, '2026-09-30 02:33:48'),
(17, 17, 'Saturday', '08:00:00', '14:00:00', 21, '2026-09-30 02:33:48'),
(18, 18, 'Monday', '08:00:00', '14:00:00', 27, '2026-09-30 02:33:48'),
(19, 19, 'Thursday', '08:00:00', '14:00:00', 24, '2026-09-30 02:33:48'),
(20, 20, 'Thursday', '08:00:00', '14:00:00', 18, '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `capacity_info` varchar(50) DEFAULT NULL,
  `status_dummy` varchar(50) DEFAULT 'Tersedia',
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `facilities`
--

INSERT INTO `facilities` (`id`, `category`, `name`, `description`, `image_path`, `capacity_info`, `status_dummy`, `is_active`) VALUES
(1, 'Ruang Rawat', 'Gedung Teratai (Rawat Inap)', 'Fasilitas rawat inap komprehensif dari Kelas III hingga VIP.', 'assets/images/infrastructure/rawat-inap.jpg', '120 Tempat Tidur', 'Tersedia', 1),
(2, 'IGD', 'Instalasi Gawat Darurat 24 Jam', 'Penanganan cepat untuk kondisi kritis dan darurat medis.', 'assets/images/infrastructure/igd.jpg', '15 Bed Triage', 'Tersedia', 1),
(3, 'Laboratorium', 'Laboratorium Patologi Klinik', 'Layanan tes darah, urine, dan cairan tubuh lainnya.', 'assets/images/infrastructure/lab.jpg', '5 Mesin Analisa', 'Tersedia', 1),
(4, 'Radiologi', 'Instalasi Radiologi', 'Pemeriksaan CT Scan, MRI, dan X-Ray.', 'assets/images/infrastructure/radiologi.jpg', '3 Ruangan', 'Dalam Pemeliharaan (CT Scan)', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inpatient_admissions`
--

CREATE TABLE `inpatient_admissions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `diagnosis` text DEFAULT NULL,
  `admission_date` date NOT NULL,
  `discharge_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `inpatient_admissions`
--

INSERT INTO `inpatient_admissions` (`id`, `patient_id`, `room_id`, `doctor_id`, `diagnosis`, `admission_date`, `discharge_date`, `created_at`) VALUES
(1, 1, 1, 1, 'Observasi ketat', '2026-09-10', '2026-09-24', '2026-09-30 02:33:48'),
(2, 2, 2, 2, 'Observasi ketat', '2026-09-19', '2026-09-22', '2026-09-30 02:33:48'),
(3, 3, 3, 3, 'Tifus', '2026-09-09', '2026-09-22', '2026-09-30 02:33:48'),
(4, 4, 4, 4, 'Observasi ketat', '2026-09-16', '2026-09-28', '2026-09-30 02:33:48'),
(5, 5, 5, 5, 'Observasi ketat', '2026-09-03', '2026-09-22', '2026-09-30 02:33:48'),
(6, 6, 6, 6, 'Demam Berdarah', '2026-09-06', '2026-09-28', '2026-09-30 02:33:48'),
(7, 7, 7, 7, 'Observasi ketat', '2026-09-05', '2026-09-22', '2026-09-30 02:33:48'),
(8, 8, 8, 8, 'Observasi ketat', '2026-09-18', '2026-09-23', '2026-09-30 02:33:48'),
(9, 9, 9, 9, 'Observasi ketat', '2026-09-06', '2026-09-27', '2026-09-30 02:33:48'),
(10, 10, 10, 10, 'Observasi ketat', '2026-09-15', '2026-09-25', '2026-09-30 02:33:48'),
(11, 11, 11, 11, 'Observasi ketat', '2026-09-15', '2026-09-24', '2026-09-30 02:33:48'),
(12, 12, 12, 12, 'Maag Akut', '2026-09-14', '2026-09-26', '2026-09-30 02:33:48'),
(13, 13, 13, 13, 'Observasi ketat', '2026-09-20', '2026-09-29', '2026-09-30 02:33:48'),
(14, 14, 14, 14, 'Observasi ketat', '2026-09-19', '2026-09-21', '2026-09-30 02:33:48'),
(15, 15, 15, 15, 'Observasi ketat', '2026-09-10', '2026-09-28', '2026-09-30 02:33:48'),
(16, 16, 16, 16, 'Observasi ketat', '2026-09-02', '2026-09-28', '2026-09-30 02:33:48'),
(17, 17, 17, 17, 'Observasi ketat', '2026-09-14', '2026-09-23', '2026-09-30 02:33:48'),
(18, 18, 18, 18, 'Observasi ketat', '2026-09-08', '2026-09-26', '2026-09-30 02:33:48'),
(19, 19, 19, 19, 'Tifus', '2026-09-09', '2026-09-25', '2026-09-30 02:33:48'),
(20, 20, 20, 20, 'Observasi ketat', '2026-09-08', '2026-09-23', '2026-09-30 02:33:48'),
(21, 25, 1, 21, 'anda mendapat penyakit mental', '2026-10-10', NULL, '2026-10-10 08:42:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `admission_id` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('PENDING','PAID','FAILED','CANCELLED') DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `patient_id`, `appointment_id`, `admission_id`, `subtotal`, `discount`, `tax`, `total_amount`, `status`, `created_at`) VALUES
(1, 'INV-2026-0001', 1, 1, 1, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(2, 'INV-2026-0002', 2, 2, 2, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(3, 'INV-2026-0003', 3, 3, 3, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(4, 'INV-2026-0004', 4, 4, 4, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(5, 'INV-2026-0005', 5, 5, 5, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(6, 'INV-2026-0006', 6, 6, 6, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(7, 'INV-2026-0007', 7, 7, 7, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(8, 'INV-2026-0008', 8, 8, 8, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(9, 'INV-2026-0009', 9, 9, 9, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(10, 'INV-2026-0010', 10, 10, 10, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(11, 'INV-2026-0011', 11, 11, 11, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(12, 'INV-2026-0012', 12, 12, 12, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(13, 'INV-2026-0013', 13, 13, 13, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(14, 'INV-2026-0014', 14, 14, 14, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(15, 'INV-2026-0015', 15, 15, 15, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(16, 'INV-2026-0016', 16, 16, 16, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(17, 'INV-2026-0017', 17, 17, 17, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(18, 'INV-2026-0018', 18, 18, 18, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(19, 'INV-2026-0019', 19, 19, 19, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48'),
(20, 'INV-2026-0020', 20, 20, 20, 500000.00, 0.00, 50000.00, 550000.00, 'PAID', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `item_name`, `quantity`, `price`, `total_price`, `created_at`) VALUES
(1, 1, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(2, 2, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(3, 3, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(4, 4, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(5, 5, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(6, 6, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(7, 7, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(8, 8, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(9, 9, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(10, 10, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(11, 11, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(12, 12, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(13, 13, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(14, 14, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(15, 15, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(16, 16, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(17, 17, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(18, 18, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(19, 19, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48'),
(20, 20, 'Konsultasi Dokter dan Obat', 1, 500000.00, 500000.00, '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab_results`
--

CREATE TABLE `lab_results` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `lab_test_id` int(11) NOT NULL,
  `result_text` text DEFAULT NULL,
  `status` enum('ORDERED','PROCESSING','COMPLETED','CANCELLED') DEFAULT 'ORDERED',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lab_results`
--

INSERT INTO `lab_results` (`id`, `patient_id`, `doctor_id`, `appointment_id`, `lab_test_id`, `result_text`, `status`, `created_at`) VALUES
(1, 1, 1, 1, 1, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(2, 2, 2, 2, 2, 'Gula darah sedikit tinggi', 'COMPLETED', '2026-09-30 02:33:48'),
(3, 3, 3, 3, 3, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(4, 4, 4, 4, 4, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(5, 5, 5, 5, 5, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(6, 6, 6, 6, 6, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(7, 7, 7, 7, 7, 'Ada peningkatan enzim hati', 'COMPLETED', '2026-09-30 02:33:48'),
(8, 8, 8, 8, 8, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(9, 9, 9, 9, 9, 'Positif', 'COMPLETED', '2026-09-30 02:33:48'),
(10, 10, 10, 10, 10, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(11, 11, 11, 11, 11, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(12, 12, 12, 12, 12, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(13, 13, 13, 13, 13, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(14, 14, 14, 14, 14, 'Negatif', 'COMPLETED', '2026-09-30 02:33:48'),
(15, 15, 15, 15, 15, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(16, 16, 16, 16, 16, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(17, 17, 17, 17, 17, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(18, 18, 18, 18, 18, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(19, 19, 19, 19, 19, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48'),
(20, 20, 20, 20, 20, 'Hasil normal, tidak ada kelainan', 'COMPLETED', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lab_tests`
--

CREATE TABLE `lab_tests` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lab_tests`
--

INSERT INTO `lab_tests` (`id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 'Cek Darah Lengkap', 'Pemeriksaan cek darah lengkap', 290000.00, '2026-09-30 02:33:48'),
(2, 'Gula Darah Puasa', 'Pemeriksaan gula darah puasa', 490000.00, '2026-09-30 02:33:48'),
(3, 'Kolesterol Total', 'Pemeriksaan kolesterol total', 340000.00, '2026-09-30 02:33:48'),
(4, 'Asam Urat', 'Pemeriksaan asam urat', 380000.00, '2026-09-30 02:33:48'),
(5, 'Urine Lengkap', 'Pemeriksaan urine lengkap', 450000.00, '2026-09-30 02:33:48'),
(6, 'Feses Lengkap', 'Pemeriksaan feses lengkap', 100000.00, '2026-09-30 02:33:48'),
(7, 'Fungsi Hati (SGOT/SGPT)', 'Pemeriksaan fungsi hati (sgot/sgpt)', 490000.00, '2026-09-30 02:33:48'),
(8, 'Fungsi Ginjal (Ureum/Kreatinin)', 'Pemeriksaan fungsi ginjal (ureum/kreatinin)', 80000.00, '2026-09-30 02:33:48'),
(9, 'Tes Kehamilan', 'Pemeriksaan tes kehamilan', 220000.00, '2026-09-30 02:33:48'),
(10, 'Golongan Darah', 'Pemeriksaan golongan darah', 410000.00, '2026-09-30 02:33:48'),
(11, 'HbA1c', 'Pemeriksaan hba1c', 410000.00, '2026-09-30 02:33:48'),
(12, 'Widal', 'Pemeriksaan widal', 160000.00, '2026-09-30 02:33:48'),
(13, 'Dengue NS1', 'Pemeriksaan dengue ns1', 350000.00, '2026-09-30 02:33:48'),
(14, 'Swab Antigen', 'Pemeriksaan swab antigen', 410000.00, '2026-09-30 02:33:48'),
(15, 'PCR', 'Pemeriksaan pcr', 350000.00, '2026-09-30 02:33:48'),
(16, 'Rontgen Thorax', 'Pemeriksaan rontgen thorax', 50000.00, '2026-09-30 02:33:48'),
(17, 'USG Abdomen', 'Pemeriksaan usg abdomen', 270000.00, '2026-09-30 02:33:48'),
(18, 'EKG', 'Pemeriksaan ekg', 60000.00, '2026-09-30 02:33:48'),
(19, 'Pap Smear', 'Pemeriksaan pap smear', 270000.00, '2026-09-30 02:33:48'),
(20, 'Bilirubin', 'Pemeriksaan bilirubin', 110000.00, '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `medical_records`
--

CREATE TABLE `medical_records` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `complaint` text DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `heart_rate` int(11) DEFAULT NULL,
  `temperature` decimal(4,1) DEFAULT NULL,
  `weight` decimal(5,1) DEFAULT NULL,
  `height` decimal(5,1) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `medical_records`
--

INSERT INTO `medical_records` (`id`, `patient_id`, `doctor_id`, `appointment_id`, `complaint`, `blood_pressure`, `heart_rate`, `temperature`, `weight`, `height`, `diagnosis`, `treatment`, `notes`, `created_at`) VALUES
(1, 1, 1, 1, 'Sakit', '120/80', 84, 36.8, 89.0, 178.0, 'Diagnosis 1', 'Perawatan 1', 'Istirahat cukup', '2026-09-30 02:33:48'),
(2, 2, 2, 2, 'Sakit', '120/80', 67, 36.8, 74.0, 158.0, 'Diagnosis 2', 'Perawatan 2', 'Istirahat cukup', '2026-09-30 02:33:48'),
(3, 3, 3, 3, 'Sakit', '120/80', 96, 36.9, 51.0, 159.0, 'Diagnosis 3', 'Perawatan 3', 'Istirahat cukup', '2026-09-30 02:33:48'),
(4, 4, 4, 4, 'Sakit', '120/80', 88, 36.9, 75.0, 176.0, 'Diagnosis 4', 'Perawatan 4', 'Istirahat cukup', '2026-09-30 02:33:48'),
(5, 5, 5, 5, 'Sakit', '120/80', 100, 36.9, 70.0, 177.0, 'Diagnosis 5', 'Perawatan 5', 'Istirahat cukup', '2026-09-30 02:33:48'),
(6, 6, 6, 6, 'Sakit', '120/80', 93, 36.4, 59.0, 175.0, 'Diagnosis 6', 'Perawatan 6', 'Istirahat cukup', '2026-09-30 02:33:48'),
(7, 7, 7, 7, 'Sakit', '120/80', 65, 36.6, 80.0, 150.0, 'Diagnosis 7', 'Perawatan 7', 'Istirahat cukup', '2026-09-30 02:33:48'),
(8, 8, 8, 8, 'Sakit', '120/80', 80, 36.5, 72.0, 163.0, 'Diagnosis 8', 'Perawatan 8', 'Istirahat cukup', '2026-09-30 02:33:48'),
(9, 9, 9, 9, 'Sakit', '120/80', 68, 36.7, 82.0, 164.0, 'Diagnosis 9', 'Perawatan 9', 'Istirahat cukup', '2026-09-30 02:33:48'),
(10, 10, 10, 10, 'Sakit', '120/80', 77, 36.4, 82.0, 163.0, 'Diagnosis 10', 'Perawatan 10', 'Istirahat cukup', '2026-09-30 02:33:48'),
(11, 11, 11, 11, 'Sakit', '120/80', 73, 36.2, 53.0, 154.0, 'Diagnosis 11', 'Perawatan 11', 'Istirahat cukup', '2026-09-30 02:33:48'),
(12, 12, 12, 12, 'Sakit', '120/80', 73, 36.7, 69.0, 155.0, 'Diagnosis 12', 'Perawatan 12', 'Istirahat cukup', '2026-09-30 02:33:48'),
(13, 13, 13, 13, 'Sakit', '120/80', 64, 36.9, 90.0, 164.0, 'Diagnosis 13', 'Perawatan 13', 'Istirahat cukup', '2026-09-30 02:33:48'),
(14, 14, 14, 14, 'Sakit', '120/80', 76, 36.3, 67.0, 168.0, 'Diagnosis 14', 'Perawatan 14', 'Istirahat cukup', '2026-09-30 02:33:48'),
(15, 15, 15, 15, 'Sakit', '120/80', 80, 36.5, 65.0, 151.0, 'Diagnosis 15', 'Perawatan 15', 'Istirahat cukup', '2026-09-30 02:33:48'),
(16, 16, 16, 16, 'Sakit', '120/80', 71, 36.2, 55.0, 177.0, 'Diagnosis 16', 'Perawatan 16', 'Istirahat cukup', '2026-09-30 02:33:48'),
(17, 17, 17, 17, 'Sakit', '120/80', 61, 36.9, 74.0, 168.0, 'Diagnosis 17', 'Perawatan 17', 'Istirahat cukup', '2026-09-30 02:33:48'),
(18, 18, 18, 18, 'Sakit', '120/80', 66, 36.7, 83.0, 162.0, 'Diagnosis 18', 'Perawatan 18', 'Istirahat cukup', '2026-09-30 02:33:48'),
(19, 19, 19, 19, 'Sakit', '120/80', 98, 36.5, 70.0, 176.0, 'Diagnosis 19', 'Perawatan 19', 'Istirahat cukup', '2026-09-30 02:33:48'),
(20, 20, 20, 20, 'Sakit', '120/80', 82, 36.5, 80.0, 170.0, 'Diagnosis 20', 'Perawatan 20', 'Istirahat cukup', '2026-09-30 02:33:48'),
(21, 25, 21, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'anda mendapat penyakit mental', 'saya saran anda memakan seratus anak bayi baru lahir', 'bertemu dengan angsa', '2026-10-10 08:42:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `medical_services`
--

CREATE TABLE `medical_services` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `medical_services`
--

INSERT INTO `medical_services` (`id`, `category`, `name`, `price`, `unit`, `is_active`) VALUES
(1, 'Konsultasi', 'Konsultasi Dokter Umum', 100000.00, 'per sesi', 1),
(2, 'Konsultasi', 'Konsultasi Dokter Spesialis', 250000.00, 'per sesi', 1),
(3, 'Laboratorium', 'Pemeriksaan Darah Lengkap', 150000.00, 'per pemeriksaan', 1),
(4, 'Laboratorium', 'Pemeriksaan Fungsi Ginjal', 200000.00, 'per pemeriksaan', 1),
(5, 'Radiologi', 'Radiologi Sederhana', 250000.00, 'per pemeriksaan', 1),
(6, 'Radiologi', 'CT Scan', 1500000.00, 'per pemeriksaan', 1),
(7, 'Administrasi', 'Administrasi Simulasi', 50000.00, 'per layanan', 1),
(8, 'Keperawatan', 'Layanan Keperawatan', 150000.00, 'per hari', 1),
(9, 'Bahan Medis', 'Bahan Medis', 100000.00, 'per paket', 1),
(10, 'Tindakan', 'Kemoterapi', 2500000.00, 'per sesi', 1),
(11, 'Penunjang', 'EKG (Rekam Jantung)', 150000.00, 'per pemeriksaan', 1),
(12, 'Laboratorium', 'Tes Gula Darah', 50000.00, 'per pemeriksaan', 1),
(13, 'Tindakan', 'Tindakan Bedah Sedang (Apendiktomi)', 7500000.00, 'per tindakan', 1),
(14, 'Farmasi', 'Paket Obat Jantung', 500000.00, 'per paket', 1),
(15, 'Farmasi', 'Paket Obat Diabetes', 300000.00, 'per paket', 1),
(16, 'Farmasi', 'Paket Obat & Cairan Infus (DBD)', 250000.00, 'per paket', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `type`, `price`, `stock`, `description`, `created_at`) VALUES
(1, 'Paracetamol 500mg', 'Tablet', 38000.00, 252, 'Obat penurun panas & anti-inflamasi', '2026-09-30 02:33:48'),
(2, 'Amoxicillin 500mg', 'Tablet', 16000.00, 346, 'Antibiotik lini pertama', '2026-09-30 02:33:48'),
(3, 'Ibuprofen 400mg', 'Tablet', 17000.00, 474, 'Obat pereda nyeri', '2026-09-30 02:33:48'),
(4, 'Omeprazole 20mg', 'Tablet', 6000.00, 153, 'Obat asam lambung', '2026-09-30 02:33:48'),
(5, 'Cetirizine 10mg', 'Tablet', 35000.00, 390, 'Obat anti-alergi', '2026-09-30 02:33:48'),
(6, 'Vitamin C 500mg', 'Tablet', 17000.00, 376, 'Suplemen vitamin C', '2026-09-30 02:33:48'),
(7, 'Amlodipine 5mg', 'Tablet', 21000.00, 361, 'Obat darah tinggi', '2026-09-30 02:33:48'),
(8, 'Metformin 500mg', 'Tablet', 44000.00, 150, 'Obat diabetes', '2026-09-30 02:33:48'),
(9, 'Simvastatin 10mg', 'Tablet', 15000.00, 435, 'Obat kolesterol', '2026-09-30 02:33:48'),
(10, 'Azithromycin 500mg', 'Tablet', 31000.00, 497, 'Antibiotik infeksi', '2026-09-30 02:33:48'),
(11, 'Cefadroxil 500mg', 'Tablet', 27000.00, 319, 'Antibiotik kulit & tenggorokan', '2026-09-30 02:33:48'),
(12, 'Lansoprazole 30mg', 'Tablet', 40000.00, 59, 'Obat maag akut', '2026-09-30 02:33:48'),
(13, 'Mefenamic Acid 500mg', 'Tablet', 11000.00, 91, 'Peradan nyeri gigi/otot', '2026-09-30 02:33:48'),
(14, 'Salbutamol 2mg', 'Tablet', 19000.00, 211, 'Obat sesak napas', '2026-09-30 02:33:48'),
(15, 'Loratadine 10mg', 'Tablet', 45000.00, 385, 'Obat gatal', '2026-09-30 02:33:48'),
(16, 'Dexamethasone 0.5mg', 'Tablet', 26000.00, 120, 'Obat kortikosteroid', '2026-09-30 02:33:48'),
(17, 'Antasida Doen', 'Tablet', 42000.00, 255, 'Sirup pencernaan', '2026-09-30 02:33:48'),
(18, 'Neurobion Forte', 'Tablet', 10000.00, 218, 'Vitamin B komplek', '2026-09-30 02:33:48'),
(19, 'Captopril 25mg', 'Tablet', 14000.00, 407, 'Obat penurun tekanan darah', '2026-09-30 02:33:48'),
(20, 'Allopurinol 100mg', 'Tablet', 7000.00, 469, 'Obat asam urat', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mrn` varchar(20) NOT NULL COMMENT 'Medical Record Number',
  `nik` varchar(20) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `insurance_provider` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `mrn`, `nik`, `full_name`, `birth_date`, `gender`, `address`, `phone`, `blood_group`, `insurance_provider`, `created_at`) VALUES
(1, 1, 'MR-2026-0001', '3277329126855203', 'Budi Santoso', '1965-05-17', 'M', 'Jl. Merdeka No 1', '081260973789', 'O', 'Umum', '2026-09-30 02:33:48'),
(2, 2, 'MR-2026-0002', '3278299475123488', 'Siti Aminah', '1950-09-08', 'F', 'Jl. Merdeka No 2', '081280447639', 'B', 'Allianz', '2026-09-30 02:33:48'),
(3, 3, 'MR-2026-0003', '3279714937049031', 'Andi Wijaya', '1958-02-01', 'M', 'Jl. Merdeka No 3', '081248984899', 'B', 'Allianz', '2026-09-30 02:33:48'),
(4, 4, 'MR-2026-0004', '3277733236233955', 'Dewi Lestari', '1986-05-23', 'F', 'Jl. Merdeka No 4', '081223179382', 'B', 'BPJS', '2026-09-30 02:33:48'),
(5, 5, 'MR-2026-0005', '3272286550741205', 'Rudi Hermawan', '1979-02-04', 'M', 'Jl. Merdeka No 5', '081296309194', 'A', 'Allianz', '2026-09-30 02:33:48'),
(6, 6, 'MR-2026-0006', '3274635909223902', 'Nina Marlina', '1978-03-15', 'F', 'Jl. Merdeka No 6', '081234761176', 'AB', 'Allianz', '2026-09-30 02:33:48'),
(7, 7, 'MR-2026-0007', '3276501001025849', 'Agus Setiawan', '1952-06-23', 'M', 'Jl. Merdeka No 7', '081220132918', 'O', 'Prudential', '2026-09-30 02:33:48'),
(8, 8, 'MR-2026-0008', '3272392443180938', 'Rini Yulianti', '1954-06-17', 'F', 'Jl. Merdeka No 8', '081253261230', 'AB', 'BPJS', '2026-09-30 02:33:48'),
(9, 9, 'MR-2026-0009', '3272325862339559', 'Eko Prasetyo', '1969-04-24', 'M', 'Jl. Merdeka No 9', '081296639342', 'AB', 'Prudential', '2026-09-30 02:33:48'),
(10, 10, 'MR-2026-0010', '3274583532503670', 'Maya Sari', '1985-10-14', 'F', 'Jl. Merdeka No 10', '081296053433', 'A', 'Mandiri Inhealth', '2026-09-30 02:33:48'),
(11, 11, 'MR-2026-0011', '3272367692623662', 'Hendra Gunawan', '1964-01-27', 'M', 'Jl. Merdeka No 11', '081224420174', 'A', 'Prudential', '2026-09-30 02:33:48'),
(12, 12, 'MR-2026-0012', '3274821637512872', 'Sri Rahayu', '1972-03-14', 'F', 'Jl. Merdeka No 12', '081237914822', 'AB', 'Allianz', '2026-09-30 02:33:48'),
(13, 13, 'MR-2026-0013', '3278692506004763', 'Iwan Fals', '1953-02-13', 'M', 'Jl. Merdeka No 13', '081248275331', 'AB', 'Umum', '2026-09-30 02:33:48'),
(14, 14, 'MR-2026-0014', '3276623909024326', 'Ratna Galih', '1954-02-23', 'F', 'Jl. Merdeka No 14', '081299432257', 'O', 'Mandiri Inhealth', '2026-09-30 02:33:48'),
(15, 15, 'MR-2026-0015', '3271779725573540', 'Joko Widodo', '1962-05-02', 'M', 'Jl. Merdeka No 15', '081243998459', 'B', 'Allianz', '2026-09-30 02:33:48'),
(16, 16, 'MR-2026-0016', '3276658276459660', 'Yuni Shara', '1966-04-02', 'F', 'Jl. Merdeka No 16', '081215903496', 'A', 'Allianz', '2026-09-30 02:33:48'),
(17, 17, 'MR-2026-0017', '3271083017750361', 'Arief Rachman', '1977-01-12', 'M', 'Jl. Merdeka No 17', '081249831234', 'A', 'Allianz', '2026-09-30 02:33:48'),
(18, 18, 'MR-2026-0018', '3274214794559588', 'Dian Sastro', '1982-03-05', 'F', 'Jl. Merdeka No 18', '081256192221', 'A', 'Mandiri Inhealth', '2026-09-30 02:33:48'),
(19, 19, 'MR-2026-0019', '3274594905621232', 'Doni Salmanan', '1965-03-15', 'M', 'Jl. Merdeka No 19', '081234539651', 'A', 'Allianz', '2026-09-30 02:33:48'),
(20, 20, 'MR-2026-0020', '3279454633964460', 'Ayu Tingting', '1957-02-10', 'F', 'Jl. Merdeka No 20', '081257547138', 'AB', 'Allianz', '2026-09-30 02:33:48'),
(21, 41, 'MR-2026-0041', '213123', 'rivaldi', NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-30 02:35:55'),
(22, 42, 'MR-2026-0042', '123', 'ha', NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-30 02:49:15'),
(23, 43, 'MR-2026-0043', '679', 'didi', NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-06 01:25:56'),
(24, 44, 'MR-2026-0044', '8885', 'TESTING DHAR', '2026-10-01', 'M', '123 sesame street', '66666666', 'AB', 'Asuransi Swasta', '2026-10-10 08:01:25'),
(25, 45, 'MR-2026-0045', '123132', 'sear', NULL, NULL, NULL, NULL, NULL, NULL, '2026-10-10 08:32:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payer_policies`
--

CREATE TABLE `payer_policies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('umum','asuransi','bpjs') NOT NULL,
  `coverage_percentage` decimal(5,2) DEFAULT 0.00,
  `max_plafon` decimal(15,2) DEFAULT 0.00,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `payer_policies`
--

INSERT INTO `payer_policies` (`id`, `name`, `type`, `coverage_percentage`, `max_plafon`, `notes`) VALUES
(1, 'Pembayaran Mandiri (Umum)', 'umum', 0.00, 0.00, 'Pasien menanggung 100% dari total estimasi biaya.'),
(2, 'Asuransi Swasta Prima (Dummy)', 'asuransi', 80.00, 20000000.00, 'Menanggung 80% dari total biaya dengan maksimal plafon 20 Juta.'),
(3, 'JKN / BPJS Kesehatan (Simulasi)', 'bpjs', 100.00, 0.00, 'Simulasi: Biaya ditanggung BPJS sesuai kelas hak rawat. Biaya di luar hak kelas dikenakan iur biaya (selisih).');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('PENDING','SUCCESS','FAILED') DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `amount`, `payment_method`, `status`, `created_at`) VALUES
(1, 1, 550000.00, 'Bank Transfer', 'SUCCESS', '2026-09-30 02:33:48'),
(2, 2, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(3, 3, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(4, 4, 550000.00, 'Cash', 'SUCCESS', '2026-09-30 02:33:48'),
(5, 5, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(6, 6, 550000.00, 'Bank Transfer', 'SUCCESS', '2026-09-30 02:33:48'),
(7, 7, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(8, 8, 550000.00, 'Credit Card', 'SUCCESS', '2026-09-30 02:33:48'),
(9, 9, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(10, 10, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(11, 11, 550000.00, 'Cash', 'SUCCESS', '2026-09-30 02:33:48'),
(12, 12, 550000.00, 'Cash', 'SUCCESS', '2026-09-30 02:33:48'),
(13, 13, 550000.00, 'Bank Transfer', 'SUCCESS', '2026-09-30 02:33:48'),
(14, 14, 550000.00, 'Cash', 'SUCCESS', '2026-09-30 02:33:48'),
(15, 15, 550000.00, 'Qris', 'SUCCESS', '2026-09-30 02:33:48'),
(16, 16, 550000.00, 'Bank Transfer', 'SUCCESS', '2026-09-30 02:33:48'),
(17, 17, 550000.00, 'Cash', 'SUCCESS', '2026-09-30 02:33:48'),
(18, 18, 550000.00, 'Credit Card', 'SUCCESS', '2026-09-30 02:33:48'),
(19, 19, 550000.00, 'Bank Transfer', 'SUCCESS', '2026-09-30 02:33:48'),
(20, 20, 550000.00, 'Cash', 'SUCCESS', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poly`
--

CREATE TABLE `poly` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `poly`
--

INSERT INTO `poly` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Poli Umum', 'Pelayanan spesialis Umum', '2026-09-30 02:33:48'),
(2, 'Poli Gigi', 'Pelayanan spesialis Gigi', '2026-09-30 02:33:48'),
(3, 'Poli Anak', 'Pelayanan spesialis Anak', '2026-09-30 02:33:48'),
(4, 'Poli Kandungan', 'Pelayanan spesialis Kandungan', '2026-09-30 02:33:48'),
(5, 'Poli Penyakit Dalam', 'Pelayanan spesialis Penyakit Dalam', '2026-09-30 02:33:48'),
(6, 'Poli Bedah', 'Pelayanan spesialis Bedah', '2026-09-30 02:33:48'),
(7, 'Poli Mata', 'Pelayanan spesialis Mata', '2026-09-30 02:33:48'),
(8, 'Poli THT', 'Pelayanan spesialis THT', '2026-09-30 02:33:48'),
(9, 'Poli Saraf', 'Pelayanan spesialis Saraf', '2026-09-30 02:33:48'),
(10, 'Poli Kulit dan Kelamin', 'Pelayanan spesialis Kulit dan Kelamin', '2026-09-30 02:33:48'),
(11, 'Poli Jantung', 'Pelayanan spesialis Jantung', '2026-09-30 02:33:48'),
(12, 'Poli Paru', 'Pelayanan spesialis Paru', '2026-09-30 02:33:48'),
(13, 'Poli Ortopedi', 'Pelayanan spesialis Ortopedi', '2026-09-30 02:33:48'),
(14, 'Poli Psikiatri', 'Pelayanan spesialis Psikiatri', '2026-09-30 02:33:48'),
(15, 'Poli Gizi', 'Pelayanan spesialis Gizi', '2026-09-30 02:33:48'),
(16, 'Poli Fisioterapi', 'Pelayanan spesialis Fisioterapi', '2026-09-30 02:33:48'),
(17, 'Poli Urologi', 'Pelayanan spesialis Urologi', '2026-09-30 02:33:48'),
(18, 'Poli Onkologi', 'Pelayanan spesialis Onkologi', '2026-09-30 02:33:48'),
(19, 'Poli Rehabilitasi Medik', 'Pelayanan spesialis Rehabilitasi Medik', '2026-09-30 02:33:48'),
(20, 'Poli Estetika', 'Pelayanan spesialis Estetika', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `medical_record_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `dosage` varchar(50) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `instructions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `medical_record_id`, `medicine_id`, `dosage`, `frequency`, `duration`, `quantity`, `instructions`, `created_at`) VALUES
(1, 1, 1, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(2, 2, 2, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(3, 3, 3, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(4, 4, 4, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(5, 5, 5, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(6, 6, 6, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(7, 7, 7, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(8, 8, 8, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(9, 9, 9, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(10, 10, 10, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(11, 11, 11, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(12, 12, 12, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(13, 13, 13, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(14, 14, 14, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(15, 15, 15, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(16, 16, 16, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(17, 17, 17, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(18, 18, 18, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(19, 19, 19, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48'),
(20, 20, 20, '1 Tablet', '3x Sehari', '5 Hari', 15, 'Diminum sesudah makan', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `queue_number` varchar(10) NOT NULL,
  `status` enum('WAITING','CALLED','IN_PROGRESS','COMPLETED','SKIPPED') DEFAULT 'WAITING',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `queues`
--

INSERT INTO `queues` (`id`, `appointment_id`, `queue_number`, `status`, `created_at`) VALUES
(1, 1, 'A1', 'COMPLETED', '2026-09-30 02:33:48'),
(2, 2, 'A2', 'COMPLETED', '2026-09-30 02:33:48'),
(3, 3, 'A3', 'COMPLETED', '2026-09-30 02:33:48'),
(4, 4, 'A4', 'COMPLETED', '2026-09-30 02:33:48'),
(5, 5, 'A5', 'WAITING', '2026-09-30 02:33:48'),
(6, 6, 'A6', 'WAITING', '2026-09-30 02:33:48'),
(7, 7, 'A7', 'COMPLETED', '2026-09-30 02:33:48'),
(8, 8, 'A8', 'COMPLETED', '2026-09-30 02:33:48'),
(9, 9, 'A9', 'WAITING', '2026-09-30 02:33:48'),
(10, 10, 'A10', 'COMPLETED', '2026-09-30 02:33:48'),
(11, 11, 'A11', 'WAITING', '2026-09-30 02:33:48'),
(12, 12, 'A12', 'COMPLETED', '2026-09-30 02:33:48'),
(13, 13, 'A13', 'COMPLETED', '2026-09-30 02:33:48'),
(14, 14, 'A14', 'WAITING', '2026-09-30 02:33:48'),
(15, 15, 'A15', 'COMPLETED', '2026-09-30 02:33:48'),
(16, 16, 'A16', 'COMPLETED', '2026-09-30 02:33:48'),
(17, 17, 'A17', 'WAITING', '2026-09-30 02:33:48'),
(18, 18, 'A18', 'WAITING', '2026-09-30 02:33:48'),
(19, 19, 'A19', 'COMPLETED', '2026-09-30 02:33:48'),
(20, 20, 'A20', 'WAITING', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('AVAILABLE','OCCUPIED','MAINTENANCE') DEFAULT 'AVAILABLE',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `type`, `price_per_night`, `status`, `created_at`) VALUES
(1, 'Ruang Melati 1', 'Kelas 1', 300000.00, 'OCCUPIED', '2026-09-30 02:33:48'),
(2, 'Ruang Melati 2', 'ICU', 150000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(3, 'Ruang Melati 3', 'UGD', 500000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(4, 'Ruang Melati 4', 'Kelas 3', 500000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(5, 'Ruang Melati 5', 'ICU', 150000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(6, 'Ruang Melati 6', 'VIP', 1000000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(7, 'Ruang Melati 7', 'UGD', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(8, 'Ruang Melati 8', 'Kelas 2', 500000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(9, 'Ruang Melati 9', 'Kelas 2', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(10, 'Ruang Melati 10', 'Kelas 3', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(11, 'Ruang Melati 11', 'Kelas 1', 150000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(12, 'Ruang Melati 12', 'Kelas 2', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(13, 'Ruang Melati 13', 'Kelas 2', 1000000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(14, 'Ruang Melati 14', 'Kelas 1', 150000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(15, 'Ruang Melati 15', 'Kelas 2', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(16, 'Ruang Melati 16', 'Kelas 1', 500000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(17, 'Ruang Melati 17', 'VIP', 1000000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(18, 'Ruang Melati 18', 'ICU', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(19, 'Ruang Melati 19', 'Kelas 3', 500000.00, 'AVAILABLE', '2026-09-30 02:33:48'),
(20, 'Ruang Melati 20', 'Kelas 3', 300000.00, 'AVAILABLE', '2026-09-30 02:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_classes`
--

CREATE TABLE `room_classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `price_per_day` decimal(15,2) NOT NULL,
  `bed_capacity` int(11) NOT NULL,
  `patients_per_room` int(11) NOT NULL,
  `amenities` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `room_classes`
--

INSERT INTO `room_classes` (`id`, `class_name`, `price_per_day`, `bed_capacity`, `patients_per_room`, `amenities`, `is_active`) VALUES
(1, 'VIP', 1500000.00, 1, 1, 'Kamar Mandi Dalam, AC, TV 42 Inch, Bel Perawat, Sofa Pendamping, Kulkas', 1),
(2, 'Kelas I', 750000.00, 2, 2, 'Kamar Mandi Dalam, AC, TV 32 Inch, Bel Perawat, Kursi Pendamping', 1),
(3, 'Kelas II', 450000.00, 4, 4, 'Kamar Mandi Dalam, AC, Bel Perawat', 1),
(4, 'Kelas III', 250000.00, 6, 6, 'Kamar Mandi Luar, Kipas Angin/AC Sentral, Bel Perawat', 1),
(5, 'Isolasi', 1000000.00, 1, 1, 'Ruang Tekanan Negatif, Hepa Filter, Kamar Mandi Dalam, AC, Bel Perawat', 1),
(6, 'ICU', 3000000.00, 1, 1, 'Monitor Pasien 24 Jam, Ventilator, Bed Khusus ICU, Sentral Oksigen', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','patient','doctor','officer') DEFAULT 'patient',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'patient1@gmail.com', '$2y$10$dummyhashedpassword1123', 'patient', '2026-09-30 02:33:48'),
(2, 'patient2@gmail.com', '$2y$10$dummyhashedpassword2123', 'patient', '2026-09-30 02:33:48'),
(3, 'patient3@gmail.com', '$2y$10$dummyhashedpassword3123', 'patient', '2026-09-30 02:33:48'),
(4, 'patient4@gmail.com', '$2y$10$dummyhashedpassword4123', 'patient', '2026-09-30 02:33:48'),
(5, 'patient5@gmail.com', '$2y$10$dummyhashedpassword5123', 'patient', '2026-09-30 02:33:48'),
(6, 'patient6@gmail.com', '$2y$10$dummyhashedpassword6123', 'patient', '2026-09-30 02:33:48'),
(7, 'patient7@gmail.com', '$2y$10$dummyhashedpassword7123', 'patient', '2026-09-30 02:33:48'),
(8, 'patient8@gmail.com', '$2y$10$dummyhashedpassword8123', 'patient', '2026-09-30 02:33:48'),
(9, 'patient9@gmail.com', '$2y$10$dummyhashedpassword9123', 'patient', '2026-09-30 02:33:48'),
(10, 'patient10@gmail.com', '$2y$10$dummyhashedpassword10123', 'patient', '2026-09-30 02:33:48'),
(11, 'patient11@gmail.com', '$2y$10$dummyhashedpassword11123', 'patient', '2026-09-30 02:33:48'),
(12, 'patient12@gmail.com', '$2y$10$dummyhashedpassword12123', 'patient', '2026-09-30 02:33:48'),
(13, 'patient13@gmail.com', '$2y$10$dummyhashedpassword13123', 'patient', '2026-09-30 02:33:48'),
(14, 'patient14@gmail.com', '$2y$10$dummyhashedpassword14123', 'patient', '2026-09-30 02:33:48'),
(15, 'patient15@gmail.com', '$2y$10$dummyhashedpassword15123', 'patient', '2026-09-30 02:33:48'),
(16, 'patient16@gmail.com', '$2y$10$dummyhashedpassword16123', 'patient', '2026-09-30 02:33:48'),
(17, 'patient17@gmail.com', '$2y$10$dummyhashedpassword17123', 'patient', '2026-09-30 02:33:48'),
(18, 'patient18@gmail.com', '$2y$10$dummyhashedpassword18123', 'patient', '2026-09-30 02:33:48'),
(19, 'patient19@gmail.com', '$2y$10$dummyhashedpassword19123', 'patient', '2026-09-30 02:33:48'),
(20, 'patient20@gmail.com', '$2y$10$dummyhashedpassword20123', 'patient', '2026-09-30 02:33:48'),
(21, 'doctor1@gmail.com', '$2y$10$dummyhashedpassword21123', 'doctor', '2026-09-30 02:33:48'),
(22, 'doctor2@gmail.com', '$2y$10$dummyhashedpassword22123', 'doctor', '2026-09-30 02:33:48'),
(23, 'doctor3@gmail.com', '$2y$10$dummyhashedpassword23123', 'doctor', '2026-09-30 02:33:48'),
(24, 'doctor4@gmail.com', '$2y$10$dummyhashedpassword24123', 'doctor', '2026-09-30 02:33:48'),
(25, 'doctor5@gmail.com', '$2y$10$dummyhashedpassword25123', 'doctor', '2026-09-30 02:33:48'),
(26, 'doctor6@gmail.com', '$2y$10$dummyhashedpassword26123', 'doctor', '2026-09-30 02:33:48'),
(27, 'doctor7@gmail.com', '$2y$10$dummyhashedpassword27123', 'doctor', '2026-09-30 02:33:48'),
(28, 'doctor8@gmail.com', '$2y$10$dummyhashedpassword28123', 'doctor', '2026-09-30 02:33:48'),
(29, 'doctor9@gmail.com', '$2y$10$dummyhashedpassword29123', 'doctor', '2026-09-30 02:33:48'),
(30, 'doctor10@gmail.com', '$2y$10$dummyhashedpassword30123', 'doctor', '2026-09-30 02:33:48'),
(31, 'doctor11@gmail.com', '$2y$10$dummyhashedpassword31123', 'doctor', '2026-09-30 02:33:48'),
(32, 'doctor12@gmail.com', '$2y$10$dummyhashedpassword32123', 'doctor', '2026-09-30 02:33:48'),
(33, 'doctor13@gmail.com', '$2y$10$dummyhashedpassword33123', 'doctor', '2026-09-30 02:33:48'),
(34, 'doctor14@gmail.com', '$2y$10$dummyhashedpassword34123', 'doctor', '2026-09-30 02:33:48'),
(35, 'doctor15@gmail.com', '$2y$10$dummyhashedpassword35123', 'doctor', '2026-09-30 02:33:48'),
(36, 'doctor16@gmail.com', '$2y$10$dummyhashedpassword36123', 'doctor', '2026-09-30 02:33:48'),
(37, 'doctor17@gmail.com', '$2y$10$dummyhashedpassword37123', 'doctor', '2026-09-30 02:33:48'),
(38, 'doctor18@gmail.com', '$2y$10$dummyhashedpassword38123', 'doctor', '2026-09-30 02:33:48'),
(39, 'doctor19@gmail.com', '$2y$10$dummyhashedpassword39123', 'doctor', '2026-09-30 02:33:48'),
(40, 'doctor20@gmail.com', '$2y$10$dummyhashedpassword40123', 'doctor', '2026-09-30 02:33:48'),
(41, 'rivaldi@gmail.com', '$2y$10$bj/5z8XZeMNNCkx4CVH2G.3MR3./x62mXsikbesthyDo9qxDN7blq', 'admin', '2026-09-30 02:35:55'),
(42, 'h@g.com', '$2y$10$1QMj/U5g7eRQO8mr40fTmOhgHQ6S.OMeq2kE6V2E4PZCdXSYSdbUm', 'patient', '2026-09-30 02:49:15'),
(43, 'DHARMAFATHAHILLAH@GMAIL.COM', '$2y$10$1x7r7lXXAj60waQGAIQtQuR99bpjy1BPQ.MaJOBxZPiLfKh.hE/06', 'doctor', '2026-10-06 01:25:56'),
(44, 'a@gmail.com', '$2y$10$1tAhXvFZmqSzi3EYciN7yOyfbXMLeIiW5x1drptMMKi2SPpsd5U9.', 'patient', '2026-10-10 08:01:25'),
(45, 'sera@gmail.com', '$2y$10$1vGT1wFL.KhykNt1mpa1C.ncNIpKkdBcfk5Xr.Yk4Cln8xBdS2XC2', 'patient', '2026-10-10 08:32:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_code` (`booking_code`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indeks untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disease_services`
--
ALTER TABLE `disease_services`
  ADD PRIMARY KEY (`disease_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indeks untuk tabel `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `poly_id` (`poly_id`);

--
-- Indeks untuk tabel `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indeks untuk tabel `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inpatient_admissions`
--
ALTER TABLE `inpatient_admissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indeks untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `admission_id` (`admission_id`);

--
-- Indeks untuk tabel `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeks untuk tabel `lab_results`
--
ALTER TABLE `lab_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `lab_test_id` (`lab_test_id`);

--
-- Indeks untuk tabel `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indeks untuk tabel `medical_services`
--
ALTER TABLE `medical_services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mrn` (`mrn`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `payer_policies`
--
ALTER TABLE `payer_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeks untuk tabel `poly`
--
ALTER TABLE `poly`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_record_id` (`medical_record_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indeks untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `room_classes`
--
ALTER TABLE `room_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `inpatient_admissions`
--
ALTER TABLE `inpatient_admissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `lab_results`
--
ALTER TABLE `lab_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `medical_services`
--
ALTER TABLE `medical_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `payer_policies`
--
ALTER TABLE `payer_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `poly`
--
ALTER TABLE `poly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `room_classes`
--
ALTER TABLE `room_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_app_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_app_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_app_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `doctor_schedules` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `disease_services`
--
ALTER TABLE `disease_services`
  ADD CONSTRAINT `disease_services_ibfk_1` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `disease_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `medical_services` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `fk_doctor_poly` FOREIGN KEY (`poly_id`) REFERENCES `poly` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_doctor_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `fk_schedule_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inpatient_admissions`
--
ALTER TABLE `inpatient_admissions`
  ADD CONSTRAINT `fk_ia_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ia_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ia_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_inv_adm` FOREIGN KEY (`admission_id`) REFERENCES `inpatient_admissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_inv_app` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_inv_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `fk_ii_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lab_results`
--
ALTER TABLE `lab_results`
  ADD CONSTRAINT `fk_lr_app` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_lr_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lr_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lr_test` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `fk_mr_app` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_mr_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mr_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `fk_patient_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_pay_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `fk_presc_med` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_presc_mr` FOREIGN KEY (`medical_record_id`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `fk_queue_app` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
