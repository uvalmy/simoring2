<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Siswa\SiswaLaporanProyekController;
use App\Models\LaporanProyek;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SiswaLaporanProyekController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanProyeks = auth('siswa')->user()->pkl ? LaporanProyek::where('pkl_id', auth('siswa')->user()->pkl->id)->orderBy('tanggal', 'desc')->get() : [];
            if ($request->mode == "datatable") {
                return DataTables::of($laporanProyeks)
                    ->addColumn('aksi', function ($laporanProyek) {
                        $editButton = '<a class="btn btn-sm btn-warning me-1" href="/siswa/laporan-proyek/' . $laporanProyek->id . '">
                        <i class="ti ti-edit me-1"></i>Edit</a>';
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/siswa/laporan-proyek/' . $laporanProyek->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';

                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/siswa/laporan-proyek/' . $laporanProyek->id . '`, `laporan-proyek-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $laporanProyek->status == 0 ? $editButton . $deleteButton : $detailButton;
                    })
                    ->addColumn('dokumentasi', function ($laporanProyek) {
                        return '<img src="/storage/gambar/laporan-proyek/' . $laporanProyek->dokumentasi . '" width="150px" alt="">';
                    })
                    ->addColumn('status', function ($laporanProyek) {
                        return statusBadge($laporanProyek->status);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'dokumentasi', 'status'])
                    ->make(true);
            }

            return $this->successResponse($laporanProyeks, 'Data laporan proyek ditemukan.');
        }

        return view('pages.siswa.laporan-proyek.index');
    }

    public function create()
    {
        return view('pages.siswa.laporan-proyek.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tanggal' => 'required|date|before_or_equal:today',
            'deskripsi' => 'required',
            'saran' => 'required',
            'dokumentasi' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $cekLaporanProyek = LaporanProyek::where([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'tanggal' => $request->tanggal,
        ])->first();

        if ($cekLaporanProyek) {
            return $this->errorResponse(null, 'Data laporan proyek sudah ada.', 409);
        }

        if ($request->hasFile('dokumentasi')) {
            $dokumentasi = $request->file('dokumentasi')->hashName();
            $request->file('dokumentasi')->storeAs('public/gambar/laporan-proyek', $dokumentasi);
        }

        $laporanProyek = LaporanProyek::create([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'saran' => $request->saran,
            'dokumentasi' => $dokumentasi,
        ]);
        return $this->successResponse($laporanProyek, 'Data laporan proyek ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        $laporanProyek = LaporanProyek::findOrFail($id);
        return view('pages.siswa.laporan-proyek.show', compact('laporanProyek'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tanggal' => 'required|date|before_or_equal:today',
            'deskripsi' => 'required',
            'saran' => 'required',
            'dokumentasi' => 'image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanProyek = LaporanProyek::find($id);

        if (!$laporanProyek) {
            return $this->errorResponse(null, 'Data laporan proyek tidak ditemukan.', 404);
        }

        $cekLaporanProyek = LaporanProyek::where([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'tanggal' => $request->tanggal,
        ])->whereNot('id', $laporanProyek->id)->first();

        if ($cekLaporanProyek) {
            return $this->errorResponse(null, 'Data laporan proyek sudah ada.', 409);
        }

        $dokumentasi = $laporanProyek->dokumentasi;
        if ($request->hasFile('dokumentasi')) {
            if (Storage::exists('public/gambar/laporan-proyek/' . $dokumentasi)) {
                Storage::delete('public/gambar/laporan-proyek/' . $dokumentasi);
            }
            $dokumentasi = $request->file('dokumentasi')->hashName();
            $request->file('dokumentasi')->storeAs('public/gambar/laporan-proyek', $dokumentasi);
        }

        $laporanProyek->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'saran' => $request->saran,
            'dokumentasi' => $dokumentasi,
        ]);
        return $this->successResponse($laporanProyek, 'Data laporan proyek diperbarui.');
    }

    public function destroy($id)
    {
        $laporanProyek = LaporanProyek::find($id);

        if (!$laporanProyek) {
            return $this->errorResponse(null, 'Data laporan proyek tidak ditemukan.', 404);
        }

        if (Storage::exists('public/gambar/laporan-proyek/' . $laporanProyek->dokumentasi)) {
            Storage::delete('public/gambar/laporan-proyek/' . $laporanProyek->dokumentasi);
        }
        $laporanProyek->delete();
        return $this->successResponse(null, 'Data laporan proyek dihapus.');
    }
}