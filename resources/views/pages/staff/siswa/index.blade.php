@extends('layouts.app')

@section('title', 'Siswa')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('main')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold">Data @yield('title')</h5>
            <button type="button" class="btn btn-primary" onclick="getModal('createModal')">
                <i class="ti ti-plus me-1"></i>Tambah
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="kelas_filter" class="form-label">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas_filter" id="kelas_filter" class="form-control">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $row)
                                <option value="{{ $row->id }}">{{ $row->kode . ' - ' . $row->nama }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errorkelas_filter"></small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="angkatan_filter" class="form-label">Angkatan <span class="text-danger">*</span></label>
                        <select name="angkatan_filter" id="angkatan_filter" class="form-control">
                            <option value="">-- Pilih Angkatan --</option>
                            @php
                                $currentYear = date('Y');
                                $lastTenYears = range($currentYear, $currentYear - 10);
                            @endphp
                            @foreach ($lastTenYears as $year)
                                <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errorangkatan_filter"></small>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="siswa-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Angkatan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.staff.siswa.modal')
@endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            datatableCall('siswa-table', '{{ route('staff.siswa.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nis',
                    name: 'nik'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'angkatan',
                    name: 'angkatan'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#kelas_filter, #angkatan_filter").on("change", function() {
                $("#siswa-table").DataTable().ajax.reload();
            });

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();

                const kode = $("#saveData #id").val();
                let url = "{{ route('staff.siswa.store') }}";
                const data = new FormData(this);

                if (kode !== "") {
                    data.append("_method", "PUT");
                    url = `/staff/siswa/${kode}`;
                }

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, "siswa-table", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["kelas_id", "nis", "nama", "alamat",
                        "telepon", "tempat_lahir", "tanggal_lahir", "angkatan"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $('#kelas_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#createModal")
            });

            $('#kelas_filter').select2({
                theme: 'bootstrap-5'
            });

        });
    </script>
@endpush
