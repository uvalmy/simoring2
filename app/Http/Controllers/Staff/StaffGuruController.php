<?php
namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StaffGuruController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            if ($request->mode == "datatable") {
                return DataTables::of($users)
                    ->addColumn('aksi', function ($user) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(`createModal`,  `/staff/guru/' . $user->id . '`, [`id`,`nik`, `nama`, `email`, `role`, `telepon`,`status`])">
                        <i class="ti ti-edit me-1"></i>Edit</button>';
                        return $editButton;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($users, 'Data Guru ditemukan.');
        }

        return view('pages.staff.guru.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|size:16|unique:users,nik',
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|min:8|same:password',
            'telepon' => 'required|string',
            'role' => 'required|in:admin,guru_pembimbing,tata_usaha',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = User::create($request->only('nik', 'nama', 'email', 'password', 'telepon', 'role','status'));

        return $this->successResponse($user, 'Data Guru ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::find($id);

            if (!$user) {
                return $this->errorResponse(null, 'Data Guru tidak ditemukan.', 404);
            }

            return $this->successResponse($user, 'Data Guru ditemukan.');
        }

        abort(404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|size:16|unique:users,nik,' . $id,
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'konfirmasi_password' => 'nullable|required_with:password|same:password|min:8',
            'telepon' => 'required|string',
            'role' => 'required|in:admin,guru_pembimbing,tata_usaha',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(null, 'Data Guru tidak ditemukan.', 404);
        }

        $user->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? $request->password : $user->password,
            'telepon' => $request->telepon,
            'role' => $request->role,
            'status' => $request->status
        ]);

        return $this->successResponse($user, 'Data Guru diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->errorResponse(null, 'Data Guru tidak ditemukan.', 404);
        }

        $user->delete();
        return $this->successResponse(null, 'Data Guru dihapus.');
    }
}