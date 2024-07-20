<?php

namespace App\Http\Controllers\Guru;

use App\Models\LaporanAkhir;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GuruLaporanAkhirController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tahun = $request->tahun;
            $laporanAkhirs = LaporanAkhir::with('pkl', 'pkl.siswa')->whereHas('pkl', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->whereYear('created_at', $tahun)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanAkhirs)
                    ->addColumn('aksi', function ($laporanAkhir) {
                        $editButton = '<a class="btn btn-sm btn-warning me-1" href="/guru/laporan-akhir/' . $laporanAkhir->id . '">
                    <i class="ti ti-edit me-1"></i>Edit</a>';
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/guru/laporan-akhir/' . $laporanAkhir->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';

                        return $laporanAkhir->status == 1 ? $detailButton : $editButton;
                    })
                    ->addColumn('status', function ($laporanAkhir) {
                        return statusBadge($laporanAkhir->status);
                    })
                    ->addColumn('siswa', function ($laporanHarian) {
                        return $laporanHarian->pkl->siswa->nama;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'dokumentasi', 'status', 'siswa'])
                    ->make(true);
            }

            return $this->successResponse($laporanAkhirs, 'Data laporan akhir ditemukan.');
        }

        return view('pages.guru.laporan-akhir.index');
    }

    public function show(Request $request, $id)
    {
        $laporanAkhir = LaporanAkhir::with('pkl', 'pkl.siswa')->findOrFail($id);
        return view('pages.guru.laporan-akhir.show', compact('laporanAkhir'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:1,2',
            'catatan' => 'required_if:status,2',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanAkhir = LaporanAkhir::find($id);

        if (!$laporanAkhir) {
            return $this->errorResponse(null, 'Data laporan akhir tidak ditemukan.', 404);
        }

        $laporanAkhir->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);
        return $this->successResponse($laporanAkhir, 'Data laporan akhir diperbarui.');
    }
}
