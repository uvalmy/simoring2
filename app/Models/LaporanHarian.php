<?php

namespace App\Models;

use App\Models\Pkl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'cp_id' => 'array',
        'nilai_karakter' => 'array',
    ];

    public function pkl()
    {
        return $this->belongsTo(Pkl::class);
    }
}
