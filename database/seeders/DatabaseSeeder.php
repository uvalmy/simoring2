<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
