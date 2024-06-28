<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Captcha | Register</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/img/logo-small.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/fontawesome/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.css') }}">

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

                <img class="img-fluid logo-dark mb-2 logo-color" src="{{ url('/') }}/assets/img/logo.png" alt="Logo">
                <div class="loginbox">

                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>

                            <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form">
                                @csrf

                                <div class="form-group mb-2">
                                    <label class="form-control-label"><b class="text-dark">Username : <span class="text-danger">*</span></b></label>
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Enter Username">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2" >
                                    <label><b class="text-dark">User Type : <span class="text-danger">*</span></b></label>
                                    <select class="form-control @error('user_type') is-invalid @enderror select2" id="user_type" name="user_type">
                                        <option value="">Select User Type</option>
                                        <option value="1" {{ (old("user_type") == '1' ? "selected":"") }}>Super Admin</option>
                                        <option value="2" {{ (old("user_type") == '2' ? "selected":"") }}>Admin</option>
                                    </select>
                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

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

                                <div class="form-group mb-2">
                                    <label class="form-control-label"><b class="text-dark">Confirm Password : <span class="text-danger">*</span></b></label>
                                    <div class="pass-group">
                                        <input id="password_confirmation" type="password" class="form-control pass-input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation" placeholder="Enter Confirm Password">
                                        <span class="fas fa-eye toggle-password"></span>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <br>
                                <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Register</button>

                            </form>

                            <div class="mt-4 text-center">
                                <p class="mb-0">I don't have an account ?
                                    <a href="{{ route('login') }}" class="fw-medium text-primary"> Login </a>
                                </p>
                            </div>

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

    <!-- select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.js"></script>

    {{-- Adding Search Company Name --}}
    <script>
        var typed = "";
        $('#user_type').select2({
            language: {
                noResults: function(term) {
                    typed = $('.select2-search__field').val();
                }
            }

        });
        $('#user_type').on('select2:select', function(e) {
            typed = ""; // clear
        });
        $("#but").on("click", function() {
            if (typed) {
                // var value = prompt("Do you have a state abbriviation for "+typed+"?"); // change typed to value where necessary

                // Set the value, creating a new option if necessary
                if ($('#user_type').find("option[value='" + typed + "']").length) {
                    $('#user_type').val(typed).trigger('change');
                } else {
                    // Create a DOM Option and pre-select by default

                    var newOption = new Option(typed, typed, true, true);
                    // Append it to the select
                    $('#user_type').append(newOption).trigger('change');
                }
            }
        });
    </script>

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
