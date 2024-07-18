<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LaporanProyek;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GuruLaporanProyekController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanProyeks = LaporanProyek::with('pkl', 'pkl.siswa')->whereHas('pkl', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanProyeks)
                    ->addColumn('aksi', function ($laporanProyek) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/guru/laporan-proyek/' . $laporanProyek->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';

                        return $detailButton;
                    })
                    ->addColumn('dokumentasi', function ($laporanProyek) {
                        return '<img src="/storage/gambar/laporan-proyek/' . $laporanProyek->dokumentasi . '" width="150px" alt="">';
                    })
                    ->addColumn('status', function ($laporanProyek) {
                        return statusBadge($laporanProyek->status);
                    })
                    ->addColumn('siswa', function ($laporanHarian) {
                        return $laporanHarian->pkl->siswa->nama;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'dokumentasi', 'status', 'siswa'])
                    ->make(true);
            }

            return $this->successResponse($laporanProyeks, 'Data laporan proyek ditemukan.');
        }

        return view('pages.guru.laporan-proyek.index');
    }

    public function show(Request $request, $id)
    {
        $laporanProyek = LaporanProyek::with('pkl', 'pkl.siswa')->findOrFail($id);
        return view('pages.guru.laporan-proyek.show', compact('laporanProyek'));
    }
}