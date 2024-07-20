<?php

namespace App\Http\Controllers\Dudi;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DudiPklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tahun = $request->tahun;
            $pkl = Pkl::with('user', 'siswa')->where('dudi_id', auth('dudi')->user()->id)->whereYear('tanggal_mulai', $tahun)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                    ->addColumn('aksi', function ($pkl) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/dudi/pkl/' . $pkl->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';
                        return $detailButton;
                    })
                    ->addColumn('siswa', function ($pkl) {
                        return $pkl->siswa->nama;
                    })
                    ->addColumn('tanggal_mulai', function ($pkl) {
                        return  formatTanggal($pkl->tanggal_mulai, 'd F y');
                    })
                    ->addColumn('tanggal_selesai', function ($pkl) {
                        return  formatTanggal($pkl->tanggal_selesai, 'd F y');
                    })
                    ->addColumn('dudi', function ($pkl) {
                        return $pkl->dudi->instansi;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        return view('pages.dudi.pkl.index');
    }

    public function show($id)
    {
        $pkl = Pkl::with('user', 'siswa', 'nilaiDudi')->where('dudi_id', auth('dudi')->user()->id)->findOrFail($id);
        return view('pages.dudi.pkl.show', compact('pkl'));
    }

}
