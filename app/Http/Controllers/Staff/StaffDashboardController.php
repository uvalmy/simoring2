<?php

namespace App\Http\Controllers\Staff;

use App\Models\Pkl;
use App\Models\Dudi;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::count();
        $pkl = Pkl::count();
        $user = User::count();
        $dudi = Dudi::count();
        $kelas = Kelas::count();
        $siswa = Siswa::count();
        return view('pages.staff.dashboard.index');
    }
}
