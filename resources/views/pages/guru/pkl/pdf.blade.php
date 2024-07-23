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
                    @php
                        $nilaiAkhir  = 0;
                        if($row->nilaiPembimbing)
                        {
                            $nilaiAkhir = (int) ($row->nilaiPembimbing->nilai_pelaksanaan * (getPengaturan()->persentase_nilai_pelaksanaan / 100 )) + (int) ($row->nilaiPembimbing->nilai_laporan * (getPengaturan()->persentase_nilai_laporan / 100 )) + (int) ($row->nilaiPembimbing->nilai_sertifikat * (getPengaturan()->persentase_nilai_sertifikat / 100 ));
                        }
                    @endphp
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td align="center">{{ $row->siswa->nis }}</td>
                        <td>{{ $row->siswa->nama }}</td>
                        <td>{{ $row->siswa->kelas->nama }}</td>
                        <td>{{ formatTanggal($row->tanggal_mulai, 'd F Y') }}</td>
                        <td>{{ formatTanggal($row->tanggal_selesai, 'd F Y') }}</td>
                        <td>{{ $row->dudi->nama }}</td>
                        <td align="center">{{ $row->nilaiPembimbing->nilai_pelaksanaan ?? 0 }}</td>
                        <td align="center">{{ $row->nilaiPembimbing->nilai_laporan ?? 0 }}</td>
                        <td align="center">{{ $row->nilaiPembimbing->nilai_sertifikat ?? 0 }}</td>
                        <td align="center">{{ $nilaiAkhir }}</td>
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
