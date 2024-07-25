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

class StaffPklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tahun = $request->tahun;
            $pkl = Pkl::with('user','siswa','dudi')->whereYear('tanggal_mulai', $tahun)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                    ->addColumn('aksi', function ($pkl) {
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/staff/pkl/' . $pkl->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/pkl/' . $pkl->id . '`, [`id`,`siswa_id`,`user_id`,`dudi_id`, `tanggal_mulai`,`tanggal_selesai`, `posisi`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/staff/pkl/' . $pkl->id . '`, `pkl-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $detailButton . $editButton . $deleteButton;
                    })
                    ->addColumn('user', function($pkl){
                        return $pkl->user->nama;
                    })
                    ->addColumn('siswa', function($pkl){
                        return $pkl->siswa->nama;
                    })
                    ->addColumn('dudi', function($pkl){
                        return $pkl->dudi->nama;
                    })
                    ->addColumn('tanggal_mulai', function ($pkl) {
                        return  formatTanggal($pkl->tanggal_mulai, 'd F y');
                    })
                    ->addColumn('tanggal_selesai', function ($pkl) {
                        return  formatTanggal($pkl->tanggal_selesai, 'd F y');
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        $user = User::where('role', 'guru_pembimbing')->where('status', 1)->get();
        $siswa = Siswa::with('kelas')->where('status', 1)->get();
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
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $pkl = Pkl::create($request->only('siswa_id','user_id','dudi_id', 'tanggal_mulai','tanggal_selesai', 'posisi'));
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

        $pkl = Pkl::with('user', 'siswa', 'nilaiPembimbing','nilaiDudi')->findOrFail($id);
        return view('pages.staff.pkl.show', compact('pkl'));
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
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $pkl = Pkl::find($id);

        if (!$pkl) {
            return $this->errorResponse(null, 'Data pkl tidak ditemukan.', 404);
        }

        $pkl->update($request->only('siswa_id','user_id','dudi_id', 'tanggal_mulai','tanggal_selesai', 'posisi'));
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