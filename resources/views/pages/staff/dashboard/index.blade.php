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
                        <h5>Jurusan</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-tools h1"></i>
                            <h1>{{ $jurusan ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Kelas</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-school h1"></i>
                            <h1>{{ $kelas ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Guru</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-user h1"></i>
                            <h1>{{ $user ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Siswa</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-users h1"></i>
                            <h1>{{ $siswa ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Dudi</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-building h1"></i>
                            <h1>{{ $dudi ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>PKL</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-news h1"></i>
                            <h1>{{ $pkl ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
