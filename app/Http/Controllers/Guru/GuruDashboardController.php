<?php

namespace App\Http\Controllers\Guru;

use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use App\Models\LaporanProyek;
use App\Http\Controllers\Controller;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $pkl = auth()->user()->pkls()->count() ?? 0;
        $laporanHarian = LaporanHarian::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('status', '1')->count();
        $laporanProyek = LaporanProyek::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('status', '1')->count();
        $laporanAkhir = LaporanAkhir::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('status', '1')->count();

        return view('pages.guru.dashboard.index', compact('pkl', 'laporanHarian', 'laporanProyek', 'laporanAkhir' ));
    }
}
