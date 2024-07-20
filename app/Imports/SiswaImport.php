<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $existingSiswa = Siswa::where('nis', $row['nis'])->first();

        if ($existingSiswa) {
            return null;
        }

        return new Siswa([
            'kelas_id' => $row['kelas_id'],
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'telepon' => $row['telepon'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir']),
            'angkatan' => $row['angkatan'],
            'password' => bcrypt('smkn4tsm'),
        ]);
    }
}
