@extends('frontend.layouts.master')

@section('title')
Captcha  | Add
@endsection

@push('styles')
<style>
    .form-control {
        border: 1px solid #387dff !important;
    }
</style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="card mb-0">
                <div class="card-body">

                    <div class="page-header">
                        <div class="content-page-header">
                            <h5>Add Captcha </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group-customer customer-additional-form">
                                <div class="row">
                                    @if(Auth::user()->user_type == '3' && Auth::user()->captcha_type_id == 1)
                                    <form method="POST" action="{{ route('captcha.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <div class="d-flex">
                                                    <img src="{{ captcha_src('default') }}" id="easy-captcha" style="height: 48px !important; width:362px !important; max-width: 90% !important;">&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary" onclick="refreshCaptcha('easy-captcha', 'default')"><i class="fa fa-refresh"></i></button>
                                                </div>
                                                <br>

                                                <input type="text" hidden class="form-control" id="captcha_type_id" name="captcha_type_id" value="{{ Auth::user()->captcha_type_id }}" >
                                                <input type="text" hidden class="form-control" id="captcha_length" name="captcha_length" value="7" >
                                                <input type="text" hidden class="form-control" id="package_id" name="package_id" value="{{ Auth::user()->package_id }}" >
                                                <input type="text" hidden class="form-control" id="package_amt" name="package_amt" value="{{ Auth::user()->package_amt }}" >
                                                <input type="text" class="form-control  @error('captcha_code') is-invalid @enderror" name="captcha_code" id="captcha_code" value="{{ old('captcha_code') }}" >
                                                @error('captcha_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-start">
                                            <a href="{{ route('captcha.index') }}" class="btn btn-danger">Cancel</a>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                    @elseif (Auth::user()->user_type == '3' && Auth::user()->captcha_type_id == 2)
                                    <form method="POST" action="{{ route('captcha.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <div class="d-flex">
                                                    <img src="{{ captcha_src('medium') }}" id="medium-captcha" style="height: 48px !important; width:362px !important; max-width: 90% !important;">&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary" onclick="refreshCaptcha('medium-captcha', 'medium')"><i class="fa fa-refresh"></i></button>
                                                </div>
                                                <br>

                                                <input type="text" hidden class="form-control" id="captcha_type_id" name="captcha_type_id" value="{{ Auth::user()->captcha_type_id }}" >
                                                <input type="text" hidden class="form-control" id="captcha_length" name="captcha_length" value="8" >
                                                <input type="text" hidden class="form-control" id="package_id" name="package_id" value="{{ Auth::user()->package_id }}" >
                                                <input type="text" hidden class="form-control" id="package_amt" name="package_amt" value="{{ Auth::user()->package_amt }}" >
                                                <input type="text" class="form-control @error('captcha_code') is-invalid @enderror" name="captcha_code" id="captcha_code" value="{{ old('captcha_code') }}" >
                                                @error('captcha_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-start">
                                            <a href="{{ route('captcha.index') }}" class="btn btn-danger">Cancel</a>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                    @elseif (Auth::user()->user_type == '3' && Auth::user()->captcha_type_id == 3)
                                    <form method="POST" action="{{ route('captcha.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <div class="d-flex">
                                                    <img src="{{ captcha_src('hard') }}" id="hard-captcha" style="height: 48px !important; width:362px !important; max-width: 90% !important;">&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary" onclick="refreshCaptcha('hard-captcha', 'hard')"><i class="fa fa-refresh"></i></button>
                                                </div>
                                                <br>
                                                <input type="text" hidden class="form-control" id="captcha_type_id" name="captcha_type_id" value="{{ Auth::user()->captcha_type_id }}" >
                                                <input type="text" hidden class="form-control" id="captcha_length" name="captcha_length" value="8" >
                                                <input type="text" hidden class="form-control" id="package_id" name="package_id" value="{{ Auth::user()->package_id }}" >
                                                <input type="text" hidden class="form-control" id="package_amt" name="package_amt" value="{{ Auth::user()->package_amt }}" >
                                                <input type="text" class="form-control @error('captcha_code') is-invalid @enderror" name="captcha_code" id="captcha_code" value="{{ old('captcha_code') }}" >
                                                @error('captcha_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="add-customer-btns text-start">
                                            <a href="{{ route('captcha.index') }}" class="btn btn-danger">Cancel</a>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function refreshCaptcha(elementId, type) {
        fetch(`/captcha/${type}`)
            .then(response => response.blob())
            .then(blob => {
                const url = URL.createObjectURL(blob);
                document.getElementById(elementId).src = url;
                document.getElementById(`captcha_length`).value = response.headers.get('captcha-length');
                document.getElementById(`package_id`).value = response.headers.get('package-id');
                document.getElementById(`package_amt`).value = response.headers.get('package-amt');
                document.getElementById(`captcha_type_id`).value = response.headers.get('captcha-type-id');
                document.getElementById(`captcha_code`).value = '';
            })
            .catch(error => console.error('Error refreshing captcha:', error));
    }
</script>
@endpush
