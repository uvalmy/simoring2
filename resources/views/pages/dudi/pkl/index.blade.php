@extends('layouts.app')

@section('title', 'Pkl')

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
                            <th>Pembimbing Dudi</th>
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

    <script>
        $(document).ready(function() {
            datatableCall('pkl-table', '{{ route('dudi.pkl.index') }}', [{
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
                    data: 'pembimbing_dudi',
                    name: 'pembimbing_dudi'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]);

            $("#tahun_filter").on("change", function() {
                $("#pkl-table").DataTable().ajax.reload();
            });
        });
    </script>
@endpush
