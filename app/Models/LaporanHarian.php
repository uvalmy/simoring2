<?php

namespace App\Models;

use App\Models\Cp;
use App\Models\Pkl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanHarian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pkl()
    {
        return $this->belongsTo(Pkl::class);
    }

    public function cp()
    {
        return $this->belongsTo(Cp::class);
    }
}
