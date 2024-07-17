<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><span id="label-modal"></span> Data
                    @yield('title')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveData" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <div class="form-group mb-3">
                        <label for="cp_id" class="form-label">Cp <span class="text-danger">*</span></label>
                        <select name="cp_id[]" multiple id="cp_id" class="form-control">
                            @foreach ($cp as $row)
                                <option value="{{ $row->id }}">{{ $row->elemen }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errorcp_id"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal" class="form-label">Tanggal<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                        <small class="invalid-feedback" id="errortanggal"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nilai_karakter" class="form-label">Nilai Karakter <span
                                class="text-danger">*</span></label>
                        <select name="nilai_karakter[]" multiple id="nilai_karakter" class="form-control">
                            @foreach (nilaiKarakter() as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                            @endforeach
                        </select>
                        <small class="invalid-feedback" id="errornilai_karakter"></small>
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
