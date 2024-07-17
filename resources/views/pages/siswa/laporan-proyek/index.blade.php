@extends('layouts.app')

@section('title', 'Laporan Harian')

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
            @if (auth('siswa')->user()->pkl)
                <button type="button" class="btn btn-primary" onclick="getModal('createModal')">
                    <i class="ti ti-plus me-1"></i>Tambah
                </button>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="laporan-harian-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Elemen</th>
                            <th>Deskripsi</th>
                            <th>Nilai Karakter</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.siswa.laporan-harian.modal')
@endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            datatableCall('laporan-harian-table', '{{ route('siswa.laporanHarian.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'elemen',
                    name: 'elemen'
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    data: 'nilai_karakter',
                    name: 'nilai_karakter'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();

                const kode = $("#saveData #id").val();
                let url = "{{ route('siswa.laporanHarian.store') }}";
                const data = new FormData(this);

                if (kode !== "") {
                    data.append("_method", "PUT");
                    url = `/siswa/laporan-harian/${kode}`;
                }

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, "laporan-harian-table", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ["cp_id", "tanggal", "deskripsi"]);
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
