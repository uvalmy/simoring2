@extends('layouts.app')

@section('title', 'Pengaturan')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.css') }}" />
@endpush

@section('main')
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold">Data @yield('title')</h5>
                </div>
                <div class="card-body">
                    <form id="saveData" autocomplete="off">
                        <div class="form-group mb-3">
                            <label for="buku_panduan" class="form-label">Buku Panduan <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="buku_panduan" id="buku_panduan" class="dropify" data-height="200"
                                accept=".pdf">
                            <small class="text-danger" id="errorbuku_panduan"></small>
                        </div>
                        @if($pengaturan)
                            <div class="form-group mb-3">
                                <label for="persentase_nilai_pelaksanaan" class="form-label">Persentase Nilai Pelaksanaan <span class="text-danger">*</span></label>
                                <input type="number" value="{{ $pengaturan->persentase_nilai_pelaksanaan }}" class="form-control" id="persentase_nilai_pelaksanaan" name="persentase_nilai_pelaksanaan">
                                <small class="invalid-feedback" id="errorpersentase_nilai_pelaksanaan"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="persentase_nilai_laporan" class="form-label">Persentase Nilai Laporan <span class="text-danger">*</span></label>
                                <input type="number" value="{{ $pengaturan->persentase_nilai_laporan }}" class="form-control" id="persentase_nilai_laporan" name="persentase_nilai_laporan">
                                <small class="invalid-feedback" id="errorpersentase_nilai_laporan"></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="persentase_nilai_sertifikat" class="form-label">Persentase Nilai Sertifikat <span class="text-danger">*</span></label>
                                <input type="number" value="{{ $pengaturan->persentase_nilai_sertifikat }}" class="form-control" id="persentase_nilai_sertifikat" name="persentase_nilai_sertifikat">
                                <small class="invalid-feedback" id="errorpersentase_nilai_sertifikat"></small>
                            </div>
                        @else
                        <div class="form-group mb-3">
                            <label for="persentase_nilai_pelaksanaan" class="form-label">Persentase Nilai Pelaksanaan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="persentase_nilai_pelaksanaan" name="persentase_nilai_pelaksanaan">
                            <small class="invalid-feedback" id="errorpersentase_nilai_pelaksanaan"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="persentase_nilai_laporan" class="form-label">Persentase Nilai Laporan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="persentase_nilai_laporan" name="persentase_nilai_laporan">
                            <small class="invalid-feedback" id="errorpersentase_nilai_laporan"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="persentase_nilai_sertifikat" class="form-label">Persentase Nilai Sertifikat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="persentase_nilai_sertifikat" name="persentase_nilai_sertifikat">
                            <small class="invalid-feedback" id="errorpersentase_nilai_sertifikat"></small>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary"><i
                                class="ti ti-plus me-1"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            @if ($pengaturan)
                <embed src="/storage/laporan/pengaturan/{{ $pengaturan->buku_panduan }}" width="100%" height="500px"
                    type="application/pdf">
                <div class="mt-3">

                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('libs/dropify/js/dropify.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();

                const url = "{{ route('staff.pengaturan') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, null, null, "/staff/pengaturan");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["buku_panduan","persentase_nilai_pelaksanaan","persentase_nilai_laporan","persentase_nilai_sertifikat"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
