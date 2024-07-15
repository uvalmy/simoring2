<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Cp;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SiswaLaporanHarianController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanHarians = LaporanHarian::with('cp')->where('pkl_id', auth('siswa')->user()->pkl->id)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($laporanHarians)
                    ->addColumn('aksi', function ($laporanHarian) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/siswa/laporan-harian/' . $laporanHarian->id . '`, [`id`,`tanggal`, `deskripsi`, `cp_id`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/siswa/laporan-harian/' . $laporanHarian->id . '`, `laporan-harian-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('elemen', function ($laporanHarian) {
                        return $laporanHarian->cp->elemen ?? 'Belum ditentukan';
                    })
                    ->addColumn('deskripsi-cp', function ($laporanHarian) {
                        return $laporanHarian->cp->deskripsi ?? 'Belum ditentukan';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['elemen', 'deskripsi-cp', 'aksi'])
                    ->make(true);
            }

            return $this->successResponse($laporanHarians, 'Data laporan harian ditemukan.');
        }

        $cp = Cp::where('jurusan_id', auth('siswa')->user()->kelas->jurusan->id)->get();
        return view('pages.siswa.laporan-harian.index', compact('cp'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cp_id' => 'required|exists:cps,id',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanHarian = LaporanHarian::create([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'cp_id' => $request->cp_id,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi
        ]);
        return $this->successResponse($laporanHarian, 'Data laporan harian ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $laporanHarian = LaporanHarian::find($id);

            if (!$laporanHarian) {
                return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
            }

            return $this->successResponse($laporanHarian, 'Data laporan harian ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cp_id' => 'required|exists:cps,id',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanHarian = LaporanHarian::find($id);

        if (!$laporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
        }

        $laporanHarian->update($request->only('cp_id', 'tanggal', 'deskripsi'));
        return $this->successResponse($laporanHarian, 'Data laporan harian diperbarui.');
    }

    public function destroy($id)
    {
        $laporanHarian = LaporanHarian::find($id);

        if (!$laporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
        }

        $laporanHarian->delete();
        return $this->successResponse(null, 'Data laporan harian dihapus.');
    }
}
