@extends('layouts.app')

@section('title', 'Nilai')

@push('style')
    <link rel="stylesheet" href="{{ asset('libs/datatables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/dropify/css/dropify.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('main')
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
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold"> Data Siswa</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">NIS</div>
                        <div class="col-lg-8 mb-3">: {{ $pkl->siswa->nis }}</div>
                        <div class="col-lg-4 mb-3">Nama siswa</div>
                        <div class="col-lg-8 mb-3">: {{ $pkl->siswa->nama }}</div>
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
                        <div class="col-lg-4 mb-3">Alamat Perusahaan</div>
                        <div class="col-lg-8 mb-3">: {{ $pkl->dudi->alamat }}</div>
                        <div class="col-lg-4 mb-3">Telepon Perusahaan</div>
                        <div class="col-lg-8 mb-3">: {{ $pkl->dudi->telepon }}</div>
                        <div class="col-lg-4 mb-3">Tanggal Mulai</div>
                        <div class="col-lg-8 mb-3">: {{ formatTanggal($pkl->tanggal_mulai, 'd F y') }}</div>
                        <div class="col-lg-4 mb-3">Tanggal Selesai</div>
                        <div class="col-lg-8 mb-3">: {{ formatTanggal($pkl->tanggal_selesai, 'd F y') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold"> Data Nilai Siswa</h5>
                </div>
                <div class="card-body">
                    <form id="saveData" autocomplete="off">
                        @if($pkl->nilaiDudi)
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
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->prestasi_kerja }}" name="prestasi_kerja" id="prestasi_kerja" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorprestasi_kerja"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Kehadiran dan Disiplin</td>
                                        <td>{{ getPredikat($pkl->nilaiDudi->kehadiran_dan_disiplin) }}</td>
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->kehadiran_dan_disiplin }}" name="kehadiran_dan_disiplin" id="kehadiran_dan_disiplin" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorkehadiran_dan_disiplin"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Inisiatif dan Kreatifitas</td>
                                        <td>{{ getPredikat($pkl->nilaiDudi->inisiatif_dan_kreatifitas) }}</td>
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->inisiatif_dan_kreatifitas }}" name="inisiatif_dan_kreatifitas" id="inisiatif_dan_kreatifitas" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorinisiatif_dan_kreatifitas"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Kerjasama</td>
                                        <td>{{ getPredikat($pkl->nilaiDudi->kerjasama) }}</td>
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->kerjasama }}" name="kerjasama" id="kerjasama" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorkerjasama"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Tanggung Jawab</td>
                                        <td>{{ getPredikat($pkl->nilaiDudi->tanggung_jawab) }}</td>
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->tanggung_jawab }}" name="tanggung_jawab" id="tanggung_jawab" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errortanggung_jawab"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Sikap</td>
                                        <td>{{ getPredikat($pkl->nilaiDudi->sikap) }}</td>
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->sikap }}" name="sikap" id="sikap" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorsikap"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Kompetensi Keahlian</td>
                                        <td>{{ getPredikat($pkl->nilaiDudi->kompetensi_keahlian) }}</td>
                                        <td>
                                            <input type="number" value="{{ $pkl->nilaiDudi->kompetensi_keahlian }}" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorkompetensi_keahlian"></small>
                                        </td>
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
                        @else
                            <input type="hidden" name="pkl_id" id="pkl_id" value="{{ $pkl->id }}">
                            <table class="table table-bordered mb-3">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Komponen</th>
                                        <th width="30%">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Prestasi Kerja</td>
                                        <td>
                                            <input type="number" name="prestasi_kerja" id="prestasi_kerja" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorprestasi_kerja"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Kehadiran dan Disiplin</td>
                                        <td>
                                            <input type="number" name="kehadiran_dan_disiplin" id="kehadiran_dan_disiplin" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorkehadiran_dan_disiplin"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Inisiatif dan Kreatifitas</td>
                                        <td>
                                            <input type="number" name="inisiatif_dan_kreatifitas" id="inisiatif_dan_kreatifitas" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorinisiatif_dan_kreatifitas"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Kerjasama</td>
                                        <td>
                                            <input type="number" name="kerjasama" id="kerjasama" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorkerjasama"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Tanggung Jawab</td>
                                        <td>
                                            <input type="number" name="tanggung_jawab" id="tanggung_jawab" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errortanggung_jawab"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Sikap</td>
                                        <td>
                                            <input type="number" name="sikap" id="sikap" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorsikap"></small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Kompetensi Keahlian</td>
                                        <td>
                                            <input type="number" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" min="0" max="100">
                                            <small class="text-danger" id="errorkompetensi_keahlian"></small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                        <button type="submit" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="{{ asset('libs/dropify/js/dropify.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();

                const url = "{{ route('dudi.nilai') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleSuccess(response, null, null, "/dudi/pkl/{{ $pkl->id }}");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false,
                        `<i class="ti ti-plus me-1"></i>Simpan`);
                    handleValidationErrors(error, "saveData", ['prestasi_kerja', 'kehadiran_dan_disiplin', 'inisiatif_dan_kreatifitas', 'kerjasama', 'tanggung_jawab', 'sikap', 'kompetensi_keahlian']);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
