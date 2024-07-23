<?php

namespace App\Http\Controllers\Staff;

use App\Models\Pengaturan;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffPengaturanController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        $pengaturan = Pengaturan::first();

        if ($request->ajax()) {
            if ($pengaturan) {
                $validator = Validator::make($request->all(), [
                    'buku_panduan' => 'required|mimes:pdf',
                    'persentase_nilai_pelaksanaan' => 'required|numeric',
                    'persentase_nilai_laporan' => 'required|numeric',
                    'persentase_nilai_sertifikat' => 'required|numeric'
                ]);

                if ($validator->fails()) {
                    return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
                }

                $bukuPanduan = $pengaturan->buku_panduan;

                if ($request->hasFile('buku_panduan')) {
                    if (Storage::exists('public/laporan/pengaturan/' . $bukuPanduan)) {
                        Storage::delete('public/laporan/pengaturan/' . $bukuPanduan);
                    }
                    $bukuPanduan = $request->file('buku_panduan')->hashName();
                    $request->file('buku_panduan')->storeAs('public/laporan/pengaturan', $bukuPanduan);
                }

                $pengaturan->update([
                    'buku_panduan' => $bukuPanduan,
                    'persentase_nilai_pelaksanaan' => $request->persentase_nilai_pelaksanaan,
                    'persentase_nilai_laporan' => $request->persentase_nilai_laporan,
                    'persentase_nilai_sertifikat' => $request->persentase_nilai_sertifikat
                ]);

                return $this->successResponse($pengaturan, 'Data berhasil diperbarui.');
            } else {
                $validator = Validator::make($request->all(), [
                    'buku_panduan' => 'required|mimes:pdf',
                    'persentase_nilai_pelaksanaan' => 'required|numeric',
                    'persentase_nilai_laporan' => 'required|numeric',
                    'persentase_nilai_sertifikat' => 'required|numeric'
                ]);

                if ($validator->fails()) {
                    return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
                }

                if ($request->hasFile('buku_panduan')) {
                    $bukuPanduan = $request->file('buku_panduan')->hashName();
                    $request->file('buku_panduan')->storeAs('public/laporan/pengaturan', $bukuPanduan);
                }

                $pengaturan = Pengaturan::create([
                    'buku_panduan' => $bukuPanduan,
                    'persentase_nilai_pelaksanaan' => $request->persentase_nilai_pelaksanaan,
                    'persentase_nilai_laporan' => $request->persentase_nilai_laporan,
                    'persentase_nilai_sertifikat' => $request->persentase_nilai_sertifikat
                ]);

                return $this->successResponse($pengaturan, 'Data berhasil ditambahkan.');
            }
        }

        return view('pages.staff.pengaturan.index', compact('pengaturan'));
    }
}
