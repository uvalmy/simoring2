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
                        <label for="jurusan_id" class="form-label">Jurusan <span class="text-danger">*</span></label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $row)
                                <option value="{{ $row->id }}">{{ $row->kode . ' - ' . $row->nama }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errorjurusan_id"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="elemen" class="form-label">Elemen <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="elemen" name="elemen"></textarea>
                        <small class="invalid-feedback" id="errorelemen"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="4" id="deskripsi" name="deskripsi"></textarea>
                        <small class="invalid-feedback" id="errordeskripsi"></small>
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
