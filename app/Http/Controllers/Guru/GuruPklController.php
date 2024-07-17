<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GuruPklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pkl = Pkl::with('siswa', 'dudi')->where('user_id', auth()->user()->id)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                    ->addColumn('siswa', function ($pkl) {
                        return $pkl->siswa->nama;
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

        return view('pages.guru.pkl.index');
    }

}
