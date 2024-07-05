<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Pkl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }

    protected $casts = [
        'password' => 'hashed',
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['role'] = 'siswa';
        return $array;
    }
}
