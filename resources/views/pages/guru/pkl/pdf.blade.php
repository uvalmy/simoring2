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
                @forelse($pkl as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->siswa->nis }}</td>
                        <td>{{ $row->siswa->nama }}</td>
                        <td>{{ $row->siswa->kelas->name }}</td>
                        <td>{{ $row->mulai }}</td>
                        <td>{{ $row->selesai }}</td>
                        <td>{{ $row->dudi->name }}</td>
                        <td>{{ $row->pelaksanaan }}</td>
                        <td>{{ $row->laporan }}</td>
                        <td>{{ $row->sertifikat }}</td>
                        <td>{{ $row->akhir }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
