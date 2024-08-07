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
                <a href="{{ route('siswa.laporanHarian.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i>Tambah
                </a>
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
                            <th>Dokumentasi</th>
                            <th width="15%">Aksi</th>
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
                    data: 'dokumentasi',
                    name: 'dokumentasi'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);
        });
    </script>
@endpush
