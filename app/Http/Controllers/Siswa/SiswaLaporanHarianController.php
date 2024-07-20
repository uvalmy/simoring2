<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Cp;
use App\Models\LaporanHarian;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SiswaLaporanHarianController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laporanHarians = auth('siswa')->user()->pkl ? LaporanHarian::where('pkl_id', auth('siswa')->user()->pkl->id)->orderBy('tanggal', 'desc')->get() : [];
            if ($request->mode == "datatable") {
                return DataTables::of($laporanHarians)
                    ->addColumn('aksi', function ($laporanHarian) {
                        $editButton = '<a class="btn btn-sm btn-warning me-1" href="/siswa/laporan-harian/' . $laporanHarian->id . '">
                        <i class="ti ti-edit me-1"></i>Edit</a>';
                        $detailButton = '<a class="btn btn-sm btn-info me-1" href="/siswa/laporan-harian/' . $laporanHarian->id . '"><i class="ti ti-eye me-1"></i>Detail</a>';
                        $deleteButton = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/siswa/laporan-harian/' . $laporanHarian->id . '`, `laporan-harian-table`)"><i class="ti ti-trash me-1"></i>Hapus</button>';
                        return $laporanHarian->status == 0 ? $editButton . $deleteButton : $detailButton;
                    })
                    ->addColumn('elemen', function ($laporanHarian) {
                        return Cp::whereIn('id', $laporanHarian->cp_id)->pluck('elemen')->implode(', ');
                    })
                    ->addColumn('tanggal', function ($laporanHarian) {
                        return  formatTanggal($laporanHarian->tanggal, 'd F y');
                    })
                    ->addColumn('status', function ($laporanHarian) {
                        return statusBadge($laporanHarian->status);
                    })
                    ->addColumn('dokumentasi', function ($laporanHarian) {
                        return '<img src="/storage/gambar/laporan-harian/' . $laporanHarian->dokumentasi . '" width="150px" alt="">';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['elemen', 'deskripsi-cp', 'aksi', 'status', 'dokumentasi'])
                    ->make(true);
            }

            return $this->successResponse($laporanHarians, 'Data laporan harian ditemukan.');
        }

        $cp = Cp::where('jurusan_id', auth('siswa')->user()->kelas->jurusan->id)->get();
        return view('pages.siswa.laporan-harian.index', compact('cp'));
    }

    public function create()
    {
        $cp = Cp::where('jurusan_id', auth('siswa')->user()->kelas->jurusan->id)->get();
        return view('pages.siswa.laporan-harian.create', compact('cp'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cp_id' => 'required|array',
            'tanggal' => 'required|date|before_or_equal:today',
            'deskripsi' => 'required|string',
            'nilai_karakter' => 'required|array',
            'dokumentasi' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $cekLaporanHarian = LaporanHarian::where([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'tanggal' => $request->tanggal,
        ])->first();

        if ($cekLaporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian sudah ada.', 409);
        }

        $dokumentasi = null;

        if ($request->hasFile('dokumentasi')) {
            try {
                $image = $request->file('dokumentasi');
                $dokumentasi = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'public/gambar/laporan-harian/';
                $originalPath = $imagePath . $dokumentasi;
                $compressedPath = $imagePath . 'compressed-' . $dokumentasi;

                $image->storeAs($imagePath, $dokumentasi);

                $sourceImage = storage_path('app/' . $originalPath);
                $compressImage = storage_path('app/' . $compressedPath);

                compressImage($sourceImage, $compressImage);

                if (Storage::exists($originalPath)) {
                    Storage::delete($originalPath);
                }

                Storage::move($compressedPath, $originalPath);

            } catch (\Exception $e) {
                return $this->errorResponse(null, 'Terjadi kesalahan saat memproses gambar.', 500);
            }
        }

        $laporanHarian = LaporanHarian::create([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'cp_id' => $request->cp_id,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'dokumentasi' => $dokumentasi,
            'nilai_karakter' => $request->nilai_karakter,
        ]);
        return $this->successResponse($laporanHarian, 'Data laporan harian ditambahkan.');
    }

    public function show(Request $request, $id)
    {
        $laporanHarian = LaporanHarian::findOrFail($id);
        $cp = Cp::where('jurusan_id', auth('siswa')->user()->kelas->jurusan->id)->get();
        return view('pages.siswa.laporan-harian.show', compact('laporanHarian', 'cp'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cp_id' => 'required|array',
            'tanggal' => 'required|date|before_or_equal:today',
            'deskripsi' => 'required|string',
            'nilai_karakter' => 'required|array',
            'dokumentasi' => 'image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $laporanHarian = LaporanHarian::find($id);

        if (!$laporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
        }

        $cekLaporanHarian = LaporanHarian::where([
            'pkl_id' => auth('siswa')->user()->pkl->id,
            'tanggal' => $request->tanggal,
        ])->whereNot('id', $laporanHarian->id)->first();

        if ($cekLaporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian sudah ada.', 409);
        }

        $dokumentasi = $laporanHarian->dokumentasi;
        if ($request->hasFile('dokumentasi')) {
            if (Storage::exists('public/gambar/laporan-harian/' . $dokumentasi)) {
                Storage::delete('public/gambar/laporan-harian/' . $dokumentasi);
            }

            try {
                $image = $request->file('dokumentasi');
                $dokumentasi = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'public/gambar/laporan-harian/';
                $originalPath = $imagePath . $dokumentasi;
                $compressedPath = $imagePath . 'compressed-' . $dokumentasi;

                $image->storeAs($imagePath, $dokumentasi);

                $sourceImage = storage_path('app/' . $originalPath);
                $compressImage = storage_path('app/' . $compressedPath);

                compressImage($sourceImage, $compressImage);

                if (Storage::exists($originalPath)) {
                    Storage::delete($originalPath);
                }

                Storage::move($compressedPath, $originalPath);

            } catch (\Exception $e) {
                return $this->errorResponse(null, 'Terjadi kesalahan saat memproses gambar.', 500);
            }
        }

        $laporanHarian->update([
            'cp_id' => $request->cp_id,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'dokumentasi' => $dokumentasi,
            'nilai_karakter' => $request->nilai_karakter,
        ]);
        return $this->successResponse($laporanHarian, 'Data laporan harian diperbarui.');
    }

    public function destroy($id)
    {
        $laporanHarian = LaporanHarian::find($id);

        if (!$laporanHarian) {
            return $this->errorResponse(null, 'Data laporan harian tidak ditemukan.', 404);
        }

        if (Storage::exists('public/gambar/laporan-harian/' . $laporanHarian->dokumentasi)) {
            Storage::delete('public/gambar/laporan-harian/' . $laporanHarian->dokumentasi);
        }
        $laporanHarian->delete();
        return $this->successResponse(null, 'Data laporan harian dihapus.');
    }
}
