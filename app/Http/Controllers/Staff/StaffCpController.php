<?php

namespace App\Http\Controllers\Staff;

use App\Models\Cp;
use App\Models\Jurusan;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StaffCpController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cps = Cp::with('jurusan')->get();
            if ($request->mode == "datatable") {
                return DataTables::of($cps)
                    ->addColumn('aksi', function ($cp) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/cp/' . $cp->id . '`, [`id`,`elemen`, `deskripsi`, `jurusan_id`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/staff/cp/' . $cp->id . '`, `cp-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('jurusan', function ($cp) {
                        return $cp->jurusan->nama ?? 'Belum ditentukan';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'jurusan'])
                    ->make(true);
            }

            return $this->successResponse($cps, 'Data cp ditemukan.');
        }

        $jurusan = Jurusan::all();
        return view('pages.staff.cp.index', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'required|exists:jurusans,id',
            'elemen' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $cp = Cp::create($request->only('jurusan_id', 'elemen', 'deskripsi'));
        return $this->successResponse($cp, 'Data cp ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $cp = Cp::find($id);

            if (!$cp) {
                return $this->errorResponse(null, 'Data cp tidak ditemukan.', 404);
            }

            return $this->successResponse($cp, 'Data cp ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jurusan_id' => 'required|exists:jurusans,id',
            'elemen' => 'required|string|',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $cp = Cp::find($id);

        if (!$cp) {
            return $this->errorResponse(null, 'Data cp tidak ditemukan.', 404);
        }

        $cp->update($request->only('jurusan_id', 'elemen', 'deskripsi'));
        return $this->successResponse($cp, 'Data cp diperbarui.');
    }

    public function destroy($id)
    {
        $cp = Cp::find($id);

        if (!$cp) {
            return $this->errorResponse(null, 'Data cp tidak ditemukan.', 404);
        }

        $cp->delete();
        return $this->successResponse(null, 'Data cp dihapus.');
    }
}
