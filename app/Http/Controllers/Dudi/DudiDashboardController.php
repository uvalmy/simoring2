<?php

namespace App\Http\Controllers\Dudi;

use App\Models\LaporanHarian;
use App\Models\LaporanProyek;
use App\Http\Controllers\Controller;

class DudiDashboardController extends Controller
{
    public function index()
    {
        $pkl = auth('dudi')->user()->pkls()->count();
        $laporanHarianBelumDisetujui = LaporanHarian::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('dudi_id', auth('dudi')->user()->id);
        })->where('status', '0')->count();
        $laporanHarianDisetujui = LaporanHarian::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('dudi_id', auth('dudi')->user()->id);
        })->where('status', '1')->count();
        $laporanProyekBelumDisetujui = LaporanProyek::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('dudi_id', auth('dudi')->user()->id);
        })->where('status', '0')->count();
        $laporanProyekDisetujui = LaporanProyek::with('pkl')->whereHas('pkl', function ($query) {
            $query->where('dudi_id', auth('dudi')->user()->id);
        })->where('status', '1')->count();

        return view('pages.dudi.dashboard.index', compact('pkl', 'laporanHarianBelumDisetujui', 'laporanHarianDisetujui', 'laporanProyekBelumDisetujui', 'laporanProyekDisetujui' ));
    }
}
