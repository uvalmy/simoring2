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
            <div class="table-responsive">
                <table id="laporan-harian-table" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Siswa</th>
                            <th>Cp</th>
                            <th>Deskripsi Kegiatan</th>
                            <th>Tanggal</th>
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
            datatableCall('laporan-harian-table', '{{ route('dudi.laporanHarian') }}', [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'siswa',
                    name: 'siswa'
                },
                {
                    data: 'cp',
                    name: 'cp'
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
            ]);
        });
    </script>
@endpush
