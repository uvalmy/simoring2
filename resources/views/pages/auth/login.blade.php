

@extends('layouts.auth')

@section('title', 'Login')

@push('style')

@endpush

@section('main')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-lg-6 col-md-8">
            <div class="authincation-content">
                <div class="auth-form">
                    <h4 class="text-center mb-4">@yield('title')</h4>
                    <form id="login" autocomplete="off">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control" name="email">
                            <small class="invalid-feedback" id="erroremail"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input id="password" type="password" class="form-control" name="password">
                            <small class="invalid-feedback" id="errorpassword"></small>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#login").submit(function(e) {
                setButtonLoadingState("#login .btn.btn-primary", true, "Login");
                e.preventDefault();
                const url = "{{ route('login') }}";
                const data = new FormData(this);

                const successCallback = function(response) {
                    setButtonLoadingState("#login .btn.btn-primary", false, "Login");
                    handleSuccess(response, null, null, "/staff");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#login .btn.btn-primary", false, "Login");
                    handleValidationErrors(error, "login", ["email", "password"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush

