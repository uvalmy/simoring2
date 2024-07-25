<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class StaffSiswaController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Siswa::with('kelas');
            if ($request->angkatan) {
                $query->where('angkatan', $request->angkatan);
            }

            if ($request->kelas) {
                $query->where('kelas_id', $request->kelas);
            }

            $siswa = $query->get();
            if ($request->mode == "datatable") {
                return DataTables::of($siswa)
                    ->addColumn('aksi', function ($siswa) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/siswa/' . $siswa->id . '`, [`id`,`nis`, `nama`, `kelas_id`, `alamat`, `telepon`, `tempat_lahir`, `tanggal_lahir`, `angkatan`,`status`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        return $editButton;
                    })
                    ->addColumn('kelas', function ($siswa) {
                        return $siswa->kelas->kode;
                    })
                    ->addColumn('status', function ($siswa) {
                        return status($siswa->status);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'kelas', 'status'])
                    ->make(true);
            }

            return $this->successResponse($siswa, 'Data siswa ditemukan.');
        }

        $kelas = Kelas::with('jurusan')->where('status', 1)->get();
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
            'angkatan' => 'required',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $siswa = Siswa::create([
            'kelas_id' => $request->kelas_id,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'password' => $request->password,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'angkatan' => $request->angkatan,
            'status' => $request->status,
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
            'angkatan' => 'required',
            'status' => 'required|in:0,1',
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
            'angkatan' => $request->angkatan,
            'status' => $request->status,
        ]);

        return $this->successResponse($siswa, 'Data siswa diperbarui.');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
            'kelas' => 'required|exists:kelas,id',
            'angkatan_import' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $kelas = $request->input('kelas');
        $angkatan = $request->input('angkatan_import');

        Excel::import(new SiswaImport($kelas, $angkatan), $request->file('file'));
        return $this->successResponse(null, 'Data siswa ditambahkan.');
    }
}
