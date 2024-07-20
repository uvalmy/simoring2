<?php

namespace App\Http\Controllers\Guru;

use App\Models\Pkl;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class GuruPklController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $pkl = Pkl::with('siswa', 'dudi', 'nilaiPembimbing')->where('user_id', auth()->user()->id)->whereYear('tanggal_mulai', $tahun)->get();
        if ($request->ajax()) {
            if ($request->mode == "datatable") {
                return DataTables::of($pkl)
                ->addColumn('aksi', function ($pkl) {
                    $detailButton = '<a class="btn btn-sm btn-info me-1" href="/guru/pkl/' . $pkl->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';
                    return $detailButton;
                    })
                    ->addColumn('siswa', function ($pkl) {
                        return $pkl->siswa->nama;
                    })
                    ->addColumn('dudi', function ($pkl) {
                        return $pkl->dudi->nama;
                    })
                    ->addColumn('tanggal_mulai', function ($pkl) {
                        return  formatTanggal($pkl->tanggal_mulai, 'd F y');
                    })
                    ->addColumn('tanggal_selesai', function ($pkl) {
                        return  formatTanggal($pkl->tanggal_selesai, 'd F y');
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi'])
                    ->make(true);
            }

            return $this->successResponse($pkl, 'Data pkl ditemukan.');
        }

        if ($request->mode == "pdf")
        {
            $namaFile = 'Laporan PKL Tahun ' . $tahun;
            $pdf = PDF::loadView('pages.guru.pkl.PDF', compact('pkl', 'namaFile'));

            $options = [
                'margin_top' => 20,
                'margin_right' => 20,
                'margin_bottom' => 20,
                'margin_left' => 20,
            ];

            $pdf->setOptions($options);
            $pdf->setPaper('legal', 'landscape');


            ob_end_clean();
            ob_start();
            return $pdf->stream($namaFile);
        }

        return view('pages.guru.pkl.index');
    }
    public function show($id)
    {
        $pkl = Pkl::with('user', 'siswa', 'nilaiPembimbing','nilaiDudi')->where('user_id', auth()->user()->id)->findOrFail($id);
        return view('pages.guru.pkl.show', compact('pkl'));
    }

}
