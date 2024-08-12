<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Siswa;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $guard = null;
            $password = $request->password;

            if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request->username)->first();
                $guard = 'web';
            } else {
                $user = Dudi::where('username', $request->username)->first();
                if ($user) {
                    $guard = 'dudi';
                } else {
                    $user = Siswa::where('nis', $request->username)->first();
                    $guard = 'siswa';
                }
            }

            if (!$user) {
                return $this->errorResponse(null, 'Akun tidak ditemukan.', 404);
            }

            if ($guard != 'dudi' && $user->status == '0') {
                return $this->errorResponse(null, 'Akun tidak aktif.', 401);
            }

            if (!Hash::check($password, $user->password)) {
                return $this->errorResponse(null, 'Password salah.', 401);
            }

            auth()->guard($guard)->login($user);

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
