<?php

namespace App\Http\Controllers\Dudi;

use App\Http\Controllers\Controller;
use App\Models\Cp;
use App\Models\LaporanHarian;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DudiLaporanHarianController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tanggal = $request->tanggal;
            $laporanHarians = LaporanHarian::where('tanggal', $tanggal)->with('pkl', 'pkl.siswa')->whereHas('pkl', function ($query) {
                $query->where('dudi_id', auth('dudi')->user()->id);
            })->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanHarians)
                    ->addColumn('aksi', function ($laporanHarian) {
                        $confirmButton = '<button class="btn btn-sm btn-success" onclick="confirmStatus(`/dudi/laporan-harian/' . $laporanHarian->id . '`, `laporan-harian-table`)"><i class="ti ti-check me-1"></i>Konfirmasi</button>';
                        return $laporanHarian->status == '0' ? $confirmButton : statusBadge($laporanHarian->status);
                    })
                    ->addColumn('elemen', function ($laporanHarian) {
                        return Cp::whereIn('id', $laporanHarian->cp_id)->pluck('elemen')->implode(', ');
                    })
                    ->addColumn('tanggal', function ($laporanHarian) {
                        return  formatTanggal($laporanHarian->tanggal, 'd F y');
                    })
                    ->addColumn('status', function ($laporanHarian) {
                        return statusBadge($laporanHarian->status);
                    })
                    ->addColumn('dokumentasi', function ($laporanHarian) {
                        return '<img src="/storage/gambar/laporan-harian/' . $laporanHarian->dokumentasi . '" width="150px" alt="">';
                    })
                    ->addColumn('siswa', function ($laporanHarian) {
                        return $laporanHarian->pkl->siswa->nama;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'elemen', 'status', 'dokumentasi', 'siswa'])
                    ->make(true);
            }
        }
        return view('pages.dudi.laporan-harian.index');
    }

    public function update(Request $request, $id)
    {
        $laporanHarian = LaporanHarian::find($id);

        if (!$laporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
        }

        $laporanHarian->update(['status' => '1']);
        return $this->successResponse(null, 'Data laporan harian berhasil disetujui');
    }
}
