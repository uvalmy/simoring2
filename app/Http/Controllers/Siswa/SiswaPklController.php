<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SiswaPklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        return view('pages.siswa.pkl.index');
    }
}
