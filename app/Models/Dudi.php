<?php

namespace App\Models;

use App\Models\Pkl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dudi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pkls()
    {
        return $this->hasMany(Pkl::class);
    }

    protected $casts = [
        'password' => 'hashed',
    ];
}
