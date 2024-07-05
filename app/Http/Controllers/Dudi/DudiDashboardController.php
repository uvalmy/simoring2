<?php

namespace App\Http\Controllers\Dudi;

use App\Http\Controllers\Controller;

class DudiDashboardController extends Controller
{
    public function index()
    {
        return view('pages.dudi.dashboard.index');
    }
}