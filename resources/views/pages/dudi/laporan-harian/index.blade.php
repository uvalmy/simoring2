@extends('layouts.app')

@section('title', 'Laporan Harian')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
@endpush

@section('main')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold">Data @yield('title')</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-3">
                        <label for="tanggal_filter" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="tanggal_filter"
                            name="tanggal_filter">
                        <small class="invalid-feedback" id="errortanggal_filter"></small>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="laporan-harian-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Siswa</th>
                            <th>Elemen</th>
                            <th>Deskripsi</th>
                            <th>Nilai Karakter</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Dokumentasi</td>
                            <th>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            datatableCall('laporan-harian-table', '{{ route('dudi.laporanHarian.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'siswa',
                    name: 'siswa'
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
                    data: 'dokumentasi',
                    name: 'dokumentasi'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#tanggal_filter").on("change", function() {
                $("#laporan-harian-table").DataTable().ajax.reload();
            });
        });

        const confirmStatus = (url, tableId) => {

                    const data = null;

                    const successCallback = function(response) {
                        handleSuccess(response, tableId, null);
                    };

                    const errorCallback = function(error) {
                        console.log(error);
                    };

                    ajaxCall(url, "PUT", data, successCallback, errorCallback);
        };
    </script>
@endpush
