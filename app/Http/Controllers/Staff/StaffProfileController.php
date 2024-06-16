<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponder;

class StaffProfileController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|string|unique:users,nik,' . Auth::user()->id,
                'nama' => 'required|string',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                'telepon' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
            }

            $user->update($request->only('nik', 'nama', 'email', 'telepon'));

            return $this->successResponse($user, 'Data Profil diubah.');
        }

        return view('pages.staff.profile.index');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required|min:8',
            'password' => 'required|string|min:8',
            'konfirmasi_password' => 'required|string|min:8|same:password',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = Auth::user();

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
