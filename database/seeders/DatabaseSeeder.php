<?php

namespace Database\Seeders;

use App\Models\Cp;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $users = [
            [
                'nik' => $this->generateRandomNik(),
                'nama' => 'Naufal My',
                'email' => 'naufalmy@gmail.com',
                'password' => Hash::make('11221122'),
                'telepon' => '081234567890',
                'role' => 'admin',
            ],
            [
                'nik' => $this->generateRandomNik(),
                'nama' => 'Vina Lestari',
                'email' => 'vina@gmail.com',
                'password' => Hash::make('11221122'),
                'telepon' => '081234567890',
                'role' => 'guru_pembimbing',
            ],
            [
                'nik' => $this->generateRandomNik(),
                'nama' => 'Naufal Af',
                'email' => 'naufalaf@gmail.com',
                'password' => Hash::make('11221122'),
                'telepon' => '081234567890',
                'role' => 'guru_pembimbing',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $dataJurusan = [
            [
                'kode' => 'TBSM',
                'nama' => 'Teknik Bisnis Sepeda Motor',
            ],
            [
                'kode' => 'TJKT',
                'nama' => 'Teknik Jaringan Komputer dan Telekomunikasi',
            ],
            [
                'kode' => 'PPLG',
                'nama' => 'Pengembangan Perangkat Lunak dan Gim',
            ],
            [
                'kode' => 'DKV',
                'nama' => 'Desain Komunikasi Visual',
            ],
            [
                'kode' => 'TOI',
                'nama' => 'Teknik Otomasi Industri',
            ],
        ];

        $jurusans = collect();
        foreach ($dataJurusan as $jurusanData) {
            $jurusan = Jurusan::create($jurusanData);
            $jurusans->push($jurusan);
        }

        foreach ($jurusans as $jurusan) {
            for ($i = 1; $i <= 3; $i++) {
                $kode = $jurusan->kode . '-' . $i;
                $nama = 'Kelas ' . $i . ' ' . $jurusan->nama;
                Kelas::create([
                    'jurusan_id' => $jurusan->id,
                    'kode' => $kode,
                    'nama' => $nama,
                ]);
            }
        }

        $dataDudi = [
            [
                'username' => 'dudi1',
                'password' => Hash::make('password'),
                'nama' => 'PT. Telekomunikasi Indonesia Tbk',
                'instansi' => 'Telekomunikasi',
                'alamat' => 'Jl. Jend. Sudirman Kav. 52-53, Jakarta 12190',
                'telepon' => '021-1212121',
            ],
            [
                'username' => 'dudi2',
                'password' => Hash::make('password'),
                'nama' => 'PT. Bank Rakyat Indonesia (Persero) Tbk',
                'instansi' => 'Perbankan',
                'alamat' => 'Gedung BRI 1, Jl. Jenderal Sudirman Kav. 44-46, Jakarta 10210',
                'telepon' => '021-1212121',
            ],
            [
                'username' => 'dudi3',
                'password' => Hash::make('password'),
                'nama' => 'PT. Pertamina (Persero)',
                'instansi' => 'Minyak dan Gas',
                'alamat' => 'Gedung Pertamina, Jl. Medan Merdeka Timur No. 1A, Jakarta Pusat',
                'telepon' => '021-1212121',
            ],
            [
                'username' => 'dudi4',
                'password' => Hash::make('password'),
                'nama' => 'PT. Garuda Indonesia (Persero) Tbk',
                'instansi' => 'Transportasi Udara',
                'alamat' => 'Gedung Garuda Indonesia, Jl. Medan Merdeka Selatan No. 13, Jakarta 10110',
                'telepon' => '021-1212121',
            ],
            [
                'username' => 'dudi5',
                'password' => Hash::make('password'),
                'nama' => 'PT. Freeport Indonesia',
                'instansi' => 'Pertambangan',
                'alamat' => 'Gedung Freeport Indonesia, Jl. HR Rasuna Said Kav. X-5 No. 1-2, Jakarta 12950',
                'telepon' => '021-1212121',
            ],
        ];

        foreach ($dataDudi as $dudi) {
            Dudi::create($dudi);
        }

        $kelas = Kelas::all();

        $nimBase = date('Y') . '0000';

        for ($i = 1; $i <= 30; $i++) {
            $kelasRandom = $kelas->random();
            $nim = $nimBase + $i;

            Siswa::create([
                'kelas_id' => $kelasRandom->id,
                'nis' => $nim,
                'nama' => 'Siswa ' . $i,
                'password' => bcrypt('password'),
                'alamat' => 'Alamat siswa ' . $i,
                'telepon' => '08123456789',
                'tempat_lahir' => 'Tempat Lahir Siswa ' . $i,
                'angkatan' => date('Y'),
                'tanggal_lahir' => now()->subYears(rand(15, 18))->subMonths(rand(0, 11))->subDays(rand(0, 30)),
            ]);
        }

        $cps = [
            ["jurusan_id" => "1", "elemen" => "Proses bisnis bidang otomotif secara menyeluruh ", "deskripsi" => "Meliputi proses bisnis bidang otomotif secara menyeluruh pada berbagai jenis dan merk kendaraan, serta pengelolaan sumber daya manusia dengan memperhatikan potensi dan kearifan lokal. "],
            ["jurusan_id" => "1", "elemen" => "Perkembangan teknologi otomotif dan dunia kerja serta isu-isu global ", "deskripsi" => "Meliputi perkembangan teknologi otomotif dan dunia kerja serta isu-isu global terkait dunia otomotif. "],
            ["jurusan_id" => "1", "elemen" => "Profesi dan kewirausahaan (job-profile dan technopreneurship), serta peluang usaha di bidang otomotif. ", "deskripsi" => "Meliputi profesi dan kewirausahaan (job-profile dan technopreneurship) serta peluang usaha di bidang otomotif. "],
            ["jurusan_id" => "1", "elemen" => "Keselamatan dan Kesehatan Kerja serta Lingkungan Hidup (K3LH) dan budaya kerja industri ", "deskripsi" => "Meliputi penerapan K3LH dan budaya kerja industri,antara lain: praktik-praktik kerja yang aman, bahaya-bahaya di tempat kerja, prosedur-prosedur dalam keadaan darurat, dan penerapan budaya kerja industri, seperti 5R (Ringkas, Rapi, Resik, Rawat, Rajin), dan etika kerja. "],
            ["jurusan_id" => "1", "elemen" => "Teknik dasar pemeliharaan dan perbaikan yang terkait dengan seluruh proses bidang otomotif. ", "deskripsi" => "Meliputi praktik dasar yang terkait dengan seluruh proses bidang otomotif, antara lain penggunaan alat ukur, pemeliharaan, perbaikan, pembentukan bodi kendaraan, perakitan, serta pengenalan alat berat, dump-truck, dan sejenisnya. "],
            ["jurusan_id" => "1", "elemen" => "Gambar teknik ", "deskripsi" => "Meliputi menggambar teknik dasar, termasuk pengenalan macam-macam peralatan gambar, standarisasi dalam pembuatan gambar, serta praktik menggambar dan membaca gambar teknik, dan menentukan letak dan posisi komponen otomotif berdasarkan gambar buku manual. "],
            ["jurusan_id" => "1", "elemen" => "Peralatan dan perlengkapan tempat kerja ", "deskripsi" => "Meliputi penggunaan peralatan dan perlengkapan tempat kerja antara lain alat-alat tangan (tools), alat ukur, perlengkapan bengkel (equipment), Special Service Tools (SST) serta alat pengangkat. "],
            ["jurusan_id" => "1", "elemen" => "Pemeliharaan komponen otomotif ", "deskripsi" => "Meliputi pemeliharaan dan penggantian komponen otomotif mencakup dan tidak terbatas pada engine, chasis kelistrikan, dan bodi kendaraan. "],
            ["jurusan_id" => "1", "elemen" => "Dasar elektronika otomotif ", "deskripsi" => "Meliputi pembuatan rangkaian elektronika dasar,termasuk pemahaman fungsi dan cara kerja komponen- komponen elektronika dasar, perakitan, gangguan rangkaian komponen-komponen elektronika dasar, perawatan komponen komponen elektronika dasar, serta pematrian komponen sesuai prosedur manual perbaikan "],
            ["jurusan_id" => "1", "elemen" => "Dasar sistem hidrolik dan pneumatic ", "deskripsi" => "Meliputi prinsip dasar sistem hidrolik dan penumatik, termasuk komponen sistem hidrolik dan pneumatik. "],
            ["jurusan_id" => "1", "elemen" => "Perawatan dan Perbaikan Engine Sepeda Motor ", "deskripsi" => "proses perawatan dan perbaikan engine sepeda motor beserta komponen-komponennya secara menyeluruh pada berbagai jenis dan merek sepeda motor "],
            ["jurusan_id" => "1", "elemen" => "Perawatan dan Perbaikan Sasis Sepeda Motor ", "deskripsi" => "proses perawatan dan perbaikan sasis sepeda motor dan komponen-komponennya secara menyeluruh pada berbagai jenis dan merek sepeda motor "],
            ["jurusan_id" => "1", "elemen" => "Perawatan dan Perbaikan Sistem Pemindah Tenaga Sepeda Motor ", "deskripsi" => "proses perawatan dan perbaikan sistem pemindah tenaga sepeda motor beserta komponen-komponennya secara menyeluruh pada berbagai jenis dan merek sepeda motor "],
            ["jurusan_id" => "1", "elemen" => "Perawatan dan Perbaikan Sistem Kelistrikan Sepeda Motor. ", "deskripsi" => "proses perawatan dan perbaikan sistem kelistrikan sepeda motor secara menyeluruh pada berbagai jenis dan merek sepeda motor "],
            ["jurusan_id" => "1", "elemen" => "Perawatan dan Perbaikan Sepeda Motor Listrik dan Hybrid ", "deskripsi" => "proses perawatan dan perbaikan sepeda motor listrik dan hybrid secara menyeluruh pada berbagai jenis dan merek sepeda motor "],
            ["jurusan_id" => "1", "elemen" => "Perawatan dan Perbaikan Engine Management System Sepeda Motor ", "deskripsi" => "proses perawatan dan perbaikan engine management system sepeda motor secara menyeluruh pada berbagai jenis dan merek mepeda motor "],
            ["jurusan_id" => "1", "elemen" => "Pengelolaan Bengkel Sepeda Motor ", "deskripsi" => "proses pengelolaan dan pengembangan teknik serta manajemen perawatan sepeda motor secara menyeluruh pada berbagai jenis dan merek sepeda motor "],
            ["jurusan_id" => "2", "elemen" => "Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH) dan budaya kerja industri ", "deskripsi" => "Meliputi penerapan K3LH dan budaya kerja industri, antara lain: praktik-praktik kerja yang aman, bahaya-bahaya di tempat kerja, prosedur-prosedur dalamkeadaan darurat, dan penerapan budaya kerja industri (Ringkas, Rapi, Resik, Rawat, Rajin), termasuk pencegahan kecelakaan kerja di tempat tinggi dan prosedur kerja di tempat tinggi (pemanjatan) "],
            ["jurusan_id" => "2", "elemen" => "Dasar-dasar teknik jaringan komputer dan telekomunikasi ", "deskripsi" => "Meliputi pemahaman dasar penggunaan dan konfigurasi peralatan/teknologi di bidang jaringan komputer dan telekomunikasi. "],
            ["jurusan_id" => "2", "elemen" => "Media dan Jaringan Telekomunikasi ", "deskripsi" => "Meliputi pemahaman prinsip dasar sistem IPV4/IPV6, TCP IP, Networking Service, Sistem Keamanan Jaringan Telekomunikasi, Sistem Seluler, Sistem Microwave, Sistem VSAT IP, Sistem Optik, dan Sistem WLAN. "],
            ["jurusan_id" => "2", "elemen" => "Penggunaan Alat Ukur Jaringan ", "deskripsi" => "Meliputi pemahaman tentang jenis alat ukur dan penggunaannya dalam pemeliharaan jaringan komputer dan sistem telekomunikasi. "],
            ["jurusan_id" => "2", "elemen" => "Perencanaan dan Pengalamatan Jaringan ", "deskripsi" => "Meliputi perencanaan topologi dan arsitektur jaringan, pengumpulan kebutuhan teknis pengguna yang menggunakan jaringan, pengumpulan data peralatan jaringan dengan teknologi yang sesuai, pengalamatan jaringan CIDR, VLSM, dan subnetting "],
            ["jurusan_id" => "2", "elemen" => "Teknologi Jaringan Kabel dan Nirkabel ", "deskripsi" => "Meliputi instalasi jaringan kabel dan nirkabel, pengujian, perawatan dan perbaikan jaringan kabel dan nirkabel, standar jaringan nirkabel, jenis-jenis teknologi jaringan nirkabel indoor dan outdoor, teknologi layanan Voice over IP (VoIP), jaringan fiber optic, jenis-jenis kabel fiber optic, fungsi alat kerja fiber optic, sambungan fiber optic, dan perbaikan jaringan fiber optic "],
            ["jurusan_id" => "2", "elemen" => "Keamanan Jaringan ", "deskripsi" => "Meliputi kebijakan penggunaan jaringan, ancaman dan serangan terhadap keamanan jaringan, penentuan sistem keamanan jaringan yang dibutuhkan, firewall pada host dan server, kebutuhan persyaratan alat-alat untuk membangun server firewall, konsep dan implementasi firewall di host dan server, fungsi dan cara kerja server autentifikasi, kebutuhan persyaratan alat-alat untuk membangun server autentifikasi, cara kerja sistem pendeteksi dan penahan ancaman/ serangan yang masuk ke jaringan, analisis fungsi dan tata cara pengamanan server-server layanan pada jaringan, dan tata cara pengamanan komunikasi data menggunakan teknik kriptografi "],
            ["jurusan_id" => "2", "elemen" => "Pemasangan dan Konfigurasi Perangkat Jaringan ", "deskripsi" => "Meliputi pemasangan perangkat jaringan ke dalam sistem jaringan, penggantian perangkat jaringan sesuai dengan kebutuhan, konsep VLAN, konfigurasi dan pengujian VLAN, proses routing, jenis-jenis routing, konfigurasi, analisis permasalahan dan perbaikan konfigurasi routing statis dan routing dinamis, konfigurasi NAT, analisis permasalahan internet gateway dan perbaikan konfigurasi NAT, konfigurasi, analisis permasalahan dan perbaikan konfigurasi proxy server, manajemen bandwidth dan load balancing "],
            ["jurusan_id" => "2", "elemen" => "Administrasi Sistem Jaringan ", "deskripsi" => "Meliputi instalasi sistem operasi jaringan, konsep, instalasi services, konfigurasi, dan pengujian konfigurasi remote server, DHCP server, DNS server, FTP server, file server, web server, mail server, database server, Control Panel Hosting, Share Hosting Server, Dedicated Hosting Server, Virtual Private Server, VPN server, sistem kontrol, dan monitoring "],
            ["jurusan_id" => "3", "elemen" => "Proses bisnis menyeluruh bidang pengembangan perangkat lunak dan gim ", "deskripsi" => "Meliputi perencanaan, analisis, desain, implementasi, integrasi, pemeliharaan, pemasaran, dan distribusi perangkat lunak dan gim termasuk di dalamnya adalah penerapan budaya mutu, Keselamatan dan Kesehatan Kerja serta Lingkungan Hidup (K3LH), manajemen proyek, serta pemahaman terhadap kebutuhan pelanggan, keinginan pelanggan, dan validasi sesuai dengan User Experience (UX). "],
            ["jurusan_id" => "3", "elemen" => "Perkembangan dunia kerja bidang perangkat lunak dan gim ", "deskripsi" => "Meliputi perkembangan teknologi pada pengembangan perangkat lunak dan gim termasuk penerapan industri 4.0 pada manajemen pengembangan perangkat lunak dan gim serta isu-isu penting bidang pengembangan perangkat lunak dan gim. Contohnya dampak positif dan negatif gim, IoT, Cloud Computing, Big Data, Information Security, HAKI (Hak Atas Kekayaan Intelektual) dan pelanggaran HAKI. "],
            ["jurusan_id" => "3", "elemen" => "Profesi dan kewirausahan (job profile dan technopreneurship) serta peluang usaha di bidang industri perangkat lunak dan gim ", "deskripsi" => "Meliputi jenis-jenis profesi dan kewirausahan (job profile dan technopreneurship), personal branding serta peluang usaha di bidang industri perangkat lunak dan gim. "],
            ["jurusan_id" => "3", "elemen" => "Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH) dan budaya kerja industri ", "deskripsi" => "Meliputi penerapan K3LH dan budaya kerja industri, antara lain: praktik-praktik kerja yang aman, bahaya-bahaya di tempat kerja, prosedur-prosedur dalam keadaan darurat, dan penerapan budaya kerja industri (Ringkas, Rapi, Resik, Rawat, Rajin), termasuk pencegahan kecelakaan kerja dan prosedur kerja "],
            ["jurusan_id" => "3", "elemen" => "Orientasi dasar pengembangan perangkat lunak dan gim ", "deskripsi" => "Meliputi kegiatan praktik singkat dengan menggunakan peralatan/teknologi di bidang pengembangan perangkat lunak dan gim seperti basis data, tools pengembangan perangkat lunak, ragam sistem operasi, pengelolaan aset, user interface (grafis, typography, warna, audio, video, interaksi pengguna) dan prinsip dasar algoritma pemrograman (varian dan invarian, alur logika pemrograman, flowchart, dan teknik dasar algoritma umum) "],
            ["jurusan_id" => "3", "elemen" => "Pemrograman terstruktur ", "deskripsi" => "Meliputi konsep atau sudut pandang pemrograman yang membagi-bagi program berdasarkan fungsi atau prosedur yang dibutuhkan program komputer, pengenalan struktur data yang terdiri dari data statis (array baik dimensi, panjang, tipe data, pengurutan) dan data dinamis (list, stack), penggunaan tipe data, struktur kontrol perulangan dan percabangan "],
            ["jurusan_id" => "3", "elemen" => "Pemrograman berorientasi obyek ", "deskripsi" => "Meliputi penggunaan prosedur dan fungsi, class, obyek, method, package, accessmodifier, enkapsulasi, interface, pewarisan, dan polymorphism "],
            ["jurusan_id" => "3", "elemen" => "Basis Data ", "deskripsi" => "Meliputi konsep dan implementasi struktur, hirarki, aturan, komponen, instalasi, dan dasar administrasi basis data serta Data Definition Language, Data Manipulation Language, Data Control Language, perintah bertingkat, function and stored procedure, trigger, backup, restore, dan replikasi pada pengelolaan basis data. "],
            ["jurusan_id" => "3", "elemen" => "Pemrograman Berbasis Teks, Grafis, dan Multimedia ", "deskripsi" => "Meliputi konsep atau sudut pandang pemrograman yang membagi-bagi program berdasarkan pemrograman terstruktur dan pemrograman berorientasi objek tingkat lanjut, dasar pemodelan perangkat lunak berorientasi objek, objek multimedia dalam aplikasi serta pemrograman antar muka grafis (Graphical User Interface) dengan memanfaatkan pustaka (library) yang tersedia pada bahasa pemrograman untuk beragam kebutuhan. "],
            ["jurusan_id" => "3", "elemen" => "Pemrograman Web ", "deskripsi" => "Meliputi konsep dan implementasi perintah HTML, CSS, pemrograman Javascript, bahasa pemrograman server-side serta implementasi framework pada pembuatan web statis dan dinamis untuk beragam kebutuhan. "],
            ["jurusan_id" => "3", "elemen" => "Pemrograman Perangkat Bergerak ", "deskripsi" => "Meliputi pengertian, sejarah, dan komponen dalam sistem operasi perangkat bergerak serta pengembangan aplikasinya, konsep dan implementasi Integrated Development Environment, framework dan bahasa pemrograman untuk pengembangan aplikasi perangkat bergerak, basis data perangkat bergerak serta antarmuka aplikasi yang saling berhubungan dengan aplikasi lainnya (Application Programming Interface) "],
            ["jurusan_id" => "3", "elemen" => "Pemodelan Gim ", "deskripsi" => "Meliputi konsep perancangan video game, mencakup ide konsep gim (game concept), dokumen desain gim (game design document), desain mekanika gim (game mechanic concept), desain sistem gim (game system concept), desain teknik gim (game technical concept), desain level gim (game level concept), desain narasi gim (game narrative concept), riset pengguna gim (game user research concept), desain purwarupa gim (game design prototype) dan desain keseimbangan gim (game design balancing) dan implementasinya. "],
            ["jurusan_id" => "3", "elemen" => "Pemrograman Gim ", "deskripsi" => "Meliputi konsep dan implementasi pemrograman berbasis teks dan grafis yang diintegrasikan pada pemrograman gim (game engine) mencakup pemrograman ke dalam bentuk gameplay, implementasi UI/UX (graphical user interface), struktur data, integrasi objek statis dan dinamis (static and dynamic assets integration), fungsionalitas tambahan pada game engine (tools and plugin implementation), serta pengujian dan peningkatan kualitas perangkat lunak melalui debugging, optimasi kinerja gim, dan pembaharuan perangkat lunak. "],
            ["jurusan_id" => "3", "elemen" => "Komputer Grafis dan Multimedia ", "deskripsi" => "Meliputi konsep visual gim mencakup desain konsep artistik (key concept art), dokumen perancangan artistik (art design document), desain karakter (character design), desain latar belakang (environment design), desain properti (properti design), konsep dan implementasi komputer grafis dan multimedia mencakup 2D puppeteer (cut out animation), model 3D dengan teknik digital sculpting, tekstur permukaan 3D (texturing), struktur/kerangka sistem mekanika objek/benda/karakter (rigging), akting pergerakan karakter, simulasi gerak digital benda (rigid/soft body) dan sifat bahan 3D (shading). "],
            ["jurusan_id" => "3", "elemen" => "Audio Editing ", "deskripsi" => "Meliputi konsep dan implementasi perencanaan kebutuhan aset audio, perekaman suara (dubbing), serta pengembangan aset audio (efek suara dan musik latar). "],
            ["jurusan_id" => "4", "elemen" => "Profil technopreneur, peluang usaha dan pekerjaan/profesi bidang Desain Komunikasi Visual ", "deskripsi" => "Lingkup pembelajaran meliputi technopreneur dalam bidang Desain Komunikasi Visual, dan kewirausahaan serta peluang usaha di bidang seni dan ekonomi kreatif yang mampu membaca peluang pasar dan usaha, untuk membangun visi dan passion, serta melakukan pembelajaran berbasis projek nyata sebagai simulasi projek/PjBL kewirausahaan. "],
            ["jurusan_id" => "4", "elemen" => "Proses bisnis berbagai industri di bidang Desain Komunikasi Visual ", "deskripsi" => "Lingkup pembelajaran meliputi pemahaman peserta didik tentang K3 di bidang Desain Komunikasi Visual, proses produksi di industri, pengetahuan tentang kepribadian yang dibutuhkan agar dapat mengembangkan pola pikir kreatif, proses kreasi untuk menghasilkan solusi desain yang tepat sasaran, aspek perawatan peralatan, potensi lokal dan kearifan lokal, dan pengelolaan SDM di industri. "],
            ["jurusan_id" => "4", "elemen" => "Perkembangan teknologi di industri dan dunia kerja serta isu-isu global pada bidang Desain Komunikasi Visual ", "deskripsi" => "Lingkup pembelajaran meliputi pemahaman peserta didik tentang perkembangan proses produksi industri Desain Komunikasi Visual mulai dari teknologi konvensional sampai dengan teknologi modern, Industri 4.0, Internet of Things, digital teknologi dalam dunia industri, isu pemanasan global, perubahan iklim, aspek-aspek ketenagakerjaan, Life Cycle produk industri sampai dengan reuse, recycling. "],
            ["jurusan_id" => "4", "elemen" => "Teknik dasar proses produksi pada industri Desain Komunikasi Visual ", "deskripsi" => "kepribadian yang dibutuhkan peserta didik agar dapat mengembangkan pola pikir kreatif melalui praktek secara mandiri dengan berpikir kritis tentang seluruh proses produksi dan teknologi serta budaya kerja yang diaplikasikan dalam industri DKV. "],
            ["jurusan_id" => "4", "elemen" => "Sketsa dan Ilustrasi ", "deskripsi" => "Lingkup pembelajaran meliputi fungsi sketsa dan ilustrasi dalam dunia Desain Komunikasi Visual beserta penguasaan teknik keterampilan membuat sketsa dan ilustrasi untuk kebutuhan dasar rancangan desain. "],
            ["jurusan_id" => "4", "elemen" => "Komposisi typography ", "deskripsi" => "Lingkup pembelajaran meliputi sejarah huruf, pengertian huruf, jenis-jenis huruf, anatomi huruf, karakter huruf, dan fungsi huruf. Penguasaan keterampilan dalam menghadirkan komposisi tipografi tentang hirarki, leading, tracking, dan kerning. ilustrasi untuk kebutuhan dasar rancangan desain. "],
            ["jurusan_id" => "4", "elemen" => "Fotografi dasar ", "deskripsi" => "Lingkup pembelajaran meliputi dasar-dasar fotografi, prinsip, estetika fotografi, dan prosedur penggunaan peralatan fotografi seperti kamera, peralatan studio fotografi, dan dapat mengidentifikasi alat yang digunakan dalam pemotretan. Menerapkan pengetahuan dan keterampilan fotografi baik penggunaan peralatan di dalam studio dan luar studio. "],
            ["jurusan_id" => "4", "elemen" => "Komputer grafis ", "deskripsi" => "Lingkup pembelajaran meliputi jenis-jenis perangkat lunak komputer grafis berbasis bitmap dan vector yang dibutuhkan dalam eksekusi desain komunikasi visual. Menerapkan keterampilan dasar tentang penggunaan tools, menu, dan klasifikasi warna dalam RGB dan CMYK untuk proses produksi manual dan digital. "],
            ["jurusan_id" => "4", "elemen" => "Prinsip Dasar Desain dan Komunikasi ", "deskripsi" => "Lingkup pembelajaran meliputi pengetahuan,keterampilan, dan sikap dalam menerapkan prinsip dasar desain- untuk merancang visual, di antaranya: kesatuan (unity), keseimbangan (balance), Komposisi (komposition), proposi (proportion), irama (rhythm), penekanan (emphasis),kesederhanaan (simplicity), kejelasan (clarity), ruang (space). Membangun kemampuan dalam memahami dan menerapkan peran komunikator, komunikan, dan media komunikasi dalam perancangan komunikasi visual. "],
            ["jurusan_id" => "4", "elemen" => "Perangkat Lunak Desain ", "deskripsi" => "Lingkup pembelajaran meliputi pengetahuan,keterampilan, dan sikap dalam mengoperasikan perangkat lunak sesuai kebutuhan dalam lingkup Desain Komunikasi Visual. Perangkat lunak yang digunakan disesuaikan dengan sub konsentrasi keahlian (peminatan) dalam lingkup Desain Komunikasi Visual: Print Design/Image Editing/Digital Imaging/ Vektor/Video Editing/Motion Graphic/ Desktop Publishing/Web & App Design/UI-UX Design/3D Software/dan lainnya yang terkait. "],
            ["jurusan_id" => "4", "elemen" => "Menerapkan Design Brief ", "deskripsi" => "Lingkup pembelajaran meliputi pengetahuan, keterampilan, dan sikap dalam menerima, membaca, memahami, dan melaksanakan perintah melalui panduan tertulis (brief) untuk suatu proyek desain yang diberikan oleh pemberi tugas. Kemampuan ini merupakan kompetensi yang menentukan penyelesaian tugas secara tepat. Secara umum, isi dari Design Brief meliputi latar belakang proyek, tujuan atau obyektif yang ingin dicapai, ruang lingkup pekerjaan, khalayak sasaran yang dituju, media yang digunakan, strategi kreatif dan konsep perancangan, tenggat waktu penyelesaian pekerjaan, serta para pihak yang terlibat dan peranannya dalam pekerjaan. "],
            ["jurusan_id" => "4", "elemen" => "Karya Desain ", "deskripsi" => "Lingkup pembelajaran meliputi pengetahuan,keterampilan, dan sikap dalam proses perancangan visual secara sistematis mulai dari pemahaman terhadap permasalahan, diskusi pencarian ide (brainstorming), pengembangan alternatif, hingga menjadi karya akhir. Proses tersebut dapat menggunakan metode design thinking maupun metode lainnya. Karya desain yang dihasilkan disesuaikan dengan sub konsentrasi keahlian (peminatan) dalam lingkup Desain Komunikasi Visual: Print Design/Videografi/Fotografi/Tipografi/Typeface Design/Story Boarding/Ilustrasi/Sequential Art/Motion Graphic/Web & App Design/UI-UX Design/Concept Art/Motion Graphic Design/Environmental Graphic Design/dan lainnya yang terkait. "],
            ["jurusan_id" => "4", "elemen" => "Proses Produksi Desain ", "deskripsi" => "Lingkup pembelajaran meliputi pengetahuan, keterampilan, dan sikap dalam penerapan produksi desain dan pengelolaan proses produksi, yang dimulai dari pra produksi, produksi, dan pasca produksi karya Desain Komunikasi Visual. Proses produksi desain disesuaikan dengan sub konsentrasi keahlian (peminatan) dalam lingkup Desain Komunikasi Visual: Print Design/Videografi/Fotografi/ Tipografi/Typeface Design/Story Boarding/ Ilustrasi/Sequential Art/Motion Graphic/Web & App Design/UI-UX Design/Concept Art/Motion Graphic Design/Environmental Graphic Design/dan lainnya yang terkait. "],
            ["jurusan_id" => "5", "elemen" => "Sistem Kontrol Elektromekanik ", "deskripsi" => "sistem grounding; penerapan komponen rangkaian kontrol elektromekanik; instalasi rangkaian kontrol elektromekanik; instalasi rangkaian kontrol ATS/AMF. "],
            ["jurusan_id" => "5", "elemen" => "Sistem Kontrol Elektronik ", "deskripsi" => "penerapan komponen dan instalasi rangkaian elektronika daya; setting parameter dan instalasi VSD; penerapan dan pemrograman mikrokontroler untuk sistem kontrol otomatis (berbasis IoT dan IIoT). "],
            ["jurusan_id" => "5", "elemen" => "Piranti Sensor dan Aktuator Industri ", "deskripsi" => "penerapan dan instalasi sensor (digital dan analog); penerapan dan instalasi aktuator elektrik ke input dan output modul kontrol. "],
            ["jurusan_id" => "5", "elemen" => "Sistem Kontrol Elektro Pneumatik dan Hidrolik ", "deskripsi" => "penerapan komponen dan instalasi rangkaian kontrol full dan elektro pneumatik; karakteristik komponen dan instalasi rangkaian hidrolik. "],
            [
                "jurusan_id" => "5",
                "elemen" => "Sistem Kontrol Industri",
                "deskripsi" => "Kontrol looping system, pemrograman dan instalasi sistem kontrol otomatis berbasis PLC, HMI, modul input/output analog, networking PLC, dan SCADA.",
            ],
            [
                "jurusan_id" => 5,
                "elemen" => "Sistem Robot Industri",
                "deskripsi" => "Konstruksi, pemrograman, dan pengoperasian sistem robot industri (handling system) menggunakan sensor, modul kontroler, dan motor stepper atau motor servo.",
            ],

        ];

        Cp::insert($cps);

        $pkls = array(
            array('siswa_id' => '2', 'user_id' => '2', 'dudi_id' => '1', 'tanggal_mulai' => '2024-07-17', 'tanggal_selesai' => '2024-10-17', 'posisi' => 'dsadad', 'pembimbing_dudi' => 'adwqeqewq'),
            array('siswa_id' => '1', 'user_id' => '3', 'dudi_id' => '4', 'tanggal_mulai' => '2024-07-17', 'tanggal_selesai' => '2024-10-17', 'posisi' => 'rffefe', 'pembimbing_dudi' => 'werwerwrwe'),
            array('siswa_id' => '4', 'user_id' => '2', 'dudi_id' => '1', 'tanggal_mulai' => '2024-07-17', 'tanggal_selesai' => '2024-10-17', 'posisi' => 'xhajdasd', 'pembimbing_dudi' => 'tiuerutueur'),
            array('siswa_id' => '10', 'user_id' => '3', 'dudi_id' => '5', 'tanggal_mulai' => '2024-07-17', 'tanggal_selesai' => '2024-10-17', 'posisi' => 'ttrhtr', 'pembimbing_dudi' => 'rttrgtrr'),
            array('siswa_id' => '11', 'user_id' => '2', 'dudi_id' => '1', 'tanggal_mulai' => '2024-07-17', 'tanggal_selesai' => '2024-10-17', 'posisi' => 'tytrry', 'pembimbing_dudi' => 'gffhfg'),
        );

        Pkl::insert($pkls);
    }

    private function generateRandomNik()
    {
        $nik = '';
        for ($i = 0; $i < 16; $i++) {
            $nik .= rand(0, 9);
        }
        return $nik;
    }
}
