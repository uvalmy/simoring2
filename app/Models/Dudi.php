<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dudi extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    protected $guard = 'dudi';

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getRoleAttribute()
    {
        return 'dudi';
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['role'] = 'dudi';
        return $array;
    }
}
