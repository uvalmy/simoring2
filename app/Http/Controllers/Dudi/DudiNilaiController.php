<?php

namespace App\Http\Controllers\Dudi;

use App\Models\NilaiDudi;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DudiNilaiController extends Controller
{
    use ApiResponder;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prestasi_kerja' => 'required|integer|min:0|max:100',
            'kehadiran_dan_disiplin' => 'required|integer|min:0|max:100',
            'inisiatif_dan_kreatifitas' => 'required|integer|min:0|max:100',
            'kerjasama' => 'required|integer|min:0|max:100',
            'tanggung_jawab' => 'required|integer|min:0|max:100',
            'sikap' => 'required|integer|min:0|max:100',
            'kompetensi_keahlian' => 'required|integer|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }


        $nilaiDudi = NilaiDudi::where('pkl_id', $request->pkl_id)->first();

        if($nilaiDudi){
            $nilaiDudi->update($request->only('prestasi_kerja', 'kehadiran_dan_disiplin', 'inisiatif_dan_kreatifitas', 'kerjasama', 'tanggung_jawab', 'sikap', 'kompetensi_keahlian'));
        } else {
            $nilaiDudi = NilaiDudi::create($request->only('prestasi_kerja', 'kehadiran_dan_disiplin', 'inisiatif_dan_kreatifitas', 'kerjasama', 'tanggung_jawab', 'sikap', 'kompetensi_keahlian', 'pkl_id'));
        }

        return $this->successResponse($nilaiDudi, 'Data berhasil disimpan');
    }
}
