@extends('layouts.app')

@section('title', 'Laporan Harian')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('main')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold">Edit Data @yield('title')</h5>
        </div>
        <div class="card-body">
            <form id="saveData" autocomplete="off">
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Dokumentasi <span class="text-danger">* (Dokumentasi harus berupa selfie pada tempat PKL)</span></label>
                    <input type="file" name="dokumentasi" id="dokumentasi" class="dropify" data-height="200"
                        accept=".jpg,.jpeg,.png">
                    <small class="text-danger" id="errordokumentasi"></small>
                </div>
                <div class="form-group mb-3">
                    <label for="cp_id" class="form-label">Cp <span class="text-danger">*</span></label>
                    <select name="cp_id[]" multiple id="cp_id" class="form-control">
                        @foreach ($cp as $row)
                            <option value="{{ $row->id }}"
                                @if(in_array($row->id, $laporanHarian->cp_id)) selected @endif>
                                {{ $row->elemen }}
                            </option>
                        @endforeach
                    </select>
                    <small class="invalid-feedback" id="errorcp_id"></small>
                </div>
                <div class="form-group mb-3">
                    <label for="tanggal" class="form-label">Tanggal<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal" value="{{ $laporanHarian->tanggal }}" name="tanggal">
                    <small class="invalid-feedback" id="errortanggal"></small>
                </div>
                <div class="form-group mb-3">
                    <label for="nilai_karakter" class="form-label">Nilai Karakter <span
                            class="text-danger">*</span></label>
                    <select name="nilai_karakter[]" multiple id="nilai_karakter" class="form-control">
                        @foreach (nilaiKarakter() as $row)
                            <option value="{{ $row }}"
                             @if(in_array($row, $laporanHarian->nilai_karakter))  selected @endif >{{ $row }}</option>
                        @endforeach
                    </select>
                    <small class="invalid-feedback" id="errornilai_karakter"></small>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="4" id="deskripsi" name="deskripsi">{{ $laporanHarian->deskripsi }}</textarea>
                    <small class="invalid-feedback" id="errordeskripsi"></small>
                </div>
                <button type="submit" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Simpan</button>
            </form>
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

                const url = "/siswa/laporan-harian/{{ $laporanHarian->id }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, null, null, "/siswa/laporan-harian");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["cp_id", "tanggal", "deskripsi", "nilai_karakter", "dokumentasi"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $('#cp_id').select2({
                theme: 'bootstrap-5'
            });

            $('#nilai_karakter').select2({
                theme: 'bootstrap-5'
            });

        });
    </script>
@endpush
