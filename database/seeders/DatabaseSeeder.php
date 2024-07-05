<?php

namespace Database\Seeders;

use App\Models\Dudi;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
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
                'role' => 'tata_usaha',
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
                'tanggal_lahir' => now()->subYears(rand(15, 18))->subMonths(rand(0, 11))->subDays(rand(0, 30)), // Tanggal lahir acak antara 15-18 tahun yang lalu
            ]);
        }
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