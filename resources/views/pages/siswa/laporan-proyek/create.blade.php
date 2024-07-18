@extends('layouts.app')

@section('title', 'Laporan Proyek')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('main')
    <div class="row col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold">Tambah Data @yield('title')</h5>
            </div>
            <div class="card-body">
                <form id="saveData" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul">
                        <small class="invalid-feedback" id="errorjudul"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal" class="form-label">Tanggal<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <small class="invalid-feedback" id="errortanggal"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="deskripsi" name="deskripsi"></textarea>
                        <small class="invalid-feedback" id="errordeskripsi"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="saran" class="form-label">Saran <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="saran" name="saran"></textarea>
                        <small class="invalid-feedback" id="errorsaran"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Dokumentasi <span class="text-danger">*</span></label>
                        <input type="file" name="dokumentasi" id="dokumentasi" class="dropify" data-height="200"
                            accept=".jpg,.jpeg,.png">
                        <small class="text-danger" id="errordokumentasi"></small>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Simpan</button>
                </form>
            </div>
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

                const url = "{{ route('siswa.laporanProyek.store') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, null, null, "/siswa/laporan-proyek");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["judul", "tanggal", "deskripsi", "saran",
                        "dokumentasi"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
