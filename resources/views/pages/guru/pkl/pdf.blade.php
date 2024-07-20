@extends('layouts.pdf')

@section('title', $namaFile)

@push('style')
@endpush

@section('main')
    <div>
        <table width="100%" border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Dudi</th>
                    <th>Nilai Pelaksanaan</th>
                    <th>Nilai Laporan</th>
                    <th>Nilai Sertifikat</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @for ($pkl as $row)
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
