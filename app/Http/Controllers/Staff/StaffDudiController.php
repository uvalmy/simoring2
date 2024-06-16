<?php

namespace App\Http\Controllers\Staff;

use App\Models\Dudi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StaffDudiController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dudi = Dudi::query();
            if ($request->mode == "datatable") {
                return DataTables::of($dudi)
                    ->addColumn('aksi', function ($dudi) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/staff/dudi/'. $dudi->id. '`, [`id`,`username`, `password`, `nama`, `instansi`, `alamat`, `telepon`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/staff/dudi/'. $dudi->id. '`, `dudi-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($dudi->get(), 'Data DUDI ditemukan.');
        }

        return view('pages.staff.dudi.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:dudi,username',
            'password' => 'required|string|min:8',
            'konfirmasi_password' => 'required|string|min:8|same:password',
            'nama' => 'required|string',
            'instansi' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $dudi = Dudi::create($request->only('username', 'password', 'nama', 'instansi', 'alamat', 'telepon'));

        return $this->successResponse($dudi, 'Data DUDI ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $dudi = Dudi::find($id);

            if (!$dudi) {
                return $this->errorResponse(null, 'Data DUDI tidak ditemukan.', 404);
            }

            return $this->successResponse($dudi, 'Data DUDI ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:dudi,username,'. $id,
            'password' => 'nullable|string|min:8',
            'konfirmasi_password' => 'required_with:password|string|min:8|same:password',
            'nama' => 'required|string',
            'instansi' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $dudi = Dudi::find($id);

        if (!$dudi) {
            return $this->errorResponse(null, 'Data DUDI tidak ditemukan.', 404);
        }

        $dudi->update([
            'username' => $request->input('username'),
            'password' => $request->password ? $request->password : $dudi->password,
            'nama' => $request->input('nama'),
            'instansi' => $request->input('instansi'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
        ]);

        return $this->successResponse($dudi, 'Data DUDI diperbarui.');
    }

    public function destroy($id)
    {
        $dudi = Dudi::find($id);

        if (!$dudi) {
            return $this->errorResponse(null, 'Data DUDI tidak ditemukan.', 404);
        }

        $dudi->delete();
        return $this->successResponse(null, 'Data DUDI dihapus.');
    }
}
