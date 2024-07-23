@extends('layouts.app')

@section('title', 'Pkl')

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
                <div class="col-lg-6 mb-3">
                    <div class="form-group mb-3">
                        <label for="tahun_filter" class="form-label">Tahun <span class="text-danger">*</span></label>
                        <select name="tahun_filter" id="tahun_filter" class="form-control">
                            <option value="">-- Pilih Tahun --</option>
                            @php
                                $currentYear = date('Y');
                                $lastTenYears = range($currentYear, $currentYear - 10);
                            @endphp
                            @foreach ($lastTenYears as $year)
                                <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errortahun_filter"></small>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="pkl-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Siswa</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Guru</th>
                            <th>Dudi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.staff.pkl.modal')
@endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            datatableCall('pkl-table', '{{ route('staff.pkl.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'siswa',
                    name: 'siswa'
                },
                {
                    data: 'tanggal_mulai',
                    name: 'tanggal_mulai'
                },
                {
                    data: 'tanggal_selesai',
                    name: 'tanggal_selesai'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'dudi',
                    name: 'dudi'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#tahun_filter").on("change", function() {
                $("#pkl-table").DataTable().ajax.reload();
            });


            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();

                const kode = $("#saveData #id").val();
                let url = "{{ route('staff.pkl.store') }}";
                const data = new FormData(this);

                if (kode !== "") {
                    data.append("_method", "PUT");
                    url = `/staff/pkl/${kode}`;
                }

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, "pkl-table", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["siswa_id","user_id","dudi_id","tanggal_mulai","tanggal_selesai","posisi"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $('#siswa_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#createModal")
            });
            $('#user_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#createModal")
            });
            $('#dudi_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $("#createModal")
            });

        });
    </script>
@endpush
