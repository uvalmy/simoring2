<?php

namespace App\Models;

use App\Models\Dudi;
use App\Models\User;
use App\Models\Siswa;
use App\Models\NilaiDudi;
use App\Models\LaporanAkhir;
use App\Models\LaporanHarian;
use App\Models\LaporanProyek;
use App\Models\NilaiPembimbing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pkl extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }

    public function nilaiDudi()
    {
        return $this->hasOne(NilaiDudi::class);
    }
    public function nilaiPembimbing()
    {
        return $this->hasOne(NilaiPembimbing::class);
    }

    public function laporanHarian()
    {
        return $this->hasMany(LaporanHarian::class);
    }

    public function laporanProyek()
    {
        return $this->hasMany(LaporanProyek::class);
    }

    public function laporanAkhir()
    {
        return $this->hasOne(LaporanAkhir::class);
    }
}
