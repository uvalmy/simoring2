<?php

namespace App\Models;

use App\Models\Pkl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanProyek extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'dokumentasi' => 'array',
    ];

    public function pkl()
    {
        return $this->belongsTo(Pkl::class);
    }
}
