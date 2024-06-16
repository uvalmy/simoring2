<?php

namespace App\Http\Controllers\Staff;

use App\Models\Kelas;
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
            $kelas = Kelas::all();
            if ($request->mode == "datatable") {
                return DataTables::of($kelas)
                    ->addColumn('aksi', function ($kelas) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/staff/kelas/'. $kelas->id. '`, [`id`,`jurusan_id`, `kode`, `nama`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/staff/kelas/'. $kelas->id. '`, `kelas-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $editButton. $deleteButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($kelas, 'Data kelas ditemukan.');
        }

        return view('pages.staff.kelas.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'equired|exists:jurusans,id',
            'kode' => 'equired|string|unique:kelas,kode',
            'nama' => 'equired|string',
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
            'jurusan_id' => 'equired|exists:jurusans,id',
            'kode' => 'equired|string|unique:kelas,kode,'. $id,
            'nama' => 'equired|string',
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
