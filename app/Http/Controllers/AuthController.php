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

        $credentials = ['password' => $request->password];

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->username;
            $guard = 'web';
        } elseif (ctype_alnum($request->username)) {
            $credentials['username'] = $request->username;
            $guard = 'dudi';
        } elseif (ctype_digit($request->username)) {
            $credentials['nis'] = $request->username;
            $guard = 'siswa';
        } else {
            return $this->errorResponse(null, 'Username atau password tidak valid.', 401);
        }

        if (auth($guard)->attempt($credentials)) {
            $user = auth($guard)->user();
            if ($guard !== 'dudi' && $user->status == 0) {
                return $this->errorResponse(null, 'Akun anda sudah tidak aktif.', 401);
            }
            return $this->successResponse($user, 'Login berhasil.');
        } else {
            $user = auth($guard)->getProvider()->retrieveByCredentials(array_diff_key($credentials, ['password' => '']));
            if ($user) {
                return $this->errorResponse(null, 'Password yang Anda masukkan salah.', 401);
            } else {
                return $this->errorResponse(null, 'Username atau password tidak valid.', 401);
            }
        }
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
