<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        return view('pages.siswa.dashboard.index');
    }
}
