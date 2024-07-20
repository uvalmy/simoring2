@extends('layouts.app')

@section('title', 'Laporan Akhir')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('main')
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold">Data @yield('title')</h5>
                </div>
                <div class="card-body">
                    <p>Download Buku Panduan PKL di  <a class="border-bottom border-2 border-primary" download href="/storage/laporan/pengaturan/{{ getPengaturan()->buku_panduan }}">Download</a> </p>
                    @if (auth('siswa')->user()->pkl)
                        @if (!$laporanAkhir || $laporanAkhir->status == 0 || $laporanAkhir->status == 2)
                            <form id="saveData" autocomplete="off">
                                <div class="form-group mb-3">
                                    <label for="judul" class="form-label">Judul <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul"
                                        value="{{ $laporanAkhir ? $laporanAkhir->judul : null }}" name="judul">
                                    <small class="invalid-feedback" id="errorjudul"></small>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="dokumen" class="form-label">Laporan <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="dokumen" id="dokumen" class="dropify" data-height="200"
                                        accept=".pdf">
                                    <small class="text-danger" id="errordokumen"></small>
                                </div>
                                <button type="submit" class="btn btn-primary"><i
                                        class="ti ti-plus me-1"></i>Simpan</button>
                            </form>
                        @endif
                        @if ($laporanAkhir)
                            <div class="row">
                                @if ($laporanAkhir->status == 1)
                                    <div class="col-lg-12 mb-3 fw-semibold">
                                        Judul
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        {{ $laporanAkhir->judul ?? '-' }}
                                    </div>
                                @endif
                                <div class="col-lg-12 mb-3 fw-semibold">
                                    Status
                                </div>
                                <div class="col-lg-12 mb-3">
                                    {!! statusBadge($laporanAkhir->status) !!}
                                </div>
                                <div class="col-lg-12 mb-3 fw-semibold">
                                    Catatan
                                </div>
                                <div class="col-lg-12 mb-3">
                                    {{ $laporanAkhir->catatan ?? '-' }}
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="w-100 py-5 my-5 text-center">Data PKL Tidak ditemukan</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            @if ($laporanAkhir)
                <embed src="/storage/laporan/laporan-akhir/{{ $laporanAkhir->dokumen }}" width="100%" height="500px"
                    type="application/pdf">
                <div class="mt-3">

                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="{{ asset('libs/dropify/js/dropify.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();

                const url = "{{ route('siswa.laporanAkhir') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, null, null, "/siswa/laporan-akhir");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["judul", "dokumen"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
