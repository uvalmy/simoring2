@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
@endpush

@section('main')

    @php
        $pkl = auth('siswa')->user()->pkl ?? null;
    @endphp
    @if($pkl)
        <div class="row">
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Laporan Harian</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $pkl->laporanHarian()->where('status', '1')->count() ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Laporan Proyek</h5>
                        <div class="d-flex gap-2">
                            <i class="ti ti-file-description h1"></i>
                            <h1>{{ $pkl->laporanProyek()->where('status', '1')->count() ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-semibold">Data @yield('title')</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @if ($pkl)
                    <div class="col-lg-4 mb-3">Guru Pembimbing</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->user->nama }}</div>
                    <div class="col-lg-4 mb-3">Telepon Pembimbing</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->user->telepon }}</div>
                    <div class="col-lg-4 mb-3">Email Pembimbing</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->user->email }}</div>
                    <div class="col-lg-4 mb-3">Nama Perusahaan PKL</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->dudi->nama }}</div>
                    <div class="col-lg-4 mb-3">Instansi</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->dudi->instansi }}</div>
                    <div class="col-lg-4 mb-3">Pembimbing dudi</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->dudi->pembimbing }}</div>
                    <div class="col-lg-4 mb-3">Alamat Perusahaan</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->dudi->alamat }}</div>
                    <div class="col-lg-4 mb-3">Telepon Perusahaan</div>
                    <div class="col-lg-8 mb-3">: {{ $pkl->dudi->telepon }}</div>
                    <div class="col-lg-4 mb-3">Tanggal Mulai</div>
                    <div class="col-lg-8 mb-3">: {{ formatTanggal($pkl->tanggal_mulai, 'd F y') }}</div>
                    <div class="col-lg-4 mb-3">Tanggal Selesai</div>
                    <div class="col-lg-8 mb-3">: {{ formatTanggal($pkl->tanggal_selesai, 'd F y') }}</div>
                @else
                    <div class="col-12 py-5 my-5 text-center">Data PKL Tidak ditemukan</div>
                @endif
            </div>
        </div>
    </div>
    @if($pkl)
        @if($pkl->nilaiDudi)
            <div class="col-12 mb-3">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title fw-semibold"> Data Nilai Dudi</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $totalNilai = $pkl->nilaiDudi->prestasi_kerja + $pkl->nilaiDudi->kehadiran_dan_disiplin + $pkl->nilaiDudi->inisiatif_dan_kreatifitas + $pkl->nilaiDudi->kerjasama + $pkl->nilaiDudi->tanggung_jawab + $pkl->nilaiDudi->sikap + $pkl->nilaiDudi->kompetensi_keahlian;
                            $rataRata = (int) ($totalNilai / 7)
                        @endphp
                        <input type="hidden" name="pkl_id" id="pkl_id" value="{{ $pkl->id }}">
                        <table class="table table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Komponen</th>
                                    <th width="20%">Predikat</th>
                                    <th width="20%">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Prestasi Kerja</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->prestasi_kerja) }}</td>
                                    <td>{{ $pkl->nilaiDudi->prestasi_kerja }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Kehadiran dan Disiplin</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->kehadiran_dan_disiplin) }}</td>
                                    <td>{{ $pkl->nilaiDudi->kehadiran_dan_disiplin }}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Inisiatif dan Kreatifitas</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->inisiatif_dan_kreatifitas) }}</td>
                                    <td>{{ $pkl->nilaiDudi->inisiatif_dan_kreatifitas }}</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Kerjasama</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->kerjasama) }}</td>
                                    <td>{{ $pkl->nilaiDudi->kerjasama }}</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Tanggung Jawab</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->tanggung_jawab) }}</td>
                                    <td>{{ $pkl->nilaiDudi->tanggung_jawab }}</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Sikap</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->sikap) }}</td>
                                    <td>{{ $pkl->nilaiDudi->sikap }}</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Kompetensi Keahlian</td>
                                    <td>{{ getPredikat($pkl->nilaiDudi->kompetensi_keahlian) }}</td>
                                    <td>{{ $pkl->nilaiDudi->kompetensi_keahlian }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <td>
                                        {{ $totalNilai }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3">Rata Rata</th>
                                    <td>
                                        {{ $rataRata }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @endif
    @if($pkl)
        @if($pkl->nilaiPembimbing)
            <div class="col-12 mb-3">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title fw-semibold"> Data Nilai Pembimbing</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $totalNilaiPembimbing = (int) ($pkl->nilaiPembimbing->nilai_pelaksanaan * (getPengaturan()->persentase_nilai_pelaksanaan / 100 )) + (int) ($pkl->nilaiPembimbing->nilai_laporan * (getPengaturan()->persentase_nilai_laporan/ 100 )) + (int) ($pkl->nilaiPembimbing->nilai_sertifikat * (getPengaturan()->persentase_nilai_sertifikat / 100 ));
                        @endphp
                        <table class="table table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Komponen</th>
                                    <th width="20%">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nilai Pelaksanaan PKL</td>
                                    <td>
                                        {{ $pkl->nilaiPembimbing->nilai_pelaksanaan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Nilai Laporan</td>
                                    <td>
                                        {{ $pkl->nilaiPembimbing->nilai_laporan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Nilai Sertifikat (Tempat PKL)</td>
                                    <td>
                                        {{ $pkl->nilaiPembimbing->nilai_sertifikat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">Nilai Akhir</th>
                                    <td>
                                        {{ $totalNilaiPembimbing  }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    @endif
 @endsection

@push('scripts')
    <script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
@endpush
