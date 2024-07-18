@extends('layouts.app')

@section('title', 'Laporan Akhir')

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
            <div class="table-responsive">
                <table id="laporan-akhir-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Siswa</th>
                            <th>Judul</th>
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
@endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            datatableCall('laporan-akhir-table', '{{ route('guru.laporanAkhir.index') }}', [{
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
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);
        });
    </script>
@endpush
