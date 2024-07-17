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
                @if (auth('siswa')->user()->pkl)
                    <div class="col-lg-4 mb-3">Guru Pembimbing</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->user->nama }}</div>
                    <div class="col-lg-4 mb-3">Telepon Pembimbing</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->user->telepon }}</div>
                    <div class="col-lg-4 mb-3">Email Pembimbing</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->user->email }}</div>
                    <div class="col-lg-4 mb-3">Nama Perusahaan PKL</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->dudi->nama }}</div>
                    <div class="col-lg-4 mb-3">Instansi</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->dudi->instansi }}</div>
                    <div class="col-lg-4 mb-3">Alamat Perusahaan</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->dudi->alamat }}</div>
                    <div class="col-lg-4 mb-3">Telepon Perusahaan</div>
                    <div class="col-lg-8 mb-3">: {{ auth('siswa')->user()->pkl->dudi->telepon }}</div>
                @else
                    <div class="col-12 py-5 my-5 text-center">Data PKL Tidak ditemukan</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
@endpush
