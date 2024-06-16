<?php
namespace App\Http\Controllers\Staff;

use App\Models\Siswa;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StaffSiswaController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $siswa = Siswa::with('kelas')->get();
            if ($request->mode == "datatable") {
                return DataTables::of($siswa)
                    ->addColumn('aksi', function ($siswa) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(`createModal`, `/staff/siswa/'. $siswa->id. '`, [`id`, `kelas_id`, `nis`, `nama`, `alamat`, `telepon`, `tempat_lahir`, `tanggal_lahir`])"><i class="bi bi-pencil-square me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/staff/siswa/'. $siswa->id. '`, `siswa-table`)"><i class="bi bi-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($siswa, 'Data siswa ditemukan.');
        }

        return view('pages.staff.siswa.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas_id' => 'required|exists:kelas,id',
            'nis' => 'required|string|unique:siswa,nis',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $siswa = Siswa::create([
            'kelas_id' => $request->kelas_id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'password' => bcrypt('smk42024'),
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return $this->successResponse($siswa, 'Data siswa ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $siswa = Siswa::with('kelas')->find($id);

            if (!$siswa) {
                return $this->errorResponse(null, 'Data siswa tidak ditemukan.', 404);
            }

            return $this->successResponse($siswa, 'Data siswa ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kelas_id' => 'required|exists:kelas,id',
            'nis' => 'required|string|unique:siswa,nis,' . $id,
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $siswa = Siswa::find($id);

        if (!$siswa) {
            return $this->errorResponse(null, 'Data siswa tidak ditemukan.', 404);
        }

        $siswa->update([
            'kelas_id' => $request->kelas_id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return $this->successResponse($siswa, 'Data siswa diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return $this->errorResponse(null, 'Data siswa tidak ditemukan.', 404);
        }

        $siswa->delete();
        return $this->successResponse(null, 'Data siswa dihapus.');
    }
}
