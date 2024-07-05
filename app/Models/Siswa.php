<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Pkl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $guard = 'siswa';

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

    public function getRoleAttribute()
    {
        return 'siswa';
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['role'] = 'siswa';
        return $array;
    }
}
