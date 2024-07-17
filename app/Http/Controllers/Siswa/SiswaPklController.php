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
        if ($request->ajax()) {
            $pkl = Pkl::with('user', 'dudi')->where('siswa_id', auth('siswa')->user()->id)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                    ->addColumn('user', function ($pkl) {
                        return $pkl->user->nama;
                    })
                    ->addColumn('dudi', function ($pkl) {
                        return $pkl->dudi->instansi;
                    })

                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        return view('pages.siswa.pkl.index');
    }
}
