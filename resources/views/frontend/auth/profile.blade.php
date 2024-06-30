@extends('frontend.layouts.master')

@section('title')
  Citizen - Profile | View
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
                        <h5>View Citizen - Profile</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group-customer customer-additional-form">
                            <div class="row">

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control" value="{{ $citizen->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control" value="{{ $citizen->email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Mobiile Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control" value="{{ $citizen->mobile_no }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3" >
                                        <label><b class="text-dark">Select Admin : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control" value="{{ $citizen->user?->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group mb-3" >
                                        <label><b class="text-dark">Select Package : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control" value="{{ $citizen->package?->name }}">
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
                                        <label><b>Payment Type : <span class="text-danger">*</span></b></label>
                                        <input type="text" readonly class="form-control" value="{{ $paymentType }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="add-customer-btns text-start">
                            <a href="{{ route('citizen.dashboard') }}" class="btn btn-danger">Cancel</a>
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
