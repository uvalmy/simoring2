<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StaffJurusanController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jurusans = Jurusan::all();
            if ($request->mode == "datatable") {
                return DataTables::of($jurusans)
                    ->addColumn('aksi', function ($jurusan) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/jurusan/' . $jurusan->id . '`, [`id`,`kode`, `nama`,`status`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        return $editButton;
                    })
                    ->addColumn('status', function ($jurusan) {
                        return status($jurusan->status);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'status'])
                    ->make(true);
            }

            return $this->successResponse($jurusans, 'Data jurusan ditemukan.');
        }

        return view('pages.staff.jurusan.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|unique:jurusans,kode',
            'nama' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $jurusan = Jurusan::create($request->only('kode', 'nama', 'status'));
        return $this->successResponse($jurusan, 'Data jurusan ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $jurusan = Jurusan::find($id);

            if (!$jurusan) {
                return $this->errorResponse(null, 'Data jurusan tidak ditemukan.', 404);
            }

            return $this->successResponse($jurusan, 'Data jurusan ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|string|unique:jurusans,kode,' . $id,
            'nama' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return $this->errorResponse(null, 'Data jurusan tidak ditemukan.', 404);
        }

        $jurusan->update($request->only('kode', 'nama', 'status'));
        return $this->successResponse($jurusan, 'Data jurusan diperbarui.');
    }
}
