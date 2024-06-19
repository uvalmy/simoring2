<?php

namespace App\Http\Controllers\Staff;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StaffKelasController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::with('jurusan')->get();
            if ($request->mode == "datatable") {
                return DataTables::of($kelas)
                    ->addColumn('aksi', function ($kelas) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/kelas/' . $kelas->id . '`, [`id`,`kode`, `nama`, `jurusan_id`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/staff/kelas/' . $kelas->id . '`, `kelas-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('jurusan', function ($kelas) {
                        return $kelas->jurusan->nama ?? 'Belum ditentukan';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'jurusan'])
                    ->make(true);
            }

            return $this->successResponse($kelas, 'Data kelas ditemukan.');
        }

        $jurusan = Jurusan::all();
        return view('pages.staff.kelas.index', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'required|exists:jurusans,id',
            'kode' => 'required|string|unique:kelas,kode',
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $kelas = Kelas::create($request->only('jurusan_id', 'kode', 'nama'));
        return $this->successResponse($kelas, 'Data kelas ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $kelas = Kelas::find($id);

            if (!$kelas) {
                return $this->errorResponse(null, 'Data kelas tidak ditemukan.', 404);
            }

            return $this->successResponse($kelas, 'Data kelas ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'required|exists:jurusans,id',
            'kode' => 'required|string|unique:kelas,kode,'. $id,
            'nama' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $kelas = Kelas::find($id);

        if (!$kelas) {
            return $this->errorResponse(null, 'Data kelas tidak ditemukan.', 404);
        }

        $kelas->update($request->only('jurusan_id', 'kode', 'nama'));
        return $this->successResponse($kelas, 'Data kelas diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        if (!$kelas) {
            return $this->errorResponse(null, 'Data kelas tidak ditemukan.', 404);
        }

        $kelas->delete();
        return $this->successResponse(null, 'Data kelas dihapus.');
    }
}
