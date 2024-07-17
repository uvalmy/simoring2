<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Cp;
use App\Models\LaporanHarian;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SiswaLaporanHarianController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanHarians = auth('siswa')->user()->pkl ? LaporanHarian::where('pkl_id', auth('siswa')->user()->pkl->id)->get() : [];
            if ($request->mode == "datatable") {
                return DataTables::of($laporanHarians)
                    ->addColumn('aksi', function ($laporanHarian) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/siswa/laporan-harian/' . $laporanHarian->id . '`, [`id`,`tanggal`, `deskripsi`, `cp_id`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/siswa/laporan-harian/' . $laporanHarian->id . '`, `laporan-harian-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('elemen', function ($laporanHarian) {
                        return Cp::whereIn('id', $laporanHarian->cp_id)->pluck('elemen')->implode(', ');
                    })
                    ->addColumn('status', function ($laporanHarian) {
                        return statusBadge($laporanHarian->status);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['elemen', 'deskripsi-cp', 'aksi', 'status'])
                    ->make(true);
            }

            return $this->successResponse($laporanHarians, 'Data laporan harian ditemukan.');
        }

        $cp = Cp::where('jurusan_id', auth('siswa')->user()->kelas->jurusan->id)->get();
        return view('pages.siswa.laporan-harian.index', compact('cp'));
    }

    public function create()
    {
        $cp = Cp::where('jurusan_id', auth('siswa')->user()->kelas->jurusan->id)->get();
        return view('pages.siswa.laporan-harian.create', compact('cp'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cp_id' => 'required|array',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'nilai_karakter' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanHarian = LaporanHarian::create([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'cp_id' => $request->cp_id,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gambar' => "cucuc",
            'nilai_karakter' => $request->nilai_karakter,
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

        $laporanHarian = LaporanHarian::findOrFail($id);
        return view('pages.siswa.laporan-harian.show', compact('laporanHarian'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cp_id' => 'required|array',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'nilai_karakter' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanHarian = LaporanHarian::find($id);

        if (!$laporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
        }

        $laporanHarian->update($request->only('cp_id', 'tanggal', 'deskripsi', 'nilai_karakter'));
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