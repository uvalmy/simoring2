<?php

namespace App\Http\Controllers\Dudi;

use App\Models\Pkl;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DudiPklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pkl = Pkl::with('user', 'siswa')->where('dudi_id', auth('dudi')->user()->id)->get();
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                    ->addColumn('siswa', function($pkl){
                        return $pkl->siswa->nama;
                    })
                    ->addColumn('dudi', function($pkl){
                        return $pkl->dudi->instansi;
                    })

                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        return view('pages.dudi.pkl.index');
    }
}
