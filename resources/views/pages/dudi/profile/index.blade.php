@extends('layouts.app')

@section('title', 'Profile')

@push('style')
@endpush

@section('main')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Data @yield('title')</h4>
                </div>
                <div class="card-body">
                    <form id="updateData">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ auth('dudi')->user()->nama }}">
                            <small class="invalid-feedback" id="errornama"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="instansi" class="form-label">Instansi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="instansi" name="instansi"
                                value="{{ auth('dudi')->user()->instansi }}">
                            <small class="invalid-feedback" id="errorinstansi"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="telepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                value="{{ auth('dudi')->user()->telepon }}">
                            <small class="invalid-feedback" id="errortelepon"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="4" id="alamat" name="alamat">{{ auth('dudi')->user()->alamat }}</textarea>
                            <small class="invalid-feedback" id="erroralamat"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Ubah Password</h4>
                </div>
                <div class="card-body">
                    <form id="updatePassword">
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="password_lama" class="form-label">Password Lama <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_lama" name="password_lama">
                            <small class="invalid-feedback" id="errorpassword_lama"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="invalid-feedback" id="errorpassword"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                            <small class="invalid-feedback" id="errorkonfirmasi_password"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#updateData").submit(function(e) {
                setButtonLoadingState("#updateData .btn.btn-primary", true);
                e.preventDefault();
                const url = `{{ route('dudi.profile') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#updateData .btn.btn-primary", false);
                    handleSuccess(response, null, null, "no");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updateData .btn.btn-primary", false);
                    handleValidationErrors(error, "updateData", ["nama", "telepon",
                        "alamat",
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $("#updatePassword").submit(function(e) {
                setButtonLoadingState("#updatePassword .btn.btn-primary", true);
                e.preventDefault();
                const url = `{{ route('dudi.updatePassword') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#updatePassword .btn.btn-primary", false);
                    $("#updatePassword")[0].reset();
                    handleSuccess(response, null, null, "no");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updatePassword .btn.btn-primary", false);
                    handleValidationErrors(error, "updatePassword", ["password_lama", "password",
                        "konfirmasi_password"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
