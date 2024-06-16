<?php

namespace App\Models;

use App\Models\Cp;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function cps()
    {
        return $this->hasMany(Cp::class);
    }
}
