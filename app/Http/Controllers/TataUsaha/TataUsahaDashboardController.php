<?php

namespace App\Http\Controllers\TataUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TataUsahaDashboardController extends Controller
{
    public function index()
    {
        return view('pages.tata-usaha.dashboard.index');
    }
}
