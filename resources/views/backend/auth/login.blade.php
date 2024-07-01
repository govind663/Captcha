<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Captcha | Admin - Login</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/img/captcha_fav_ico.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/fontawesome/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css">

    <!-- Toaster Message -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        .form-control {
            border: 1px solid #0e60ca !important;
        }
    </style>
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">

                <img class="img-fluid logo-dark mb-2 logo-color" src="{{ url('/') }}/assets/img/captcha_logo.png" alt="Logo" style="max-width: 250px !important">
                <div class="loginbox">

                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>

                            <form method="POST" action="{{ route('admin.login.store') }}" enctype="multipart/form">
                                @csrf

                                <div class="form-group mb-2">
                                    <label class="form-control-label"><b class="text-dark">Email Id : <span class="text-danger">*</span></b></label>
                                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Enter Email Id">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-control-label"><b class="text-dark">Password : <span class="text-danger">*</span></b></label>
                                    <div class="pass-group">
                                        <input id="password" type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Enter Password">
                                        <span class="fas fa-eye toggle-password"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="remember_token" value="true">
                                <br>
                                <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>

                            </form>

                            {{-- <div class="mt-4 text-center">
                                <p class="mb-0">Already have an account ?
                                    <a href="{{ route('admin.register') }}" class="fw-medium text-primary"> Register </a>
                                </p>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ url('/') }}/assets/js/jquery-3.7.1.min.js"></script>

    <!-- Feather Icon JS -->
    <script src="{{ url('/') }}/assets/js/feather.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ url('/') }}/assets/js/script.js"></script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
