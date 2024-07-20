<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SiswaImport implements ToModel, WithHeadingRow
{
    protected $kelas;
    protected $angkatan;

    public function __construct($kelas, $angkatan)
    {
        $this->kelas = $kelas;
        $this->angkatan = $angkatan;
    }

    public function model(array $row)
    {
        $existingSiswa = Siswa::where('nis', $row['nis'])->first();

        if ($existingSiswa) {
            return null;
        }

        return new Siswa([
            'kelas_id' => $this->kelas,
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'telepon' => $row['telepon'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => Date::excelToDateTimeObject($row['tanggal_lahir']),
            'angkatan' => $this->angkatan,
            'password' => bcrypt('smkn4tsm'),
        ]);
    }
}