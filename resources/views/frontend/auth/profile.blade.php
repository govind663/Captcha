@extends('frontend.layouts.master')

@section('title')
  Profile | View
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
                        <h5>View Profile</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="padding-left: 4% !important; padding-right: 4% !important;">
                        <form method="POST" action="{{ route('citizen.profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <h5 class="card-title text-primary mb-2">Basic Details : -</h5>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Name : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Email Id : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Mobiile Number : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->mobile_no }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3" >
                                        <label><b class="text-dark">Admin Name : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->user?->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3" >
                                        <label><b>Captcha Type : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->captchaType?->type_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3" >
                                        <label><b class="text-dark"> Package Name : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->package?->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3" >
                                        <label><b class="text-dark"> Package Amount : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $citizen->package_amt }}">
                                    </div>
                                </div>

                                @php
                                    $paymentType = '';
                                    switch ($citizen->payment_type) {
                                        case 1:
                                            $paymentType = 'Cash';
                                            break;
                                        case 2:
                                            $paymentType = 'Cheque';
                                            break;
                                        case 3:
                                            $paymentType = 'Online Transfer';
                                            break;
                                        case 4:
                                            $paymentType = 'GooglePay';
                                            break;
                                        case 5:
                                            $paymentType = 'Paytm';
                                            break;
                                        case 6:
                                            $paymentType = 'PhonePe';
                                            break;
                                    }
                                @endphp
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3" >
                                        <label><b>Payment Type : </b></label>
                                        <input type="text" disabled class="form-control" value="{{ $paymentType }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="card-title text-primary mb-2">Bank Details : - </h5>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Bank Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="bank_name" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ $citizen->bank_name }}" placeholder="Enter Bank Name">

                                        @error('bank_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Branch Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="branch_name" name="branch_name" class="form-control @error('branch_name') is-invalid @enderror" value="{{ $citizen->branch_name }}" placeholder="Enter Branch Name">

                                        @error('branch_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Account Holder Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="account_holder_name" name="account_holder_name" class="form-control @error('account_holder_name') is-invalid @enderror" value="{{ $citizen->account_holder_name }}" placeholder="Enter Account Holder Name">

                                        @error('account_holder_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Account Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="account_number" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ $citizen->account_number }}" placeholder="Enter Account Number">

                                        @error('account_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>IFSC Code : <span class="text-danger">*</span></b></label>
                                        <input type="text" id="ifsc_code" name="ifsc_code" class="form-control @error('ifsc_code') is-invalid @enderror" value="{{ $citizen->ifsc_code }}" placeholder="Enter IFSC Code">

                                        @error('ifsc_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="add-customer-btns text-start mt-4">
                                <a href="{{ route('citizen.dashboard') }}" class="btn btn-danger">Cancel</a>
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
@endpush
