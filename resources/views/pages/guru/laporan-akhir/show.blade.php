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
                    <h5 class="card-title fw-semibold">{{ $laporanAkhir->status == 1 ? 'Detail' : 'Edit' }} Data
                        @yield('title')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mb-3 fw-semibold">
                            Siswa
                        </div>
                        <div class="col-lg-12 mb-3">
                            {{ $laporanAkhir->pkl->siswa->nama }}
                        </div>
                        <div class="col-lg-12 mb-3 fw-semibold">
                            Judul
                        </div>
                        <div class="col-lg-12 mb-3">
                            {{ $laporanAkhir->judul }}
                        </div>
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
                    @if ($laporanAkhir->status == 0 || $laporanAkhir->status == 2)
                        <form id="saveData" autocomplete="off">
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control">
                                    <option>-- Pilih Status --</option>
                                    <option value="1">Disetujui</option>
                                    <option value="2">Direvisi</option>
                                </select>
                                <small class="invalid-feedback" id="errorstatus"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="catatan" class="form-label">Catatan <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4" id="catatan" name="catatan"></textarea>
                                <small class="invalid-feedback" id="errorcatatan"></small>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Simpan</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            @if ($laporanAkhir)
                <embed src="/storage/laporan/laporan-akhir/{{ $laporanAkhir->dokumen }}" width="100%" height="600px"
                    type="application/pdf">
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

                const url = "/guru/laporan-akhir/{{ $laporanAkhir->id }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, null, null, "/guru/laporan-akhir");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["status", "catatan"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
