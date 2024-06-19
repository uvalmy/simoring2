<?php
namespace App\Http\Controllers\Staff;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/siswa/' . $siswa->id . '`, [`id`,`nis`, `nama`, `kelas_id`, `alamat`, `telepon`, `tempat_lahir`, `tanggal_lahir`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/staff/siswa/' . $siswa->id . '`, `siswa-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('kelas', function ($siswa) {
                        return $siswa->kelas->nama;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($siswa, 'Data siswa ditemukan.');
        }

        $kelas = Kelas::with('jurusan')->get();
        return view('pages.staff.siswa.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas_id' => 'required|exists:kelas,id',
            'nis' => 'required|string|unique:siswas,nis',
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
            'nis' => 'required|string|unique:siswas,nis,' . $id,
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
