-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2025 at 03:34 AM
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
-- Database: `omisv01`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_fees`
--

CREATE TABLE `admin_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tax` int(11) NOT NULL,
  `delivery` int(11) NOT NULL,
  `insurance` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `am_comission` int(11) DEFAULT 0,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_fees`
--

INSERT INTO `admin_fees` (`id`, `user_id`, `tax`, `delivery`, `insurance`, `is_active`, `am_comission`, `logo`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 0, 0, 1, 5000, 'logo/01K5E656CM73QTZ7C6KDBGWHP4.png', '2025-09-15 01:07:34', '2025-09-19 07:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `sub_total` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Coffee Based', 'coffee-based', 'category_icon/01K7RM99C5Z753QSK2GKXQAWJJ.png', '2025-09-18 07:49:46', '2025-10-17 08:35:40', NULL),
(2, 'Chocolate Based', 'chocolate-based', 'category_icon/01K7RQ1M2GPSK0M900M0RVK8DQ.png', '2025-09-18 07:51:41', '2025-10-17 09:12:06', NULL),
(3, 'Non Coffee', 'non-coffee', 'category_icon/01K7RQ346ADQ231T67RGCE7A6P.png', '2025-09-18 08:01:56', '2025-10-17 09:12:55', NULL),
(4, 'Rice Bowl', 'rice-bowl', 'category_icon/01K7RPT60QYV4JQ4VDXTA4VXM0.png', '2025-09-18 10:56:10', '2025-10-17 09:08:02', NULL),
(5, 'Signature Food', 'signature-food', 'category_icon/01K7RQ7TXA3HP7ZASPBB0X6W7H.png', '2025-09-18 10:57:08', '2025-10-17 09:15:30', NULL),
(6, 'Snack', 'snack', 'category_icon/01K7RQ991C5W6WPCQ0T12362HQ.png', '2025-09-18 10:58:07', '2025-10-17 09:16:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_transaction_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` enum('submission','progress','resolved','closed') NOT NULL DEFAULT 'submission',
  `response_note` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `product_transaction_id`, `title`, `description`, `attachment`, `status`, `response_note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', 'test', NULL, 'resolved', 'Sudah ditangani dengan P3K dan akan dievaluasi lebih lanjut terkait kualitas pelayanan dan produk.', NULL, '2025-09-29 05:48:03', '2025-09-29 08:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `percentage` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `name`, `code`, `description`, `percentage`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Aniversary 10', 'aniv10', 'Peringatan HUT', 5, NULL, '2025-10-01 07:56:16', '2025-10-01 07:56:16'),
(2, 'affiliate', 'affiliate', 'apresiasi', 10, NULL, '2025-10-01 07:56:16', '2025-10-01 07:56:16');

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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `total_cost_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `qty`, `total_cost_price`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 16000, '2025-10-01 07:56:16', '2025-10-01 07:56:59'),
(3, 1, 30, 240000, '2025-10-01 22:55:52', '2025-10-01 22:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_04_153758_create_categories_table', 2),
(5, '2024_07_04_153834_create_products_table', 2),
(6, '2024_07_04_153930_create_carts_table', 2),
(7, '2024_07_04_153947_create_product_transactions_table', 2),
(8, '2024_07_04_172929_create_transaction_details_table', 2),
(9, '2024_07_18_131710_create_admin_fees_table', 2),
(10, '2025_09_15_062800_add_logo_to_admin_fees_table', 3),
(13, '2025_09_18_002621_add_some_field_to_users_table', 4),
(15, '2025_09_19_124822_add_qty_to_carts_table', 5),
(18, '2025_09_19_125830_add_qty_to_transaction_details_table', 6),
(19, '2025_09_19_130241_add_point_to_product_transactions_table', 6),
(20, '2025_09_21_132931_create_post_types_table', 7),
(21, '2025_09_21_132940_create_posts_table', 7),
(22, '2025_09_22_153140_add_image_to_posts_table', 8),
(24, '2025_09_29_094703_create_complaints_table', 9),
(29, '2025_10_01_082551_create_inventories_table', 10),
(30, '2025_10_01_083052_add_stock_and_safety_stock_field_to_products_table', 10),
(33, '2025_10_02_084129_create_discounts_table', 11),
(34, '2025_10_02_084828_add_commission_cost_field_to_admin_fees_table', 11),
(35, '2025_10_02_085815_add_discount_id_and_am_code_field_to_product_transactions_table', 12),
(36, '2025_10_02_090507_add_affiliate_code_and_commission_to_users_table', 13),
(38, '2025_10_18_111026_create_post_likes_table', 14),
(39, '2025_10_20_172005_add_status_field_to_product_transactions_table', 15);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_type_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `like` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_type_id`, `title`, `slug`, `content`, `image`, `like`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Komitmen ABC Coffee Shop terhadap Sertifikasi Halal dimulai dari Fasilitas Produksi yang Higienis', 'komitmen-abc-coffee-shop-terhadap-sertifikasi-halal-dimulai-dari-fasilitas-produksi-yang-higienis', '<p>Di tengah meningkatnya kesadaran konsumen akan pentingnya produk halal, <strong>ABC Coffee Shop</strong> hadir dengan komitmen kuat untuk menghadirkan kopi yang tidak hanya nikmat, tetapi juga memberikan ketenangan hati. Bagi kami, halal bukan sekadar label, melainkan <strong>standar mutu yang menyeluruh</strong> mulai dari pemilihan bahan baku hingga penyajian di meja pelanggan.</p><p>Salah satu bentuk nyata komitmen kami adalah dengan menyiapkan <strong>fasilitas produksi yang higienis</strong>. Semua peralatan yang digunakan dalam proses pengolahan kopi dijaga kebersihannya secara ketat, mulai dari mesin grinder, coffee maker, hingga wadah penyajian. Area dapur dan barista juga didesain untuk memenuhi prinsip <strong>kebersihan, sanitasi, dan keamanan pangan</strong>, sesuai dengan standar sertifikasi halal yang berlaku.</p><p>Lebih dari itu, kami memastikan bahwa bahan baku kopi, susu, gula, maupun tambahan lainnya berasal dari sumber yang jelas dan terjamin kehalalannya. Seluruh proses produksi diawasi secara rutin agar konsisten menjaga kualitas, sehingga setiap cangkir kopi yang tersaji memiliki <strong>nilai lebih: halal, higienis, dan penuh cita rasa.</strong></p><p></p><blockquote><p>Akses menu andalan Kami : di Menu</p></blockquote><p></p><p>Dengan adanya sertifikasi halal, kami ingin membangun <strong>kepercayaan yang lebih kuat</strong> kepada pelanggan. Kami yakin, sertifikasi ini bukan hanya memberikan kepastian kepada konsumen Muslim, tetapi juga menjadi simbol bahwa ABC Coffee Shop serius dalam menjalankan bisnis secara bertanggung jawab dan profesional.</p><p>Kini saatnya Anda merasakan sendiri perbedaan ngopi di tempat yang bukan hanya menghadirkan rasa, tetapi juga menjunjung tinggi komitmen halal dan kebersihan.<br>Datang dan nikmati pengalaman ngopi yang lebih tenang, nyaman, dan penuh kepastian di <strong>ABC Coffee Shop</strong>.<br>☕ Karena kopi nikmat bukan hanya soal rasa, tapi juga soal <strong>kepercayaan</strong>.</p>', 'post_image/01K5RBBFGCR3AES1PHZEJQTQDD.jpg', 0, '2025-09-22 09:16:23', '2025-09-22 11:05:35'),
(2, 1, 1, 'Ikuti 5 langkah ini agar lebih produktif jalani hari di Caffee Favoritmu', 'ikuti-5-langkah-ini-agar-lebih-produktif-jalani-hari-di-caffee-favoritmu', '<p>Bekerja dari kafe telah menjadi tren populer bagi banyak orang, terutama freelancer, mahasiswa, dan mereka yang membutuhkan suasana baru untuk meningkatkan kreativitas dan fokus. Suasana yang ramai namun santai, aroma kopi yang menggoda, dan akses internet yang stabil menjadikan kafe sebagai alternatif menarik dibandingkan bekerja di rumah atau di kantor. Namun, seringkali godaan untuk bersantai atau terdistraksi oleh percakapan di sekitar bisa menghambat produktivitas.</p><p>Jika Anda juga sering bekerja dari kafe, mungkin Anda pernah merasakan bagaimana sulitnya untuk tetap fokus dan menyelesaikan tugas. Terkadang, niat awal untuk produktif justru berakhir dengan menghabiskan waktu untuk berselancar di media sosial atau sekadar mengobrol dengan teman. Padahal, dengan perencanaan dan strategi yang tepat, Anda bisa memaksimalkan waktu Anda di kafe dan mencapai tingkat produktivitas yang optimal.</p><p>Artikel ini akan membahas lima langkah praktis yang bisa Anda terapkan agar lebih produktif saat bekerja di kafe. Dengan mengikuti tips-tips ini, Anda bisa mengubah kafe menjadi ruang kerja yang efektif dan menyenangkan. Siapkan diri Anda untuk meraih produktivitas maksimal dengan secangkir kopi dan suasana yang mendukung!</p><p>Mari simak tips berikut ini untuk meningkatkan produktivitasmu saat bekerja di kafe. Dengan sedikit perencanaan, kamu bisa mengubah kunjungan ke kafe menjadi sesi kerja yang efisien dan memuaskan.</p><h2>1. Tentukan Target dan Prioritas Sebelum Berangkat</h2><p>Sebelum Anda melangkahkan kaki ke kafe, luangkan waktu sejenak untuk menentukan target dan prioritas. Apa yang ingin Anda capai selama berada di sana? Apakah Anda ingin menyelesaikan laporan, menulis artikel, atau hanya sekadar membalas email? Dengan menetapkan tujuan yang jelas, Anda akan lebih fokus dan termotivasi untuk menyelesaikan tugas.</p><p>Buat daftar tugas yang ingin Anda selesaikan dan urutkan berdasarkan tingkat kepentingan dan urgensi. Fokuslah pada tugas-tugas yang paling penting terlebih dahulu. Hal ini akan membantu Anda menghindari perasaan kewalahan dan memastikan bahwa Anda menggunakan waktu Anda secara efektif.</p><h2>2. Pilih Kafe dengan Suasana yang Mendukung</h2><p>Tidak semua kafe diciptakan sama. Beberapa kafe memiliki suasana yang tenang dan kondusif untuk bekerja, sementara yang lain lebih cocok untuk bersantai dan mengobrol. Pilihlah kafe yang memiliki suasana yang mendukung produktivitas Anda. Pertimbangkan faktor-faktor seperti tingkat kebisingan, pencahayaan, dan ketersediaan stop kontak.</p><p>Cari tahu apakah kafe tersebut menyediakan area khusus untuk bekerja atau ruang tenang yang terpisah dari area utama. Pastikan juga kafe tersebut memiliki koneksi internet yang stabil dan cepat. Jika Anda membutuhkan privasi, pertimbangkan untuk memilih kafe yang memiliki bilik atau meja yang sedikit terpencil.</p><h2>3. Manfaatkan Aplikasi dan Alat Bantu Produktivitas</h2><p>Di era digital ini, ada banyak aplikasi dan alat bantu yang bisa membantu Anda meningkatkan produktivitas. Manfaatkan teknologi untuk mempermudah pekerjaan Anda dan meminimalkan gangguan. Misalnya, Anda bisa menggunakan aplikasi pengatur waktu seperti Pomodoro Timer untuk mengatur interval kerja dan istirahat Anda.</p><p>Selain itu, ada juga aplikasi pemblokir situs web yang bisa membantu Anda menghindari godaan untuk berselancar di media sosial atau mengunjungi situs web yang tidak relevan. Gunakan aplikasi pencatat seperti Evernote atau Google Keep untuk mencatat ide-ide, membuat catatan, dan mengatur tugas-tugas Anda.</p><h2>4. Istirahat Teratur dan Bergeraklah</h2><p>Meskipun Anda ingin fokus dan produktif, jangan lupakan pentingnya istirahat teratur. Duduk terlalu lama tanpa bergerak dapat menyebabkan kelelahan dan menurunkan konsentrasi. Setiap 25-30 menit, berdirilah, berjalan-jalan sejenak, dan regangkan otot-otot Anda. Anda juga bisa melakukan latihan pernapasan untuk menyegarkan pikiran dan mengurangi stres.</p><p>Manfaatkan waktu istirahat Anda untuk menjauh dari layar dan berinteraksi dengan lingkungan sekitar. Mengobrol dengan barista atau pelanggan lain bisa memberikan Anda inspirasi baru dan membantu Anda merasa lebih segar. Jangan lupa untuk minum air yang cukup dan mengonsumsi camilan sehat untuk menjaga energi Anda.</p><h2>5. Nikmati Kopi dan Suasana Kafe dengan Bijak</h2><p>Salah satu alasan utama mengapa orang suka bekerja dari kafe adalah karena kopi dan suasananya. Nikmatilah secangkir kopi berkualitas untuk meningkatkan fokus dan energi Anda. Namun, hindari mengonsumsi terlalu banyak kopi, karena hal itu bisa menyebabkan kegelisahan dan gangguan tidur.</p><p>Manfaatkan suasana kafe yang unik untuk meningkatkan kreativitas Anda. Amati orang-orang di sekitar Anda, dengarkan musik yang diputar, dan nikmati aroma kopi yang menenangkan. Biarkan lingkungan sekitar menginspirasi Anda dan membantu Anda menghasilkan ide-ide baru. Ingatlah untuk menikmati momen tersebut sambil tetap fokus pada tugas-tugas Anda.</p><h3>Butuh Tempat Nyaman dan Kopi Berkualitas? Kunjungi ABC Coffee Shop!</h3><p>Jika Anda mencari kafe yang sempurna untuk bekerja, kami mengundang Anda untuk mengunjungi <strong>ABC Coffee Shop</strong>. Kami menawarkan suasana yang nyaman, koneksi internet yang stabil, dan berbagai pilihan kopi berkualitas tinggi yang akan membuat Anda tetap fokus dan bersemangat. Jangan lewatkan promo-promo menarik kami setiap harinya!</p><p>Klik <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" href=\"#\">di sini</a> untuk melihat menu lengkap kami dan menemukan lokasi ABC Coffee Shop terdekat. Sampai jumpa di ABC Coffee Shop! Jangan lupa juga follow akun Instagram kami <a target=\"_blank\" rel=\"noopener noreferrer nofollow\" href=\"#\">@ABC_CoffeeShop</a> untuk mendapatkan update promo terbaru dan inspirasi kopi setiap hari! Selamat mencoba!</p>', 'post_image/01K6MR5VGJCBPPZV0436EMVMRA.jpg', 0, '2025-10-03 09:59:14', '2025-10-17 07:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(3, 3, 2, '2025-10-21 03:04:54', '2025-10-21 03:04:54'),
(4, 5, 2, '2025-11-05 07:04:11', '2025-11-05 07:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `post_types`
--

CREATE TABLE `post_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_types`
--

INSERT INTO `post_types` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Life Hack', 'life-hack', '2025-09-22 01:37:19', '2025-09-22 01:37:19'),
(2, 'Regulasi Halal', 'regulasi-halal', '2025-09-22 01:38:04', '2025-09-22 01:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `cost_price` int(11) DEFAULT 0,
  `about` text NOT NULL,
  `stock` int(11) DEFAULT 0,
  `safety_stock` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `photo`, `price`, `cost_price`, `about`, `stock`, `safety_stock`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Coffee Milk', 'coffee-milk', 1, 'products/01K5G3J3BKN6SRXJ49RHXC2TGB.jpg', 11000, 8000, 'Produk rekomendasi untuk Anda yang beraktivitas di coffee shop kami.', 15, 0, NULL, '2025-09-19 04:26:16', '2025-10-21 02:28:58'),
(2, 'Coffee Aren', 'coffee-aren', 1, 'products/01K5GESG8EX95WPJ9BZ4EZN0EZ.jpg', 13000, 0, 'Produk rekomendasi untuk Anda yang beraktivitas di coffee shop kami.', 0, 0, NULL, '2025-09-19 07:42:32', '2025-09-19 07:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_transactions`
--

CREATE TABLE `product_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(11) DEFAULT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `am_code` varchar(255) DEFAULT NULL,
  `total_amount` bigint(20) UNSIGNED NOT NULL,
  `point` int(11) DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `status` enum('pending','processing','serving','completed') NOT NULL DEFAULT 'pending',
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_transactions`
--

INSERT INTO `product_transactions` (`id`, `user_id`, `code`, `type`, `discount_id`, `am_code`, `total_amount`, `point`, `is_paid`, `status`, `address`, `city`, `postal_code`, `phone_number`, `notes`, `proof`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'TRX-617020', NULL, NULL, NULL, 324000, 81, 0, 'pending', 'Gonilan', 'Sukoharjo', '57375', '6285800288265', NULL, NULL, NULL, '2025-09-19 09:27:06', '2025-09-19 09:27:06'),
(2, 1, 'TRX-325875', 'qris', NULL, NULL, 26780, 26, 0, 'pending', 'Gonilan', 'Sukoharjo', '57375', '6285800288265', NULL, NULL, NULL, '2025-09-19 10:22:01', '2025-09-19 10:22:01'),
(3, 1, 'TRX-296746', 'qris', NULL, NULL, 22660, 22, 0, 'pending', 'Gonilan', 'Sukoharjo', '57375', '6285800288265', NULL, NULL, NULL, '2025-10-01 08:24:20', '2025-10-01 08:24:20'),
(4, 3, 'TRX-472213', 'cash', NULL, NULL, 22660, 22, 0, 'pending', 'Kliteh, jatirejo, sawit', 'Boyolali', '57374', '6285800288265', NULL, NULL, NULL, '2025-10-01 23:22:36', '2025-10-01 23:22:36'),
(5, 3, 'TRX-378268', 'qris', 2, 'AM3036', 45320, 44, 0, 'pending', 'Kliteh, jatirejo, sawit', 'Boyolali', '57374', '6285800288265', NULL, NULL, NULL, '2025-10-02 07:13:52', '2025-10-02 07:13:52'),
(6, 3, 'TRX-552518', 'qris', NULL, NULL, 11330, 11, 0, 'pending', 'Kliteh, jatirejo, sawit', 'Boyolali', '57374', '6285800288265', NULL, NULL, NULL, '2025-10-02 07:48:27', '2025-10-02 07:48:27'),
(7, 3, 'TRX-410507', 'qris', NULL, NULL, 11330, 11, 0, 'pending', 'Kliteh, jatirejo, sawit', 'Boyolali', '57374', '6285800288265', NULL, NULL, NULL, '2025-10-02 09:01:59', '2025-10-02 09:01:59'),
(8, 1, 'TRX-243911', 'qris', 1, NULL, 22660, 22, 0, 'pending', 'Gonilan', 'Sukoharjo', '57375', '6285800288265', NULL, NULL, NULL, '2025-10-21 02:28:58', '2025-10-21 02:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3CdBNmx3mGbEYW3Xhh4SZaszcAiJ4oyvWLaGEyPO', 5, '192.168.0.127', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/28.0 Chrome/130.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRVRJWjMwMzhQRDU0NndEQkJLVWNONHE3VDdHN2NDekphRGdUajM5UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xOTIuMTY4LjAuMTM2OjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTkyLjE2OC4wLjEzNjo4MDAwL2NhcnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1762152038),
('bmG4hVszIrXLRDdblLpVYQFL0dUsJq6AAZmXEzbq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0doS2wzMXVWelVxckExcXRObUtrMlVOSzhHbXh0UTdOMDFGWmNXUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761560573),
('CNLgtNgnS1hxA7FpmrPrpEbMr0PAB7z2BDFbIKkl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDc0R3lRM2Z2RVVaM2R6amsyVFNKMHZlc3hiZXgzQU03M3RqenBNWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9kb2MtYXNzaWduZWQtY2xhc3NpY2FsLWNyYXBzLnRyeWNsb3VkZmxhcmUuY29tL3Bvc3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761557027),
('FVRYS07VT63Dly6LuqrSRFYt5R3Ez1HACWH6Jq5t', 5, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/28.0 Chrome/130.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTFJVWkFTUTNFSXA0a05EcDhYb3RXN3RjN1ppbVlvRGt6c1loWXRJQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9iZWF1dGlmdWwtd29tZW4tYm9yaW5nLXBhdGgudHJ5Y2xvdWRmbGFyZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1762326939),
('gZYw6aHA2zfewloiyy5otlczAhtSY0KnB13WI3GU', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/28.0 Chrome/130.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWxQR0VYalR3c2FsVWFoQjdwTUFja205UEtzQlNjUlM1ZmRRaDRRUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9sb2dpY2FsLXJpbS1yb29tLXZpc2l0b3JzLnRyeWNsb3VkZmxhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761559669),
('jF6FstzQVpw1LGqTuLCz7oJHYIOmjAn0gfkXrmBI', NULL, '10.54.13.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakwzVDdWOVZnOGNRSFBtdmF2MzVCYlh3SEI5VjlOYXo5c3RYOFF6OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly8xMC41NC4xMy45Nzo4MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761558511),
('MBEo64JWxd4Zft9P8LApEhd850btJTYFcRvnE8ZM', NULL, '192.168.0.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0Z0aDZsWDBJTExZREd0aFZSaXBUalBKTXZqQnBZV0JHaEREQXlNdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xOTIuMTY4LjAuMTM2OjgwMDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1762151386),
('srCP23Tg9o7EvGJ7HJPCUAV3IylcEkXw5f0ulZoQ', NULL, '127.0.0.1', 'WhatsApp/2.2542.2 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUE1mOHVLbzllTXIxUlFvVWtKU0VXUkNWYmtlcHhPdmRkQUozZWdMYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9sb2dpY2FsLXJpbS1yb29tLXZpc2l0b3JzLnRyeWNsb3VkZmxhcmUuY29tL3Bvc3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761559533),
('SZJTFRsC12FHR0oxBtOTTXJWlaqJ2cCgpwcLCiAu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1ZpZjJ3T2RRZjR6R0U5MGZxeUtwd21mV2tQdzJaeVNadDJxemVRQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9iZWF1dGlmdWwtd29tZW4tYm9yaW5nLXBhdGgudHJ5Y2xvdWRmbGFyZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1762325636),
('WN0QWBfJwLncc75xnOJr4X7SQ6nR4HOWZtWcoUWL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUUYweVI5ZG43RnhNMjhWSWIxTUthM1I4NU5FM3NHMFJUNXF4RFF6MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93aGVhdC1wcm9wZXItdXRjLXR5cGVzLnRyeWNsb3VkZmxhcmUuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MzoiaHR0cDovL3doZWF0LXByb3Blci11dGMtdHlwZXMudHJ5Y2xvdWRmbGFyZS5jb20vY2FydHMiO319', 1761558311),
('y4mlsCwDMu7ml1okQC1zv38j4uajy1jQRUZAfXhf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibk1lOXdVRkNweGlXdUl3NVk3SnZiOGs2aHIwU3czd09vd3lnZGZnZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9sb2dpY2FsLXJpbS1yb29tLXZpc2l0b3JzLnRyeWNsb3VkZmxhcmUuY29tL3Bvc3RzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1761559699),
('yZXD2ItLeGr5lU61kLR1mkJqID1iCYXf09hq0y3V', NULL, '127.0.0.1', 'WhatsApp/2.2543.1 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzRJY1o5U3Z0dEtYdXRXSUFzNkg0aXBZMnB6a2Q4M0d1N1YxV3BxRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9iZWF1dGlmdWwtd29tZW4tYm9yaW5nLXBhdGgudHJ5Y2xvdWRmbGFyZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1762325655);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` bigint(20) UNSIGNED NOT NULL,
  `sub_total` int(11) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `product_transaction_id`, `product_id`, `qty`, `price`, `sub_total`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 11000, 55000, NULL, '2025-09-19 09:27:06', '2025-09-19 09:27:06'),
(2, 1, 2, 2, 13000, 26000, NULL, '2025-09-19 09:27:06', '2025-09-19 09:27:06'),
(3, 2, 2, 2, 13000, 26000, NULL, '2025-09-19 10:22:01', '2025-09-19 10:22:01'),
(4, 3, 1, 2, 11000, 22000, NULL, '2025-10-01 08:24:20', '2025-10-01 08:24:20'),
(5, 4, 1, 2, 11000, 22000, NULL, '2025-10-01 23:22:36', '2025-10-01 23:22:36'),
(6, 5, 1, 4, 11000, 44000, NULL, '2025-10-02 07:13:52', '2025-10-02 07:13:52'),
(7, 6, 1, 1, 11000, 11000, NULL, '2025-10-02 07:48:27', '2025-10-02 07:48:27'),
(8, 7, 1, 1, 11000, 11000, NULL, '2025-10-02 09:01:59', '2025-10-02 09:01:59'),
(9, 8, 1, 2, 11000, 22000, NULL, '2025-10-21 02:28:58', '2025-10-21 02:28:58');

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
  `affiliate_code` varchar(255) DEFAULT NULL,
  `commission` int(11) DEFAULT 0,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `bod` date DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `affiliate_code`, `commission`, `address`, `city`, `postal_code`, `phone_number`, `bod`, `profession`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin TC1', 'admin@gmail.com', NULL, '$2y$12$I80cIEwcAjTWEwmQBpuezeQE6UDx/3150z5leUiVo4eYtbI9pCJwm', NULL, 0, 'Gonilan', 'Sukoharjo', '57375', '6285800288265', '1999-05-12', 'Pelajar', NULL, '2025-08-26 06:08:22', '2025-09-18 07:42:28'),
(2, 'Tester 01', 'test01@gmail.com', NULL, '$2y$12$lKzjbBSnz4RrYcEqckWa1OX9Wkz393ymzPHWeTLNP/gu47xp6FsYW', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-14 20:57:02', '2025-09-14 20:57:02'),
(3, 'Arief', 'arief.infinitylearn@gmail.com', NULL, '$2y$12$mGbAYeXATZAlrxnbzKXlFOyde6JujKh6Y/r3lRuJ8n8G6WYVZneta', 'AM3036', 0, 'Kliteh, jatirejo, sawit', 'Boyolali', '57374', '6285800288265', '2000-05-12', 'Pelajar', NULL, '2025-10-01 22:43:01', '2025-10-02 02:43:38'),
(4, 'Arief 2', 'arief2@gmail.com', NULL, '$2y$12$7SLA5xYuYBWNKTrw8jOCi.AMZ8eKR6IjX1uLa3uKVb4JsFjpHTHby', 'AM3957', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-09 10:00:03', '2025-10-09 10:00:03'),
(5, 'Tester 03', 'tester03@gmail.com', NULL, '$2y$12$9wjFXaaxZ.Efzv7loN0y8ubHTLGR9.03CzpGqu.Dey72jFP1LoPkG', 'AM5438', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-03 06:40:36', '2025-11-03 06:40:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_fees`
--
ALTER TABLE `admin_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_fees_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_product_transaction_id_foreign` (`product_transaction_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discounts_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_post_type_id_foreign` (`post_type_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_likes_user_id_foreign` (`user_id`),
  ADD KEY `post_likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_types`
--
ALTER TABLE `post_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_transactions`
--
ALTER TABLE `product_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_transactions_user_id_foreign` (`user_id`),
  ADD KEY `product_transactions_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_product_transaction_id_foreign` (`product_transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_fees`
--
ALTER TABLE `admin_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_types`
--
ALTER TABLE `post_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_transactions`
--
ALTER TABLE `product_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_fees`
--
ALTER TABLE `admin_fees`
  ADD CONSTRAINT `admin_fees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_product_transaction_id_foreign` FOREIGN KEY (`product_transaction_id`) REFERENCES `product_transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_post_type_id_foreign` FOREIGN KEY (`post_type_id`) REFERENCES `post_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_transactions`
--
ALTER TABLE `product_transactions`
  ADD CONSTRAINT `product_transactions_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_transaction_id_foreign` FOREIGN KEY (`product_transaction_id`) REFERENCES `product_transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
