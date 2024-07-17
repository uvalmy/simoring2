<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GuruLaporanHarianController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanHarian = LaporanHarian::with('cp', 'pkl')->whereHas('pkl', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanHarian)
                    ->addColumn('pkl', function ($pkl) {
                        $btn = "Verifikasi";
                        return $btn;
                    })
                    ->addColumn('cp', function ($laporanHarian) {
                        return $laporanHarian->cp->elemen ?? 'Belum ditentukan';
                    })
                    ->addColumn('siswa', function ($laporanHarian) {
                        return $laporanHarian->pkl->siswa->nama ?? 'Belum ditentukan';
                    })

                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'cp', 'siswa'])
                    ->make(true);
            }

        }
        return view('pages.guru.laporan-harian.index');
    }
}
