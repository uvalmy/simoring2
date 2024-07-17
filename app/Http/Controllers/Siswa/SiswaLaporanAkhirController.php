<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Cp;
use App\Models\LaporanAkhir;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SiswaLaporanAkhirController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanAkhir = LaporanAkhir::where([
                'pkl_id' => auth('siswa')->user()->pkl->id,
            ])->first();

            if($laporanAkhir){
                $validator = Validator::make($request->all(), [
                    'judul' => 'required',
                    'dokumen' => 'mimes:pdf',
                ]);

                if ($validator->fails()) {
                    return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
                }

                $dokumentasi = $laporanAkhir->dokumentasi;
                if ($request->hasFile('dokumentasi')) {
                    if (Storage::exists('public/gambar/laporan-akhir/' . $dokumentasi)) {
                        Storage::delete('public/gambar/laporan-akhir/' . $dokumentasi);
                    }
                    $dokumentasi = $request->file('dokumentasi')->hashName();
                    $request->file('dokumentasi')->storeAs('public/gambar/laporan-akhir', $dokumentasi);
                }


                $laporanAkhir->update([
                    'judul' => $request->judul,
                    'dokumen' => 'mimes:pdf',
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
        return view('pages.siswa.laporan-akhir.index');
    }
}
