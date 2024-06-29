@extends('backend.layouts.master')

@section('title')
  Citizen | View
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
                        <h5>View Citizen</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group-customer customer-additional-form">
                            <div class="row">

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control " value="{{ $citizen->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control " value="{{ $citizen->email }}">
                                    </div>
                                </div>

                                @php
                                    $userType = '';
                                    
                                    if($citizen->user_type == '1'){
                                        $userType = 'Super Admin';
                                    } elseif($citizen->user_type == '2'){
                                        $userType = 'Admin';
                                    } elseif($citizen->user_type == '3'){
                                        $userType = 'Citizen';
                                    }
                                @endphp
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3" >
                                        <label><b class="text-dark">User Type : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control " value="{{ $userType }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="add-customer-btns text-start">
                            @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Cancel</a>
                            @elseif (Auth::user()->user_type == 3)
                            <a href="{{ route('citizen.dashboard') }}" class="btn btn-danger">Cancel</a>
                            @endif
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
