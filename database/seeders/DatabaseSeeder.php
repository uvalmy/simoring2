<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Kelas;
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

        $jurusans = Jurusan::insert($dataJurusan);

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
