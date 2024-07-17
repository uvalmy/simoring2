<?php

namespace App\Http\Controllers\Staff;

use App\Models\Pkl;
use App\Models\Dudi;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StaffpklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pkl = Pkl::with('user','siswa','dudi')->get();
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                    ->addColumn('aksi', function ($pkl) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/pkl/' . $pkl->id . '`, [`id`,`siswa_id`,`user_id`,`dudi_id`, `tanggal_mulai`,`tanggal_selesai`, `posisi`,`pembimbing_dudi`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/staff/pkl/' . $pkl->id . '`, `pkl-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('user', function($pkl){
                        return $pkl->user->nama;
                    })
                    ->addColumn('siswa', function($pkl){
                        return $pkl->siswa->nama;
                    })
                    ->addColumn('dudi', function($pkl){
                        return $pkl->dudi->instansi;
                    })

                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        $user = User::where('role', 'guru_pembimbing')->get();
        $siswa = Siswa::with('kelas')->get();
        $dudi = Dudi::all();
        return view('pages.staff.pkl.index', compact('user','siswa','dudi'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswas,id',
            'user_id' => 'required|exists:users,id',
            'dudi_id' => 'required|exists:dudis,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'posisi' => 'required|string',
            'pembimbing_dudi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $pkl = Pkl::create($request->only('siswa_id','user_id','dudi_id', 'tanggal_mulai','tanggal_selesai', 'posisi','pembimbing_dudi'));
        return $this->successResponse($pkl, 'Data pkl ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $pkl = Pkl::find($id);

            if (!$pkl) {
                return $this->errorResponse(null, 'Data pkl tidak ditemukan.', 404);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswas,id',
            'user_id' => 'required|exists:users,id',
            'dudi_id' => 'required|exists:dudis,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'posisi' => 'required|string',
            'pembimbing_dudi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $pkl = Pkl::find($id);

        if (!$pkl) {
            return $this->errorResponse(null, 'Data pkl tidak ditemukan.', 404);
        }

        $pkl->update($request->only('siswa_id','user_id','dudi_id', 'tanggal_mulai','tanggal_selesai', 'posisi','pembimbing_dudi'));
        return $this->successResponse($pkl, 'Data pkl diperbarui.');
    }

    public function destroy($id)
    {
        $pkl = Pkl::find($id);

        if (!$pkl) {
            return $this->errorResponse(null, 'Data pkl tidak ditemukan.', 404);
        }

        $pkl->delete();
        return $this->successResponse(null, 'Data pkl dihapus.');
    }
}
