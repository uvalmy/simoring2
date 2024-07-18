<?php

namespace App\Http\Controllers\Dudi;

use App\Http\Controllers\Controller;
use App\Models\LaporanProyek;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DudiLaporanProyekController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanProyeks = LaporanProyek::with('pkl', 'pkl.siswa')->whereHas('pkl', function ($query) {
                $query->where('dudi_id', auth('dudi')->user()->id);
            })->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanProyeks)
                    ->addColumn('aksi', function ($laporanProyek) {
                        $editButton = '<a class="btn btn-sm btn-warning me-1" href="/dudi/laporan-proyek/' . $laporanProyek->id . '">
                        <i class="ti ti-edit me-1"></i>Edit</a>';
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/dudi/laporan-proyek/' . $laporanProyek->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';

                        return $laporanProyek->status == 1 ? $detailButton : $editButton;
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

        return view('pages.dudi.laporan-proyek.index');
    }

    public function show(Request $request, $id)
    {
        $laporanProyek = LaporanProyek::with('pkl', 'pkl.siswa')->findOrFail($id);
        return view('pages.dudi.laporan-proyek.show', compact('laporanProyek'));
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

        $laporanProyek = LaporanProyek::find($id);

        if (!$laporanProyek) {
            return $this->errorResponse(null, 'Data laporan proyek tidak ditemukan.', 404);
        }

        $laporanProyek->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);
        return $this->successResponse($laporanProyek, 'Data laporan proyek diperbarui.');
    }
}
