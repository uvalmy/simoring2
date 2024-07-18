<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaLaporanAkhirController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $laporanAkhir = LaporanAkhir::where([
            'pkl_id' => auth('siswa')->user()->pkl->id ?? null,
        ])->first() ?? null;
        if ($request->ajax()) {

            if ($laporanAkhir) {
                $validator = Validator::make($request->all(), [
                    'judul' => 'required',
                    'dokumen' => 'mimes:pdf',
                ]);

                if ($validator->fails()) {
                    return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
                }

                $dokumen = $laporanAkhir->dokumen;
                if ($request->hasFile('dokumen')) {
                    if (Storage::exists('public/laporan/laporan-akhir/' . $dokumen)) {
                        Storage::delete('public/laporan/laporan-akhir/' . $dokumen);
                    }
                    $dokumen = $request->file('dokumen')->hashName();
                    $request->file('dokumen')->storeAs('public/laporan/laporan-akhir', $dokumen);
                }

                $laporanAkhir->update([
                    'judul' => $request->judul,
                    'dokumen' => $dokumen,
                ]);

                return $this->successResponse($laporanAkhir, 'Data laporan akhir diperbarui.');
            } else {
                $validator = Validator::make($request->all(), [
                    'judul' => 'required',
                    'dokumen' => 'required|mimes:pdf',
                ]);

                if ($validator->fails()) {
                    return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
                }

                if ($request->hasFile('dokumen')) {
                    $dokumen = $request->file('dokumen')->hashName();
                    $request->file('dokumen')->storeAs('public/laporan/laporan-akhir', $dokumen);
                }

                $laporanAkhir = LaporanAkhir::create([
                    'pkl_id' => auth('siswa')->user()->pkl->id,
                    'judul' => $request->judul,
                    'dokumen' => $dokumen,
                ]);

                return $this->successResponse($laporanAkhir, 'Data laporan akhir ditambahkan.');
            }

        }
        return view('pages.siswa.laporan-akhir.index', compact('laporanAkhir'));
    }
}
