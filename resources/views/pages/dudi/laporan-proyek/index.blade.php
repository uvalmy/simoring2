@extends('layouts.app')

@section('title', 'Laporan Proyek')

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
                <table id="laporan-proyek-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Siswa</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Dokumentasi</th>
                            <th width="10%">Aksi</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            datatableCall('laporan-proyek-table', '{{ route('dudi.laporanProyek.index') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'siswa',
                    name: 'siswa'
                },
                {
                    data: 'judul',
                    name: 'judul'
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

            $("#tahun_filter").on("change", function() {
                $("#laporan-proyek-table").DataTable().ajax.reload();
            });
        });
    </script>
@endpush
