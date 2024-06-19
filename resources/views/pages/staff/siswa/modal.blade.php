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
                        <label for="nis" class="form-label">Nis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nis" name="nis">
                        <small class="invalid-feedback" id="errornis"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <small class="invalid-feedback" id="errornama"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                        <small class="invalid-feedback" id="errortempat_lahir"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        <small class="invalid-feedback" id="errortanggal_lahir"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="telepon" name="telepon">
                        <small class="invalid-feedback" id="errortelepon"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kelas_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas_id" id="kelas_id" class="form-control">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $row)
                                <option value="{{ $row->id }}">{{ $row->kode . ' - ' . $row->nama }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errorkelas_id"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="invalid-feedback" id="errorpassword"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="konfirmasi_password"
                            name="konfirmasi_password">
                        <small class="invalid-feedback" id="errorkonfirmasi_password"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="alamat" name="alamat"></textarea>
                        <small class="invalid-feedback" id="erroralamat"></small>
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
