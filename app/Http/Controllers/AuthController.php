<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponder;

    public function login(Request $request)
    {
        if (auth()->check()) {
            if (auth()->user()->role == 'admin') {
                return redirect('/staff');
            } elseif (auth()->user()->role == 'guru_pembimbing') {
                return redirect('/guru');
            }
        }

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = null;
            if (filter_var($request->username, FILTER_VALIDATE_EMAIL) && auth('web')->attempt(['email' => $request->username, 'password' => $request->password])) {
                $user = auth('web')->user();
                if ($user->status == 0) {
                    return $this->errorResponse(null, 'Akun anda sudah tidak aktif.', 401);
                }
            } elseif (ctype_alnum($request->username) && auth('dudi')->attempt(['username' => $request->username, 'password' => $request->password])) {
                $user = auth('dudi')->user();
            } elseif (ctype_digit($request->username) && auth('siswa')->attempt(['nis' => $request->username, 'password' => $request->password])) {
                $user = auth('siswa')->user();
                if ($user->status == 0) {
                    return $this->errorResponse(null, 'Akun anda sudah tidak aktif.', 401);
                }
            } else {
                return $this->errorResponse(null, 'Username atau password tidak valid.', 401);
            }

            return $this->successResponse($user, 'Login berhasil.');
        }

        return view('pages.auth.login');
    }

    public function logout(Request $request)
    {
        $guards = ['web', 'dudi', 'siswa'];

        foreach ($guards as $row) {
            auth($row)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
