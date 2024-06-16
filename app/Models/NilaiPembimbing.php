<?php

namespace App\Models;

use App\Models\Pkl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPembimbing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pkl()
    {
        return $this->belongsTo(Pkl::class);
    }
}
