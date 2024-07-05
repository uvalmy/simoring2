<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaProfileController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'telepon' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = auth('siswa')->user();

            if (!$user) {
                return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
            }

            $user->update($request->only('nama', 'alamat', 'telepon'));

            return $this->successResponse($user, 'Data Profil diubah.');
        }

        return view('pages.siswa.profile.index');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required|min:8',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|min:8|same:password',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = auth('siswa')->user();

        if (!$user) {
            return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
        }

        if (!Hash::check($request->password_lama, $user->password)) {
            return $this->errorResponse(null, 'Password lama tidak sesuai.', 422);
        }

        $user->update($request->only('password'));

        return $this->successResponse($user, 'Data Password diubah.');
    }
}
