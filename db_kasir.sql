-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2023 pada 04.58
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` varchar(255) NOT NULL,
  `id_jenis_barang` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `id_jenis_barang`, `nama`, `harga`, `stok`, `diskon`, `created_at`, `updated_at`) VALUES
('BA001', 'JB001', 'Serum Whitening Solution', 120000, 47, 0, '2023-07-23 12:28:56', '2023-07-30 20:50:27'),
('BA002', 'JB001', 'Serum Acne Solution', 75000, 100, 5, '2023-07-30 20:27:15', '2023-07-30 20:27:15'),
('BA003', 'JB002', 'Handbody Serum Whitening', 150000, 29, 10, '2023-07-30 20:31:48', '2023-09-14 13:08:34'),
('BA004', 'JB002', 'Body Peeling Whitening', 100000, 25, 0, '2023-07-30 20:32:27', '2023-10-10 19:11:14'),
('BA005', 'JB003', 'CC Cushion Shade 01', 150000, 30, 5, '2023-07-30 20:35:57', '2023-10-10 19:30:04'),
('BA006', 'JB003', 'Loose Powder Shade 01', 70000, 18, 0, '2023-07-30 20:40:10', '2023-09-15 19:48:15'),
('BA007', 'JB003', 'Lipcream Floral Shade 01', 80000, 18, 5, '2023-07-30 20:40:59', '2023-07-30 21:01:30'),
('BA008', 'JB002', 'Body Sunscreen Spf 30+++', 120000, 14, 0, '2023-07-30 20:42:32', '2023-10-10 19:30:04'),
('BA009', 'JB001', 'Face Sunscreen Spf 30+++', 100000, 21, 5, '2023-07-30 20:43:34', '2023-09-15 19:53:58'),
('BA010', 'JB003', 'Liptint Flower Shade 01', 60000, 17, 0, '2023-07-30 20:44:26', '2023-10-10 19:30:04'),
('BA011', 'JB001', 'Toner Acne Solution', 80000, 48, 5, '2023-07-30 20:45:01', '2023-07-30 20:50:27'),
('BA012', 'JB001', 'Facial Wash Acne Solution', 50000, 25, 5, '2023-07-30 20:45:32', '2023-09-15 20:10:28'),
('BA014', 'JB002', 'Hand Body Serum Glowing', 150000, 47, 5, '2023-09-14 15:24:09', '2023-09-15 20:10:29'),
('BA015', 'JB003', 'Eyebrow Pencil Black', 700000, 50, 0, '2023-09-14 15:24:59', '2023-09-14 15:24:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` varchar(20) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `total_diskon` bigint(20) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `id_barang`, `qty`, `diskon`, `harga`, `total_diskon`, `total_harga`, `created_at`, `updated_at`) VALUES
('DT0001', 'TR0001', 'BA004', 1, 0, 100000, 0, 100000, '2023-10-10 19:11:07', '2023-10-10 19:11:07'),
('DT0002', 'TR0001', 'BA008', 2, 0, 120000, 0, 240000, '2023-10-10 19:11:14', '2023-10-10 19:11:14'),
('DT0003', 'TR0002', 'BA005', 1, 7500, 150000, 7500, 150000, '2023-10-10 19:13:06', '2023-10-10 19:13:06'),
('DT0004', 'TR0003', 'BA005', 2, 7500, 150000, 15000, 300000, '2023-10-10 19:30:04', '2023-10-10 19:30:04'),
('DT0005', 'TR0003', 'BA010', 1, 0, 60000, 0, 60000, '2023-10-10 19:30:04', '2023-10-10 19:30:04'),
('DT0006', 'TR0003', 'BA008', 1, 0, 120000, 0, 120000, '2023-10-10 19:30:04', '2023-10-10 19:30:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hapus_detail_transaksi`
--

CREATE TABLE `hapus_detail_transaksi` (
  `id` varchar(255) NOT NULL,
  `id_hapus_transaksi` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `total_diskon` bigint(20) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hapus_detail_transaksi`
--

INSERT INTO `hapus_detail_transaksi` (`id`, `id_hapus_transaksi`, `id_barang`, `qty`, `diskon`, `harga`, `total_diskon`, `total_harga`, `created_at`, `updated_at`) VALUES
('DH0001', 'HT0001', 'BA008', 1, 0, 120000, 0, 120000, '2023-09-15 19:52:56', '2023-09-15 19:52:56'),
('DH0002', 'HT0001', 'BA009', 2, 5000, 100000, 10000, 200000, '2023-09-15 19:52:56', '2023-09-15 19:52:56'),
('DH0003', 'HT0002', 'BA008', 1, 0, 120000, 0, 120000, '2023-09-15 20:02:34', '2023-09-15 20:02:34'),
('DH0004', 'HT0002', 'BA009', 3, 5000, 100000, 15000, 300000, '2023-09-15 20:02:34', '2023-09-15 20:02:34'),
('DH0005', 'HT0003', 'BA012', 2, 2500, 50000, 5000, 100000, '2023-09-15 20:11:08', '2023-09-15 20:11:08'),
('DH0006', 'HT0003', 'BA014', 3, 7500, 150000, 22500, 450000, '2023-09-15 20:11:08', '2023-09-15 20:11:08'),
('DH0007', 'HT0004', 'BA005', 1, 7500, 150000, 7500, 150000, '2023-09-15 20:11:14', '2023-09-15 20:11:14'),
('DH0008', 'HT0004', 'BA008', 1, 0, 120000, 0, 120000, '2023-09-15 20:11:14', '2023-09-15 20:11:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hapus_transaksi`
--

CREATE TABLE `hapus_transaksi` (
  `id` varchar(255) NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `subtotal_diskon` bigint(20) NOT NULL,
  `subtotal_harga` bigint(20) NOT NULL,
  `total_bayar` bigint(20) NOT NULL,
  `pembayaran` bigint(20) NOT NULL,
  `kembalian` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hapus_transaksi`
--

INSERT INTO `hapus_transaksi` (`id`, `id_transaksi`, `tanggal`, `subtotal_diskon`, `subtotal_harga`, `total_bayar`, `pembayaran`, `kembalian`, `user_id`, `created_at`, `updated_at`) VALUES
('HT0001', 'TR0001', '2023-09-16', 10000, 320000, 310000, 320000, 10000, 7, '2023-09-15 19:52:55', '2023-09-15 19:52:55'),
('HT0002', 'TR0001', '2023-09-16', 15000, 420000, 405000, 405000, 0, 7, '2023-09-15 20:02:34', '2023-09-15 20:02:34'),
('HT0003', 'TR0001', '2023-09-16', 27500, 550000, 522500, 550000, 27500, 7, '2023-09-15 20:11:08', '2023-09-15 20:11:08'),
('HT0004', 'TR0002', '2023-09-16', 7500, 270000, 262500, 270000, 7500, 7, '2023-09-15 20:11:14', '2023-09-15 20:11:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `nama`, `created_at`, `updated_at`) VALUES
('JB001', 'Face Skincare', '2023-07-19 14:27:00', '2023-07-30 20:27:46'),
('JB002', 'Body Skincare', '2023-07-19 14:40:17', '2023-07-30 20:27:58'),
('JB003', 'Make Up', '2023-07-30 20:32:46', '2023-07-30 20:32:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(32, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(33, '2023_07_11_140227_barang', 1),
(34, '2023_07_11_140332_jenis_barang', 1),
(35, '2023_07_11_140357_transaksi', 1),
(36, '2023_07_11_140420_detail_transaksi', 1),
(37, '2014_10_12_000000_create_users_table', 2),
(38, '2023_09_14_203026_hapus_transaksi', 3),
(39, '2023_09_14_203041_hapus_detail_transaksi', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `subtotal_diskon` bigint(20) NOT NULL,
  `subtotal_harga` bigint(20) NOT NULL,
  `total_bayar` bigint(20) NOT NULL,
  `pembayaran` bigint(20) NOT NULL,
  `kembalian` bigint(20) NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `subtotal_diskon`, `subtotal_harga`, `total_bayar`, `pembayaran`, `kembalian`, `user_id`, `created_at`, `updated_at`) VALUES
('TR0001', '2023-10-11', 0, 340000, 340000, 350000, 10000, 7, '2023-10-10 19:10:59', '2023-10-10 19:10:59'),
('TR0002', '2023-10-11', 7500, 150000, 142500, 150000, 7500, 7, '2023-10-10 19:13:05', '2023-10-10 19:13:05'),
('TR0003', '2023-10-11', 15000, 480000, 465000, 470000, 5000, 7, '2023-10-10 19:30:04', '2023-10-10 19:30:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$aSbqqZ6Dm5D82fCx/UL2u.ECWfA4IJuFKrJ6WHAHf4oghxeyD8Hty', 'admin', '2023-07-16 11:13:27', '2023-07-24 11:11:48'),
(7, 'kasir', 'kasir@gmail.com', '$2y$10$LoKJssbu6ysiDdblnetAuOWb7o2dlA09ayFV9jkm7lW6RO8QLGbw6', 'kasir', '2023-07-19 13:37:27', '2023-07-26 19:43:20'),
(11, 'Novia', 'novia@gmail.com', '$2y$10$ysvgoQc/l1rlAfsnro3PxeWHNI4hd4A1o3anpP/6/h4LdV9BC9yoS', 'kasir', '2023-09-14 15:27:45', '2023-09-14 15:27:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jenis_barang` (`id_jenis_barang`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `hapus_detail_transaksi`
--
ALTER TABLE `hapus_detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hapus_transaksi` (`id_hapus_transaksi`);

--
-- Indeks untuk tabel `hapus_transaksi`
--
ALTER TABLE `hapus_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Ketidakleluasaan untuk tabel `hapus_detail_transaksi`
--
ALTER TABLE `hapus_detail_transaksi`
  ADD CONSTRAINT `hapus_detail_transaksi_ibfk_1` FOREIGN KEY (`id_hapus_transaksi`) REFERENCES `hapus_transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
