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
                            <form method="POST" action="{{ route('captcha.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group-customer customer-additional-form">
                                    <div class="row">
                                        @if(Auth::user()->user_type == '3' && Auth::user()->package_type_id == 1)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <img src="{{ captcha_src('default') }}" id="easy-captcha" style="height: 40px !important; width:400px !important">
                                                {{-- <button type="button" class="btn btn-primary" onclick="refreshCaptcha('easy-captcha', 'default')"><i class="fa fa-refresh"></i></button> --}}
                                                <input type="text" class="form-control" name="captcha" id="captcha" value="{{ old('captcha') }}" >
                                            </div>
                                        </div>
                                        @elseif (Auth::user()->user_type == '3' && Auth::user()->package_type_id == 2)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <img src="{{ captcha_src('medium') }}" id="medium-captcha" style="height: 40px !important; width:400px !important">
                                                {{-- <button type="button" class="btn btn-primary" onclick="refreshCaptcha('medium-captcha', 'medium')"><i class="fa fa-refresh"></i></button> --}}
                                                <input type="text" class="form-control" name="captcha" id="captcha" value="{{ old('captcha') }}" >
                                            </div>
                                        </div>
                                        @elseif (Auth::user()->user_type == '3' && Auth::user()->package_type_id == 3)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <img src="{{ captcha_src('hard') }}" id="hard-captcha" style="height: 40px !important; width:400px !important">
                                                {{-- <button type="button" class="btn btn-primary" onclick="refreshCaptcha('hard-captcha', 'hard')"><i class="fa fa-refresh"></i></button> --}}
                                                <input type="text" class="form-control" name="captcha" id="captcha" value="{{ old('captcha') }}" >
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="add-customer-btns text-start">
                                    <a href="{{ route('captcha.index') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- <script>
    function refreshCaptcha(elementId, type) {
        document.getElementById(elementId).src = "{{ url('captcha/refresh') }}?type=" + type;
        return false;
    }
</script> --}}
@endpush
