<?php

namespace App\Http\Controllers\Guru;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\NilaiPembimbing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GuruNilaiController extends Controller
{
    use ApiResponder;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nilai_pelaksanaan' => 'required|integer|min:0|max:100',
            'nilai_laporan' => 'required|integer|min:0|max:100',
            'nilai_sertifikat' => 'required|integer|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $nilaiPembimbing = NilaiPembimbing::where('pkl_id', $request->pkl_id)->first();

        if($nilaiPembimbing){
            $nilaiPembimbing->update($request->only('nilai_pelaksanaan', 'nilai_laporan', 'nilai_sertifikat'));
        } else {
            $nilaiPembimbing = NilaiPembimbing::create($request->only('nilai_pelaksanaan', 'nilai_laporan', 'nilai_sertifikat', 'pkl_id'));
        }

        return $this->successResponse($nilaiPembimbing, 'Data berhasil disimpan');
    }
}
