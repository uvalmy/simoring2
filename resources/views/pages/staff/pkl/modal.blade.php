<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><span id="label-modal"></span> Data @yield('title')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveData" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <div class="form-group mb-3">
                        <label for="siswa_id" class="form-label">Siswa <span class="text-danger">*</span></label>
                        <select name="siswa_id" id="siswa_id" class="form-control">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswa as $row)
                                <option value="{{ $row->id }}">{{  $row->nama }} - {{ $row->kelas->nama }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errorsiswa_id"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_id" class="form-label">Guru Pembimbing <span class="text-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="">-- Pilih Guru Pembimbing --</option>
                            @foreach ($user as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="erroruser_id"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="dudi_id" class="form-label">Dudi <span class="text-danger">*</span></label>
                        <select name="dudi_id" id="dudi_id" class="form-control">
                            <option value="">-- Pilih Dudi --</option>
                            @foreach ($dudi as $row)
                                <option value="{{ $row->id }}">{{ $row->instansi }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errordudi_id"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                        <small class="invalid-feedback" id="errortanggal_mulai"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                        <small class="invalid-feedback" id="errortanggal_selesai"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="posisi" class="form-label">Posisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="posisi" name="posisi">
                        <small class="invalid-feedback" id="errorposisi"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pembimbing_dudi" class="form-label">Pembimbing Dudi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pembimbing_dudi" name="pembimbing_dudi">
                        <small class="invalid-feedback" id="errorpembimbing_dudi"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
