-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2024 pada 14.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kue`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(20) NOT NULL,
  `admin_toko` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_alamat` text NOT NULL,
  `admin_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_toko`, `admin_email`, `admin_password`, `admin_alamat`, `admin_foto`) VALUES
(1, 'mele', 'admin@gmail.com', '123', 'Muko-Muko', '20241028200621_18479.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_checkout`
--

CREATE TABLE `tb_checkout` (
  `checkout_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` int(12) NOT NULL,
  `norek` int(15) NOT NULL,
  `narek` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `register_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_contact`
--

CREATE TABLE `tb_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_nama` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `keranjang_id` int(20) NOT NULL,
  `register_id` int(11) NOT NULL,
  `keranjang_foto` varchar(255) NOT NULL,
  `keranjang_nama` varchar(255) NOT NULL,
  `keranjang_harga` int(20) NOT NULL,
  `keranjang_ukuran` varchar(255) NOT NULL,
  `keranjang_jumlah` int(20) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `selected` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `produk_id` int(20) NOT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `produk_harga` int(20) NOT NULL,
  `produk_stok` int(20) NOT NULL,
  `produk_detail` text NOT NULL,
  `produk_foto` varchar(255) NOT NULL,
  `produk_kat` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`produk_id`, `produk_nama`, `produk_harga`, `produk_stok`, `produk_detail`, `produk_foto`, `produk_kat`, `admin_id`) VALUES
(1, 'Kue Ulang Tahun', 200000, 30, '<p>Kue Ini buat Ulang Tahun</p>\r\n', '20241028201041_55428.png', 'Kue Ulang Tahun', 0),
(2, 'Opera Cake', 99000, 22, '<p>Opera Cake adalah salah satu jenis kue yang terkenal dalam dunia pastry Prancis. Kue ini terdiri dari beberapa lapisan tipis yang disusun secara bertingkat, biasanya terdiri dari:</p>\r\n\r\n<ol>\r\n  <li><strong>Lapisan Kue</strong>: Menggunakan kue jenis g&eacute;noise atau biscuit, yang memberikan tekstur lembut.</li>\r\n <li><strong>Krim</strong>: Umumnya menggunakan krim kopi atau krim mentega dengan rasa espresso, yang memberikan aroma khas.</li>\r\n <li><strong>Cokelat</strong>: Terdapat lapisan ganache cokelat, yang memberikan rasa kaya dan lezat.</li>\r\n <li><strong>Sirup</strong>: Kue ini sering direndam dengan sirup kopi atau alkohol (seperti amaretto) untuk menambah kelembapan dan rasa.</li>\r\n</ol>\r\n\r\n<p>Opera Cake biasanya dihias dengan lapisan cokelat di atasnya, sering kali dilengkapi dengan desain elegan. Kue ini dikenal karena rasanya yang kompleks dan presentasinya yang indah, menjadikannya pilihan populer untuk acara-acara spesial dan perayaan.</p>\r\n', '20241028200842_04322.jpg', 'Kue Wedding', 0),
(3, 'Wedding Cake', 750000, 66, '<p>Wedding Cake adalah kue yang khusus dibuat untuk perayaan pernikahan. Kue ini biasanya berukuran besar dan memiliki beberapa lapisan, sering dihias dengan dekorasi yang indah seperti fondant, bunga, atau elemen personalisasi lainnya.&nbsp;</p>\r\n\r\n<p>Secara tradisional, wedding cake memiliki rasa yang kaya, seperti vanilla, cokelat, atau buah, dan sering kali dilapisi dengan krim atau buttercream. Selain menjadi hidangan penutup yang dinikmati oleh para tamu, wedding cake juga memiliki makna simbolis, melambangkan kemakmuran dan keberuntungan bagi pasangan yang baru menikah.&nbsp;</p>\r\n\r\n<p>Kue ini sering menjadi fokus perhatian pada saat pemotongan kue di acara pernikahan, dan biasanya diabadikan dalam foto-foto.</p>\r\n', '20241028200951_65004.jpg', 'Kue Wedding', 0),
(4, 'Black Forest', 120000, 20, '<p>Black Forest Cake adalah kue klasik yang berasal dari Jerman, dikenal karena lapisan cokelatnya yang lembut, krim kocok, dan ceri. Kue ini biasanya terdiri dari beberapa lapisan sponge cake cokelat yang direndam dalam kirsch (minuman keras ceri), diisi dengan krim kocok dan ceri, lalu dihiasi dengan krim, serutan cokelat, dan ceri di atasnya.</p>\r\n\r\n<p>Rasa manis dari krim dan asam dari ceri menciptakan kombinasi yang sangat lezat. Black Forest Cake sering disajikan pada berbagai acara, seperti ulang tahun, pernikahan, dan perayaan lainnya. Kue ini tidak hanya lezat tetapi juga sangat menarik secara visual, membuatnya populer di kalangan pencinta kue di seluruh dunia.</p>\r\n', '20241028201041_55428.png', 'Kue Event', 0),
(5, 'Lapis talas bogor', 86000, 21, '<p>Lapis Talas Bogor adalah kue tradisional Indonesia yang terkenal dengan lapisan-lapisan tipisnya yang terbuat dari adonan talas, tepung ketan, dan santan. Kue ini biasanya memiliki warna ungu yang menarik, berasal dari talas ungu, dan memiliki rasa manis yang khas.</p>\r\n\r\n<p>Kue ini disusun dalam lapisan-lapisan yang diukus, sehingga memberikan tekstur yang kenyal dan lembut. Lapis Talas Bogor sering dijadikan makanan penutup atau camilan dan sangat populer di daerah Bogor, Jawa Barat. Kue ini sering dihidangkan pada berbagai acara, termasuk perayaan dan kumpul-kumpul keluarga. Keunikan rasanya dan tampilannya yang menarik menjadikannya salah satu kue tradisional yang disukai banyak orang.</p>\r\n', '20241028201137_13719.jpeg', 'Kue Event', 0),
(6, 'Kue Cokelat Happy Birthday', 150000, 25, 'Kue ulang tahun cokelat dengan dekorasi sederhana', '20241028201041_55428.png', 'Kue Ulang Tahun', 0),
(7, 'Kue Pernikahan Tiga Tingkat', 500000, 25, 'Kue pernikahan elegan dengan dekorasi bunga dan tiga tingkat', '20241028201041_55428.png', 'Kue Wedding', 0),
(8, 'Kue Vanilla Selamat Ulang Tahun', 120000, 25, 'Kue ulang tahun rasa vanilla dengan dekorasi lilin dan nama', '20241028201041_55428.png', 'Kue Ulang Tahun', 0),
(9, 'Kue Event Spesial', 200000, 25, 'Kue spesial untuk acara event, dilengkapi dekorasi yang meriah', '20241028201041_55428.png', 'Kue Event', 0),
(10, 'Kue Pernikahan Putih Elegan', 750000, 25, 'Kue wedding dengan tema putih dan bunga segar', '20241028201041_55428.png', 'Kue Wedding', 0),
(11, 'Kue Event Anniversary', 180000, 25, 'Kue spesial untuk perayaan anniversary dengan hiasan angka', '20241028201041_55428.png', 'Kue Event', 0),
(12, 'Kue Ulang Tahun Anak Karakter', 160000, 25, 'Kue ulang tahun untuk anak-anak dengan karakter favorit', '20241028201041_55428.png', 'Kue Ulang Tahun', 0),
(13, 'Kue Pernikahan Klasik', 650000, 25, 'Kue pernikahan klasik dengan tema tradisional', '20241028201041_55428.png', 'Kue Wedding', 0),
(14, 'Kue Event Lomba', 210000, 25, 'Kue event khusus untuk perayaan lomba dengan dekorasi piala', '20241028201041_55428.png', 'Kue Event', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_register`
--

CREATE TABLE `tb_register` (
  `register_id` int(11) NOT NULL,
  `register_username` varchar(255) NOT NULL,
  `register_email` varchar(255) NOT NULL,
  `register_password` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_register`
--

INSERT INTO `tb_register` (`register_id`, `register_username`, `register_email`, `register_password`, `admin_id`) VALUES
(1, 'rilki', 'rilki@gmail.com', 'rilki', 0),
(2, 'a', 'a@gmail.com', 'a', 0),
(3, 'p', 'p@p', 'p', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `tb_checkout`
--
ALTER TABLE `tb_checkout`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indeks untuk tabel `tb_contact`
--
ALTER TABLE `tb_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`keranjang_id`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indeks untuk tabel `tb_register`
--
ALTER TABLE `tb_register`
  ADD PRIMARY KEY (`register_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_checkout`
--
ALTER TABLE `tb_checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_contact`
--
ALTER TABLE `tb_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `keranjang_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `produk_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_register`
--
ALTER TABLE `tb_register`
  MODIFY `register_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
