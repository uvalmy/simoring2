<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Cp;
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
            $tanggal = $request->tanggal;
            $laporanHarian = LaporanHarian::where('tanggal', $tanggal)->with('pkl', 'pkl.siswa')->whereHas('pkl', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanHarian)
                    ->addColumn('elemen', function ($laporanHarian) {
                        return Cp::whereIn('id', $laporanHarian->cp_id)->pluck('elemen')->implode(', ');
                    })
                    ->addColumn('status', function ($laporanHarian) {
                        return statusBadge($laporanHarian->status);
                    })
                    ->addColumn('tanggal', function ($laporanHarian) {
                        return  formatTanggal($laporanHarian->tanggal, 'd F y');
                    })
                    ->addColumn('dokumentasi', function ($laporanHarian) {
                        return '<img src="/storage/gambar/laporan-harian/' . $laporanHarian->dokumentasi . '" width="150px" alt="">';
                    })
                    ->addColumn('siswa', function ($laporanHarian) {
                        return $laporanHarian->pkl->siswa->nama;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['elemen', 'status', 'dokumentasi', 'siswa'])
                    ->make(true);
            }
        }

        return view('pages.guru.laporan-harian.index');
    }
}
