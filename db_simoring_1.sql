-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2024 at 12:55 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simoring_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cps`
--

CREATE TABLE `cps` (
  `id` bigint UNSIGNED NOT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `elemen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cps`
--

INSERT INTO `cps` (`id`, `jurusan_id`, `elemen`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Proses bisnis bidang otomotif secara menyeluruh', 'Meliputi proses bisnis bidang otomotif secara menyeluruh pada berbagai jenis dan merk kendaraan, serta pengelolaan sumber daya manusia dengan memperhatikan potensi dan kearifan lokal.', NULL, '2024-07-29 01:58:09'),
(2, 1, 'Perkembangan teknologi otomotif dan dunia kerja serta isu-isu global ', 'Meliputi perkembangan teknologi otomotif dan dunia kerja serta isu-isu global terkait dunia otomotif. ', NULL, NULL),
(3, 1, 'Profesi dan kewirausahaan (job-profile dan technopreneurship), serta peluang usaha di bidang otomotif. ', 'Meliputi profesi dan kewirausahaan (job-profile dan technopreneurship) serta peluang usaha di bidang otomotif. ', NULL, NULL),
(4, 1, 'Keselamatan dan Kesehatan Kerja serta Lingkungan Hidup (K3LH) dan budaya kerja industri ', 'Meliputi penerapan K3LH dan budaya kerja industri,antara lain: praktik-praktik kerja yang aman, bahaya-bahaya di tempat kerja, prosedur-prosedur dalam keadaan darurat, dan penerapan budaya kerja industri, seperti 5R (Ringkas, Rapi, Resik, Rawat, Rajin), dan etika kerja. ', NULL, NULL),
(5, 1, 'Teknik dasar pemeliharaan dan perbaikan yang terkait dengan seluruh proses bidang otomotif. ', 'Meliputi praktik dasar yang terkait dengan seluruh proses bidang otomotif, antara lain penggunaan alat ukur, pemeliharaan, perbaikan, pembentukan bodi kendaraan, perakitan, serta pengenalan alat berat, dump-truck, dan sejenisnya. ', NULL, NULL),
(6, 1, 'Gambar teknik ', 'Meliputi menggambar teknik dasar, termasuk pengenalan macam-macam peralatan gambar, standarisasi dalam pembuatan gambar, serta praktik menggambar dan membaca gambar teknik, dan menentukan letak dan posisi komponen otomotif berdasarkan gambar buku manual. ', NULL, NULL),
(7, 1, 'Peralatan dan perlengkapan tempat kerja ', 'Meliputi penggunaan peralatan dan perlengkapan tempat kerja antara lain alat-alat tangan (tools), alat ukur, perlengkapan bengkel (equipment), Special Service Tools (SST) serta alat pengangkat. ', NULL, NULL),
(8, 1, 'Pemeliharaan komponen otomotif ', 'Meliputi pemeliharaan dan penggantian komponen otomotif mencakup dan tidak terbatas pada engine, chasis kelistrikan, dan bodi kendaraan. ', NULL, NULL),
(9, 1, 'Dasar elektronika otomotif ', 'Meliputi pembuatan rangkaian elektronika dasar,termasuk pemahaman fungsi dan cara kerja komponen- komponen elektronika dasar, perakitan, gangguan rangkaian komponen-komponen elektronika dasar, perawatan komponen komponen elektronika dasar, serta pematrian komponen sesuai prosedur manual perbaikan ', NULL, NULL),
(10, 1, 'Dasar sistem hidrolik dan pneumatic ', 'Meliputi prinsip dasar sistem hidrolik dan penumatik, termasuk komponen sistem hidrolik dan pneumatik. ', NULL, NULL),
(11, 1, 'Perawatan dan Perbaikan Engine Sepeda Motor ', 'proses perawatan dan perbaikan engine sepeda motor beserta komponen-komponennya secara menyeluruh pada berbagai jenis dan merek sepeda motor ', NULL, NULL),
(12, 1, 'Perawatan dan Perbaikan Sasis Sepeda Motor ', 'proses perawatan dan perbaikan sasis sepeda motor dan komponen-komponennya secara menyeluruh pada berbagai jenis dan merek sepeda motor ', NULL, NULL),
(13, 1, 'Perawatan dan Perbaikan Sistem Pemindah Tenaga Sepeda Motor ', 'proses perawatan dan perbaikan sistem pemindah tenaga sepeda motor beserta komponen-komponennya secara menyeluruh pada berbagai jenis dan merek sepeda motor ', NULL, NULL),
(14, 1, 'Perawatan dan Perbaikan Sistem Kelistrikan Sepeda Motor. ', 'proses perawatan dan perbaikan sistem kelistrikan sepeda motor secara menyeluruh pada berbagai jenis dan merek sepeda motor ', NULL, NULL),
(15, 1, 'Perawatan dan Perbaikan Sepeda Motor Listrik dan Hybrid ', 'proses perawatan dan perbaikan sepeda motor listrik dan hybrid secara menyeluruh pada berbagai jenis dan merek sepeda motor ', NULL, NULL),
(16, 1, 'Perawatan dan Perbaikan Engine Management System Sepeda Motor ', 'proses perawatan dan perbaikan engine management system sepeda motor secara menyeluruh pada berbagai jenis dan merek mepeda motor ', NULL, NULL),
(17, 1, 'Pengelolaan Bengkel Sepeda Motor ', 'proses pengelolaan dan pengembangan teknik serta manajemen perawatan sepeda motor secara menyeluruh pada berbagai jenis dan merek sepeda motor ', NULL, NULL),
(18, 2, 'Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH) dan budaya kerja industri ', 'Meliputi penerapan K3LH dan budaya kerja industri, antara lain: praktik-praktik kerja yang aman, bahaya-bahaya di tempat kerja, prosedur-prosedur dalamkeadaan darurat, dan penerapan budaya kerja industri (Ringkas, Rapi, Resik, Rawat, Rajin), termasuk pencegahan kecelakaan kerja di tempat tinggi dan prosedur kerja di tempat tinggi (pemanjatan) ', NULL, NULL),
(19, 2, 'Dasar-dasar teknik jaringan komputer dan telekomunikasi ', 'Meliputi pemahaman dasar penggunaan dan konfigurasi peralatan/teknologi di bidang jaringan komputer dan telekomunikasi. ', NULL, NULL),
(20, 2, 'Media dan Jaringan Telekomunikasi ', 'Meliputi pemahaman prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, Sistem Keamanan Jaringan Telekomunikasi, Sistem Seluler, Sistem Microwave, Sistem VSAT IP, Sistem Optik, dan Sistem WLAN. ', NULL, NULL),
(21, 2, 'Penggunaan Alat Ukur Jaringan ', 'Meliputi pemahaman tentang jenis alat ukur dan penggunaannya dalam pemeliharaan jaringan komputer dan sistem telekomunikasi. ', NULL, NULL),
(22, 2, 'Perencanaan dan Pengalamatan Jaringan ', 'Meliputi perencanaan topologi dan arsitektur jaringan, pengumpulan kebutuhan teknis pengguna yang menggunakan jaringan, pengumpulan data peralatan jaringan dengan teknologi yang sesuai, pengalamatan jaringan CIDR, VLSM, dan subnetting ', NULL, NULL),
(23, 2, 'Teknologi Jaringan Kabel dan Nirkabel ', 'Meliputi instalasi jaringan kabel dan nirkabel, pengujian, perawatan dan perbaikan jaringan kabel dan nirkabel, standar jaringan nirkabel, jenis-jenis teknologi jaringan nirkabel indoor dan outdoor, teknologi layanan Voice over IP (VoIP), jaringan fiber optic, jenis-jenis kabel fiber optic, fungsi alat kerja fiber optic, sambungan fiber optic, dan perbaikan jaringan fiber optic ', NULL, NULL),
(24, 2, 'Keamanan Jaringan ', 'Meliputi kebijakan penggunaan jaringan, ancaman dan serangan terhadap keamanan jaringan, penentuan sistem keamanan jaringan yang dibutuhkan, firewall pada host dan server, kebutuhan persyaratan alat-alat untuk membangun server firewall, konsep dan implementasi firewall di host dan server, fungsi dan cara kerja server autentifikasi, kebutuhan persyaratan alat-alat untuk membangun server autentifikasi, cara kerja sistem pendeteksi dan penahan ancaman/ serangan yang masuk ke jaringan, analisis fungsi dan tata cara pengamanan server-server layanan pada jaringan, dan tata cara pengamanan komunikasi data menggunakan teknik kriptografi ', NULL, NULL),
(25, 2, 'Pemasangan dan Konfigurasi Perangkat Jaringan ', 'Meliputi pemasangan perangkat jaringan ke dalam sistem jaringan, penggantian perangkat jaringan sesuai dengan kebutuhan, konsep VLAN, konfigurasi dan pengujian VLAN, proses routing, jenis-jenis routing, konfigurasi, analisis permasalahan dan perbaikan konfigurasi routing statis dan routing dinamis, konfigurasi NAT, analisis permasalahan internet gateway dan perbaikan konfigurasi NAT, konfigurasi, analisis permasalahan dan perbaikan konfigurasi proxy server, manajemen bandwidth dan load balancing ', NULL, NULL),
(26, 2, 'Administrasi Sistem Jaringan ', 'Meliputi instalasi sistem operasi jaringan, konsep, instalasi services, konfigurasi, dan pengujian konfigurasi remote server, DHCP server, DNS server, FTP server, file server, web server, mail server, database server, Control Panel Hosting, Share Hosting Server, Dedicated Hosting Server, Virtual Private Server, VPN server, sistem kontrol, dan monitoring ', NULL, NULL),
(27, 3, 'Proses bisnis menyeluruh bidang pengembangan perangkat lunak dan gim ', 'Meliputi perencanaan, analisis, desain, implementasi, integrasi, pemeliharaan, pemasaran, dan distribusi perangkat lunak dan gim termasuk di dalamnya adalah penerapan budaya mutu, Keselamatan dan Kesehatan Kerja serta Lingkungan Hidup (K3LH), manajemen proyek, serta pemahaman terhadap kebutuhan pelanggan, keinginan pelanggan, dan validasi sesuai dengan User Experience (UX). ', NULL, NULL),
(28, 3, 'Perkembangan dunia kerja bidang perangkat lunak dan gim ', 'Meliputi perkembangan teknologi pada pengembangan perangkat lunak dan gim termasuk penerapan industri 4.0 pada manajemen pengembangan perangkat lunak dan gim serta isu-isu penting bidang pengembangan perangkat lunak dan gim. Contohnya dampak positif dan negatif gim, IoT, Cloud Computing, Big Data, Information Security, HAKI (Hak Atas Kekayaan Intelektual) dan pelanggaran HAKI. ', NULL, NULL),
(29, 3, 'Profesi dan kewirausahan (job profile dan technopreneurship) serta peluang usaha di bidang industri perangkat lunak dan gim ', 'Meliputi jenis-jenis profesi dan kewirausahan (job profile dan technopreneurship), personal branding serta peluang usaha di bidang industri perangkat lunak dan gim. ', NULL, NULL),
(30, 3, 'Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH) dan budaya kerja industri ', 'Meliputi penerapan K3LH dan budaya kerja industri, antara lain: praktik-praktik kerja yang aman, bahaya-bahaya di tempat kerja, prosedur-prosedur dalam keadaan darurat, dan penerapan budaya kerja industri (Ringkas, Rapi, Resik, Rawat, Rajin), termasuk pencegahan kecelakaan kerja dan prosedur kerja ', NULL, NULL),
(31, 3, 'Orientasi dasar pengembangan perangkat lunak dan gim ', 'Meliputi kegiatan praktik singkat dengan menggunakan peralatan/teknologi di bidang pengembangan perangkat lunak dan gim seperti basis data, tools pengembangan perangkat lunak, ragam sistem operasi, pengelolaan aset, user interface (grafis, typography, warna, audio, video, interaksi pengguna) dan prinsip dasar algoritma pemrograman (varian dan invarian, alur logika pemrograman, flowchart, dan teknik dasar algoritma umum) ', NULL, NULL),
(32, 3, 'Pemrograman terstruktur ', 'Meliputi konsep atau sudut pandang pemrograman yang membagi-bagi program berdasarkan fungsi atau prosedur yang dibutuhkan program komputer, pengenalan struktur data yang terdiri dari data statis (array baik dimensi, panjang, tipe data, pengurutan) dan data dinamis (list, stack), penggunaan tipe data, struktur kontrol perulangan dan percabangan ', NULL, NULL),
(33, 3, 'Pemrograman berorientasi obyek ', 'Meliputi penggunaan prosedur dan fungsi, class, obyek, method, package, accessmodifier, enkapsulasi, interface, pewarisan, dan polymorphism ', NULL, NULL),
(34, 3, 'Basis Data ', 'Meliputi konsep dan implementasi struktur, hirarki, aturan, komponen, instalasi, dan dasar administrasi basis data serta Data Definition Language, Data Manipulation Language, Data Control Language, perintah bertingkat, function and stored procedure, trigger, backup, restore, dan replikasi pada pengelolaan basis data. ', NULL, NULL),
(35, 3, 'Pemrograman Berbasis Teks, Grafis, dan Multimedia ', 'Meliputi konsep atau sudut pandang pemrograman yang membagi-bagi program berdasarkan pemrograman terstruktur dan pemrograman berorientasi objek tingkat lanjut, dasar pemodelan perangkat lunak berorientasi objek, objek multimedia dalam aplikasi serta pemrograman antar muka grafis (Graphical User Interface) dengan memanfaatkan pustaka (library) yang tersedia pada bahasa pemrograman untuk beragam kebutuhan. ', NULL, NULL),
(36, 3, 'Pemrograman Web ', 'Meliputi konsep dan implementasi perintah HTML, CSS, pemrograman Javascript, bahasa pemrograman server-side serta implementasi framework pada pembuatan web statis dan dinamis untuk beragam kebutuhan. ', NULL, NULL),
(37, 3, 'Pemrograman Perangkat Bergerak ', 'Meliputi pengertian, sejarah, dan komponen dalam sistem operasi perangkat bergerak serta pengembangan aplikasinya, konsep dan implementasi Integrated Development Environment, framework dan bahasa pemrograman untuk pengembangan aplikasi perangkat bergerak, basis data perangkat bergerak serta antarmuka aplikasi yang saling berhubungan dengan aplikasi lainnya (Application Programming Interface) ', NULL, NULL),
(38, 3, 'Pemodelan Gim ', 'Meliputi konsep perancangan video game, mencakup ide konsep gim (game concept), dokumen desain gim (game design document), desain mekanika gim (game mechanic concept), desain sistem gim (game system concept), desain teknik gim (game technical concept), desain level gim (game level concept), desain narasi gim (game narrative concept), riset pengguna gim (game user research concept), desain purwarupa gim (game design prototype) dan desain keseimbangan gim (game design balancing) dan implementasinya. ', NULL, NULL),
(39, 3, 'Pemrograman Gim ', 'Meliputi konsep dan implementasi pemrograman berbasis teks dan grafis yang diintegrasikan pada pemrograman gim (game engine) mencakup pemrograman ke dalam bentuk gameplay, implementasi UI/UX (graphical user interface), struktur data, integrasi objek statis dan dinamis (static and dynamic assets integration), fungsionalitas tambahan pada game engine (tools and plugin implementation), serta pengujian dan peningkatan kualitas perangkat lunak melalui debugging, optimasi kinerja gim, dan pembaharuan perangkat lunak. ', NULL, NULL),
(40, 3, 'Komputer Grafis dan Multimedia ', 'Meliputi konsep visual gim mencakup desain konsep artistik (key concept art), dokumen perancangan artistik (art design document), desain karakter (character design), desain latar belakang (environment design), desain properti (properti design), konsep dan implementasi komputer grafis dan multimedia mencakup 2D puppeteer (cut out animation), model 3D dengan teknik digital sculpting, tekstur permukaan 3D (texturing), struktur/kerangka sistem mekanika objek/benda/karakter (rigging), akting pergerakan karakter, simulasi gerak digital benda (rigid/soft body) dan sifat bahan 3D (shading). ', NULL, NULL),
(41, 3, 'Audio Editing ', 'Meliputi konsep dan implementasi perencanaan kebutuhan aset audio, perekaman suara (dubbing), serta pengembangan aset audio (efek suara dan musik latar). ', NULL, NULL),
(42, 4, 'Profil technopreneur, peluang usaha dan pekerjaan/profesi bidang Desain Komunikasi Visual ', 'Lingkup pembelajaran meliputi technopreneur dalam bidang Desain Komunikasi Visual, dan kewirausahaan serta peluang usaha di bidang seni dan ekonomi kreatif yang mampu membaca peluang pasar dan usaha, untuk membangun visi dan passion, serta melakukan pembelajaran berbasis projek nyata sebagai simulasi projek/PjBL kewirausahaan. ', NULL, NULL),
(43, 4, 'Proses bisnis berbagai industri di bidang Desain Komunikasi Visual ', 'Lingkup pembelajaran meliputi pemahaman peserta didik tentang K3 di bidang Desain Komunikasi Visual, proses produksi di industri, pengetahuan tentang kepribadian yang dibutuhkan agar dapat mengembangkan pola pikir kreatif, proses kreasi untuk menghasilkan solusi desain yang tepat sasaran, aspek perawatan peralatan, potensi lokal dan kearifan lokal, dan pengelolaan SDM di industri. ', NULL, NULL),
(44, 4, 'Perkembangan teknologi di industri dan dunia kerja serta isu-isu global pada bidang Desain Komunikasi Visual ', 'Lingkup pembelajaran meliputi pemahaman peserta didik tentang perkembangan proses produksi industri Desain Komunikasi Visual mulai dari teknologi konvensional sampai dengan teknologi modern, Industri 4.0, Internet of Things, digital teknologi dalam dunia industri, isu pemanasan global, perubahan iklim, aspek-aspek ketenagakerjaan, Life Cycle produk industri sampai dengan reuse, recycling. ', NULL, NULL),
(45, 4, 'Teknik dasar proses produksi pada industri Desain Komunikasi Visual ', 'kepribadian yang dibutuhkan peserta didik agar dapat mengembangkan pola pikir kreatif melalui praktek secara mandiri dengan berpikir kritis tentang seluruh proses produksi dan teknologi serta budaya kerja yang diaplikasikan dalam industri DKV. ', NULL, NULL),
(46, 4, 'Sketsa dan Ilustrasi ', 'Lingkup pembelajaran meliputi fungsi sketsa dan ilustrasi dalam dunia Desain Komunikasi Visual beserta penguasaan teknik keterampilan membuat sketsa dan ilustrasi untuk kebutuhan dasar rancangan desain. ', NULL, NULL),
(47, 4, 'Komposisi typography ', 'Lingkup pembelajaran meliputi sejarah huruf, pengertian huruf, jenis-jenis huruf, anatomi huruf, karakter huruf, dan fungsi huruf. Penguasaan keterampilan dalam menghadirkan komposisi tipografi tentang hirarki, leading, tracking, dan kerning. ilustrasi untuk kebutuhan dasar rancangan desain. ', NULL, NULL),
(48, 4, 'Fotografi dasar ', 'Lingkup pembelajaran meliputi dasar-dasar fotografi, prinsip, estetika fotografi, dan prosedur penggunaan peralatan fotografi seperti kamera, peralatan studio fotografi, dan dapat mengidentifikasi alat yang digunakan dalam pemotretan. Menerapkan pengetahuan dan keterampilan fotografi baik penggunaan peralatan di dalam studio dan luar studio. ', NULL, NULL),
(49, 4, 'Komputer grafis ', 'Lingkup pembelajaran meliputi jenis-jenis perangkat lunak komputer grafis berbasis bitmap dan vector yang dibutuhkan dalam eksekusi desain komunikasi visual. Menerapkan keterampilan dasar tentang penggunaan tools, menu, dan klasifikasi warna dalam RGB dan CMYK untuk proses produksi manual dan digital. ', NULL, NULL),
(50, 4, 'Prinsip Dasar Desain dan Komunikasi ', 'Lingkup pembelajaran meliputi pengetahuan,keterampilan, dan sikap dalam menerapkan prinsip dasar desain- untuk merancang visual, di antaranya: kesatuan (unity), keseimbangan (balance), Komposisi (komposition), proposi (proportion), irama (rhythm), penekanan (emphasis),kesederhanaan (simplicity), kejelasan (clarity), ruang (space). Membangun kemampuan dalam memahami dan menerapkan peran komunikator, komunikan, dan media komunikasi dalam perancangan komunikasi visual. ', NULL, NULL),
(51, 4, 'Perangkat Lunak Desain ', 'Lingkup pembelajaran meliputi pengetahuan,keterampilan, dan sikap dalam mengoperasikan perangkat lunak sesuai kebutuhan dalam lingkup Desain Komunikasi Visual. Perangkat lunak yang digunakan disesuaikan dengan sub konsentrasi keahlian (peminatan) dalam lingkup Desain Komunikasi Visual: Print Design/Image Editing/Digital Imaging/ Vektor/Video Editing/Motion Graphic/ Desktop Publishing/Web & App Design/UI-UX Design/3D Software/dan lainnya yang terkait. ', NULL, NULL),
(52, 4, 'Menerapkan Design Brief ', 'Lingkup pembelajaran meliputi pengetahuan, keterampilan, dan sikap dalam menerima, membaca, memahami, dan melaksanakan perintah melalui panduan tertulis (brief) untuk suatu proyek desain yang diberikan oleh pemberi tugas. Kemampuan ini merupakan kompetensi yang menentukan penyelesaian tugas secara tepat. Secara umum, isi dari Design Brief meliputi latar belakang proyek, tujuan atau obyektif yang ingin dicapai, ruang lingkup pekerjaan, khalayak sasaran yang dituju, media yang digunakan, strategi kreatif dan konsep perancangan, tenggat waktu penyelesaian pekerjaan, serta para pihak yang terlibat dan peranannya dalam pekerjaan. ', NULL, NULL),
(53, 4, 'Karya Desain ', 'Lingkup pembelajaran meliputi pengetahuan,keterampilan, dan sikap dalam proses perancangan visual secara sistematis mulai dari pemahaman terhadap permasalahan, diskusi pencarian ide (brainstorming), pengembangan alternatif, hingga menjadi karya akhir. Proses tersebut dapat menggunakan metode design thinking maupun metode lainnya. Karya desain yang dihasilkan disesuaikan dengan sub konsentrasi keahlian (peminatan) dalam lingkup Desain Komunikasi Visual: Print Design/Videografi/Fotografi/Tipografi/Typeface Design/Story Boarding/Ilustrasi/Sequential Art/Motion Graphic/Web & App Design/UI-UX Design/Concept Art/Motion Graphic Design/Environmental Graphic Design/dan lainnya yang terkait. ', NULL, NULL),
(54, 4, 'Proses Produksi Desain ', 'Lingkup pembelajaran meliputi pengetahuan, keterampilan, dan sikap dalam penerapan produksi desain dan pengelolaan proses produksi, yang dimulai dari pra produksi, produksi, dan pasca produksi karya Desain Komunikasi Visual. Proses produksi desain disesuaikan dengan sub konsentrasi keahlian (peminatan) dalam lingkup Desain Komunikasi Visual: Print Design/Videografi/Fotografi/ Tipografi/Typeface Design/Story Boarding/ Ilustrasi/Sequential Art/Motion Graphic/Web & App Design/UI-UX Design/Concept Art/Motion Graphic Design/Environmental Graphic Design/dan lainnya yang terkait. ', NULL, NULL),
(55, 5, 'Sistem Kontrol Elektromekanik ', 'sistem grounding; penerapan komponen rangkaian kontrol elektromekanik; instalasi rangkaian kontrol elektromekanik; instalasi rangkaian kontrol ATS/AMF. ', NULL, NULL),
(56, 5, 'Sistem Kontrol Elektronik ', 'penerapan komponen dan instalasi rangkaian elektronika daya; setting parameter dan instalasi VSD; penerapan dan pemrograman mikrokontroler untuk sistem kontrol otomatis (berbasis IoT dan IIoT). ', NULL, NULL),
(57, 5, 'Piranti Sensor dan Aktuator Industri ', 'penerapan dan instalasi sensor (digital dan analog); penerapan dan instalasi aktuator elektrik ke input dan output modul kontrol. ', NULL, NULL),
(58, 5, 'Sistem Kontrol Elektro Pneumatik dan Hidrolik ', 'penerapan komponen dan instalasi rangkaian kontrol full dan elektro pneumatik; karakteristik komponen dan instalasi rangkaian hidrolik. ', NULL, NULL),
(59, 5, 'Sistem Kontrol Industri', 'Kontrol looping system, pemrograman dan instalasi sistem kontrol otomatis berbasis PLC, HMI, modul input/output analog, networking PLC, dan SCADA.', NULL, NULL),
(60, 5, 'Sistem Robot Industri', 'Konstruksi, pemrograman, dan pengoperasian sistem robot industri (handling system) menggunakan sensor, modul kontroler, dan motor stepper atau motor servo.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dudis`
--

CREATE TABLE `dudis` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembimbing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dudis`
--

INSERT INTO `dudis` (`id`, `username`, `password`, `pembimbing`, `nama`, `instansi`, `alamat`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'dudi1', '$2y$12$mwx.GFbLwYOnE.c0FTLzle2E9s.yq6kcLlITW0EtBdDpAvUliz8Da', 'Soekarno', 'PT. Telekomunikasi Indonesia Tbk', 'Telekomunikasi', 'Jl. Jend. Sudirman Kav. 52-53, Jakarta 12190', '021-1212121', '2024-07-24 17:19:17', '2024-07-25 08:53:30'),
(2, 'dudi2', '$2y$12$QIhIXKTe/ZW5tTNxylHBquasDSsMXJdJw8LHYYnJl5zbdvBBuucZ.', 'Habibie', 'PT. Bank Rakyat Indonesia (Persero) Tbk', 'Perbankan', 'Gedung BRI 1, Jl. Jenderal Sudirman Kav. 44-46, Jakarta 10210', '021-1212121', '2024-07-24 17:19:17', '2024-07-24 17:19:17'),
(3, 'dudi3', '$2y$12$RbWApQIEG8yrp2X2ST8PA..5TMx7MR4eBvexePL1C1OSqHI4WQnym', 'Sayuti', 'PT. Pertamina (Persero)', 'Minyak dan Gas', 'Gedung Pertamina, Jl. Medan Merdeka Timur No. 1A, Jakarta Pusat', '021-1212121', '2024-07-24 17:19:17', '2024-07-24 17:19:17'),
(4, 'dudi4', '$2y$12$iHeDvj8/HnqH4y3d3vI/Cur2ti5JqxLP8MuKzqH2Xpy0tm6gGrxje', 'Hatta', 'PT. Garuda Indonesia (Persero) Tbk', 'Transportasi Udara', 'Gedung Garuda Indonesia, Jl. Medan Merdeka Selatan No. 13, Jakarta 10110', '021-1212121', '2024-07-24 17:19:17', '2024-07-24 17:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `kode`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TBSM', 'Teknik Bisnis Sepeda Motor', 1, '2024-07-24 17:19:15', '2024-07-27 11:27:16'),
(2, 'TJKT', 'Teknik Jaringan Komputer dan Telekomunikasi', 1, '2024-07-24 17:19:15', '2024-07-25 04:13:29'),
(3, 'PPLG', 'Pengembangan Perangkat Lunak dan Gim', 1, '2024-07-24 17:19:15', '2024-07-24 17:19:15'),
(4, 'DKV', 'Desain Komunikasi Visual', 1, '2024-07-24 17:19:15', '2024-07-24 17:19:15'),
(5, 'TOI', 'Teknik Otomasi Industri', 1, '2024-07-24 17:19:15', '2024-07-24 17:19:15'),
(8, 'TOI-1', 'Teknik Otomasi Industri', 0, '2024-07-29 07:02:48', '2024-07-29 07:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan_id`, `kode`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'TBSM-1', 1, '2024-07-24 17:19:15', '2024-07-25 11:47:11'),
(2, 1, 'TBSM-2', 1, '2024-07-24 17:19:15', '2024-07-24 17:19:15'),
(3, 1, 'TBSM-3', 1, '2024-07-24 17:19:15', '2024-07-24 17:19:15'),
(19, 1, 'TBSM-4', 1, '2024-07-29 02:52:29', '2024-07-29 02:52:29'),
(20, 2, 'TJKT-1', 1, '2024-07-29 02:52:51', '2024-07-29 02:52:51'),
(21, 2, 'TJKT-2', 1, '2024-07-29 02:53:04', '2024-07-29 02:53:04'),
(22, 2, 'TJKT-3', 1, '2024-07-29 02:53:15', '2024-07-29 02:53:15'),
(23, 2, 'TJKT-4', 1, '2024-07-29 02:53:24', '2024-07-29 02:53:24'),
(24, 3, 'PPLG-1', 1, '2024-07-29 02:53:37', '2024-07-29 02:53:37'),
(25, 3, 'PPLG-2', 1, '2024-07-29 02:53:48', '2024-07-29 02:53:48'),
(26, 3, 'PPLG-3', 1, '2024-07-29 02:53:58', '2024-07-29 02:53:58'),
(27, 3, 'PPLG-4', 1, '2024-07-29 02:54:12', '2024-07-29 02:54:12'),
(28, 4, 'DKV-1', 1, '2024-07-29 02:54:25', '2024-07-29 02:54:25'),
(29, 4, 'DKV-2', 1, '2024-07-29 02:54:35', '2024-07-29 02:54:35'),
(30, 5, 'TOI-1', 1, '2024-07-29 02:54:45', '2024-07-29 06:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhirs`
--

CREATE TABLE `laporan_akhirs` (
  `id` bigint UNSIGNED NOT NULL,
  `pkl_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_akhirs`
--

INSERT INTO `laporan_akhirs` (`id`, `pkl_id`, `judul`, `dokumen`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(4, 11, 'akhir', 'bVnkqjhTxYRjFb6m0eNXnsoz0MYN4WupSmK0WeNA.pdf', NULL, '1', '2024-07-29 04:15:28', '2024-07-29 04:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harians`
--

CREATE TABLE `laporan_harians` (
  `id` bigint UNSIGNED NOT NULL,
  `pkl_id` bigint UNSIGNED NOT NULL,
  `cp_id` json NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_karakter` json NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_harians`
--

INSERT INTO `laporan_harians` (`id`, `pkl_id`, `cp_id`, `tanggal`, `deskripsi`, `dokumentasi`, `nilai_karakter`, `status`, `created_at`, `updated_at`) VALUES
(8, 11, '[\"2\", \"3\"]', '2024-07-29', 'laporan', '1722222378.jpg', '[\"Religius\", \"Toleran\"]', '1', '2024-07-29 03:06:19', '2024-07-29 04:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_proyeks`
--

CREATE TABLE `laporan_proyeks` (
  `id` bigint UNSIGNED NOT NULL,
  `pkl_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `saran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `dokumentasi` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_proyeks`
--

INSERT INTO `laporan_proyeks` (`id`, `pkl_id`, `judul`, `tanggal`, `deskripsi`, `saran`, `catatan`, `status`, `dokumentasi`, `created_at`, `updated_at`) VALUES
(6, 11, 'proyek', '2024-07-28', 'laporan', 'laporan', NULL, '1', '\"1722222436.jpg\"', '2024-07-29 03:07:16', '2024-07-29 04:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_18_041824_create_pengaturans_table', 1),
(6, '2024_05_18_042209_create_jurusans_table', 1),
(7, '2024_05_18_042607_create_kelas_table', 1),
(8, '2024_05_18_043214_create_siswas_table', 1),
(9, '2024_05_18_043957_create_dudis_table', 1),
(10, '2024_05_18_044400_create_pkls_table', 1),
(11, '2024_05_18_044918_create_cps_table', 1),
(12, '2024_05_18_050013_create_laporan_harians_table', 1),
(13, '2024_05_18_050246_create_laporan_proyeks_table', 1),
(14, '2024_05_18_054350_create_laporan_akhirs_table', 1),
(15, '2024_05_18_054805_create_nilai_dudis_table', 1),
(16, '2024_05_18_055359_create_nilai_pembimbings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_dudis`
--

CREATE TABLE `nilai_dudis` (
  `id` bigint UNSIGNED NOT NULL,
  `pkl_id` bigint UNSIGNED NOT NULL,
  `prestasi_kerja` int NOT NULL,
  `kehadiran_dan_disiplin` int NOT NULL,
  `inisiatif_dan_kreatifitas` int NOT NULL,
  `kerjasama` int NOT NULL,
  `tanggung_jawab` int NOT NULL,
  `sikap` int NOT NULL,
  `kompetensi_keahlian` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pembimbings`
--

CREATE TABLE `nilai_pembimbings` (
  `id` bigint UNSIGNED NOT NULL,
  `pkl_id` bigint UNSIGNED NOT NULL,
  `nilai_pelaksanaan` int NOT NULL,
  `nilai_laporan` int NOT NULL,
  `nilai_sertifikat` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturans`
--

CREATE TABLE `pengaturans` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_panduan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `persentase_nilai_pelaksanaan` int NOT NULL,
  `persentase_nilai_laporan` int NOT NULL,
  `persentase_nilai_sertifikat` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturans`
--

INSERT INTO `pengaturans` (`id`, `buku_panduan`, `persentase_nilai_pelaksanaan`, `persentase_nilai_laporan`, `persentase_nilai_sertifikat`, `created_at`, `updated_at`) VALUES
(1, 'oLRU46XqDPgC8qpJO0GuhYWdbG8VeMbgtsXmI3BJ.pdf', 10, 40, 50, '2024-07-25 04:46:29', '2024-07-29 06:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pkls`
--

CREATE TABLE `pkls` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `dudi_id` bigint UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `posisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkls`
--

INSERT INTO `pkls` (`id`, `siswa_id`, `user_id`, `dudi_id`, `tanggal_mulai`, `tanggal_selesai`, `posisi`, `created_at`, `updated_at`) VALUES
(11, 41, 2, 1, '2024-07-29', '2024-07-30', 'IT', '2024-07-29 02:56:18', '2024-07-29 02:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'smk42024',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `angkatan` year NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `kelas_id`, `nis`, `nama`, `password`, `alamat`, `telepon`, `tempat_lahir`, `tanggal_lahir`, `angkatan`, `status`, `created_at`, `updated_at`) VALUES
(41, 1, '20240060', 'Siswa 60', '$2y$12$YoAE5VeQS3IXV9e7AIYZC.NuxYLHCNDnuOIEyLxGt9Nep5wlkB4Oa', 'Alamat siswa 2', '8123456789', 'Tempat Lahir Siswa 2', '2008-03-19', '2024', 1, '2024-07-29 02:55:17', '2024-07-29 06:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru_pembimbing','tata_usaha') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama`, `email`, `password`, `telepon`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '4427338300306690', 'Naufal My', 'naufalmy@gmail.com', '$2y$12$g4HJsqM8Rzt4.zheKEzVPOZCyvxyE5YEPgRWA6D2BDl/lkAVFWaSG', '081234567890', 'admin', 1, NULL, '2024-07-24 17:19:15', '2024-07-26 09:43:56'),
(2, '0053499114175180', 'Vina Lestari', 'vina@gmail.com', '$2y$12$ZrT9DHoO6Anr6Gyy9xcFl.s2XWttkRgxXVdbwgEIkLdOGn.e8iQxq', '081234567890', 'guru_pembimbing', 1, NULL, '2024-07-24 17:19:15', '2024-07-25 06:55:24'),
(3, '9289654790826939', 'Naufal Af', 'naufalaf@gmail.com', '$2y$12$xhwv7t8yaPjoLkUr4rYk1uhVIcNGK4cf0IeX63boV9D/3O2woDnrO', '081234567890', 'guru_pembimbing', 0, NULL, '2024-07-24 17:19:15', '2024-07-29 02:56:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cps`
--
ALTER TABLE `cps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cps_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `dudis`
--
ALTER TABLE `dudis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dudis_username_unique` (`username`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusans_kode_unique` (`kode`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_kode_unique` (`kode`),
  ADD KEY `kelas_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_akhirs_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_harians_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_proyeks_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_dudis`
--
ALTER TABLE `nilai_dudis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_dudis_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `nilai_pembimbings`
--
ALTER TABLE `nilai_pembimbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_pembimbings_pkl_id_foreign` (`pkl_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaturans`
--
ALTER TABLE `pengaturans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pkls`
--
ALTER TABLE `pkls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkls_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pkls_user_id_foreign` (`user_id`),
  ADD KEY `pkls_dudi_id_foreign` (`dudi_id`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cps`
--
ALTER TABLE `cps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `dudis`
--
ALTER TABLE `dudis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nilai_dudis`
--
ALTER TABLE `nilai_dudis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai_pembimbings`
--
ALTER TABLE `nilai_pembimbings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaturans`
--
ALTER TABLE `pengaturans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pkls`
--
ALTER TABLE `pkls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cps`
--
ALTER TABLE `cps`
  ADD CONSTRAINT `cps_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`);

--
-- Constraints for table `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  ADD CONSTRAINT `laporan_akhirs_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`);

--
-- Constraints for table `laporan_harians`
--
ALTER TABLE `laporan_harians`
  ADD CONSTRAINT `laporan_harians_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`);

--
-- Constraints for table `laporan_proyeks`
--
ALTER TABLE `laporan_proyeks`
  ADD CONSTRAINT `laporan_proyeks_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`);

--
-- Constraints for table `nilai_dudis`
--
ALTER TABLE `nilai_dudis`
  ADD CONSTRAINT `nilai_dudis_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`);

--
-- Constraints for table `nilai_pembimbings`
--
ALTER TABLE `nilai_pembimbings`
  ADD CONSTRAINT `nilai_pembimbings_pkl_id_foreign` FOREIGN KEY (`pkl_id`) REFERENCES `pkls` (`id`);

--
-- Constraints for table `pkls`
--
ALTER TABLE `pkls`
  ADD CONSTRAINT `pkls_dudi_id_foreign` FOREIGN KEY (`dudi_id`) REFERENCES `dudis` (`id`),
  ADD CONSTRAINT `pkls_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`),
  ADD CONSTRAINT `pkls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
