<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponder;

    public function login(Request $request)
    {
        if (Auth::check()) {
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

            if (Auth::guard('web')->attempt(['email' => $request->username, 'password' => $request->password])) {
                $user = Auth::guard('web')->user();
            } elseif (Auth::guard('dudi')->attempt(['username' => $request->username, 'password' => $request->password])) {
                $user = Auth::guard('dudi')->user();
            } elseif (Auth::guard('siswa')->attempt(['nis' => $request->username, 'password' => $request->password])) {
                $user = Auth::guard('siswa')->user();
            } else {
                return $this->errorResponse(null, 'Username atau password tidak valid.', 401);
            }

            $admin = Auth::user();
            return $this->successResponse($admin, 'Login berhasil.');
        }

        return view('pages.auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
