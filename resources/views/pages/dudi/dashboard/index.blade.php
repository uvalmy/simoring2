@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
@endpush

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Siswa PKL</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $pkl ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Laporan Harian Disetujui</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $laporanHarianDisetujui ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Laporan Harian Belum Disetujui</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $laporanHarianBelumDiesetujui ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Laporan Proyek Disetujui</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $laporanProyekDisetujui ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Laporan Proyek Belum Disetujui</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $laporanProyekBelumDiesetujui ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
