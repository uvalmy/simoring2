@extends('layouts.app')

@section('title', 'Profile')

@push('style')
@endpush

@section('main')
<div class="container-fluid">
    <section class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Data @yield('title')</h4>
                </div>
                <div class="card-body">
                    <form id="updateData">
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label">Nik <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ auth()->user()->nik }}">
                            <small class="invalid-feedback" id="errornik"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ auth()->user()->nama }}">
                            <small class="invalid-feedback" id="errornama"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->email }}">
                            <small class="invalid-feedback" id="erroremail"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="telepon" class="form-label">Telepon <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                value="{{ auth()->user()->telepon }}">
                            <small class="invalid-feedback" id="errortelepon"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#updateData").submit(function(e) {
                setButtonLoadingState("#updateData .btn.btn-primary", true);
                e.preventDefault();
                const url = `{{ route('staff.profile') }}`;
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#updateData .btn.btn-primary", false);
                    handleSuccess(response, null, null, "no");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#updateData .btn.btn-primary", false);
                    handleValidationErrors(error, "updateData", ["nama", "email",
                        "nik", "telepon"
                    ]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush
