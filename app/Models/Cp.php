<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
