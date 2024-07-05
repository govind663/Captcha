@extends('frontend.layouts.master')

@section('title')
Payment Request | Add
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
                            <h5>Add Payment Request</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('payment-request.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group-customer customer-additional-form">
                                    <div class="row">
                                        <h5 class="card-title text-primary mb-2">Basic Details : -</h5>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label><b>Name : <span class="text-danger">*</span></b></label>
                                                <input type="hidden" readonly id="citizen_id" name="citizen_id" class="form-control" value="{{ Auth::user()->id }}">
                                                <input type="text" class="form-control" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label><b>Email Id : <span class="text-danger">*</span></b></label>
                                                <input type="email" readonly id="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label><b>Amount : <span class="text-danger">*</span></b></label>
                                                <input type="text" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" placeholder="Enter Amount">

                                                @error('amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h5 class="card-title text-primary mb-2">Bank Details : -</h5>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label><b>Bank Name : <span class="text-danger">*</span></b></label>
                                                <input type="text" id="bank_name" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}" placeholder="Enter Bank Name">

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
                                                <input type="text" id="branch_name" name="branch_name" class="form-control @error('branch_name') is-invalid @enderror" value="{{ old('branch_name') }}" placeholder="Enter Branch Name">

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
                                                <input type="text" id="account_holder_name" name="account_holder_name" class="form-control @error('account_holder_name') is-invalid @enderror" value="{{ old('account_holder_name') }}" placeholder="Enter Account Holder Name">

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
                                                <input type="text" id="account_number" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}" placeholder="Enter Account Number">

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
                                                <input type="text" id="ifsc_code" name="ifsc_code" class="form-control @error('ifsc_code') is-invalid @enderror" value="{{ old('ifsc_code') }}" placeholder="Enter IFSC Code">

                                                @error('ifsc_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3" >
                                                <label><b>Payment Mode : <span class="text-danger">*</span></b></label>
                                                <select class="@error('payment_mode') is-invalid @enderror select" id="payment_mode" name="payment_mode">
                                                    <option value="">Select Payment Mode</option>
                                                    <option value="1" {{ (old("payment_mode") == "1" ? "selected":"") }}>Cash</option>
                                                    <option value="2" {{ (old("payment_mode") == "2" ? "selected":"") }}>Cheque</option>
                                                    <option value="3" {{ (old("payment_mode") == "3" ? "selected":"") }}>Online Transfer</option>
                                                    <option value="4" {{ (old("payment_mode") == "4" ? "selected":"") }}>GooglePay</option>
                                                    <option value="5" {{ (old("payment_mode") == "5" ? "selected":"") }}>PhonePay</option>
                                                </select>
                                                @error('payment_mode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label><b>Payment Date : <span class="text-danger">*</span></b></label>
                                                <input type="date" id="transaction_date" name="transaction_date"  class="form-control @error('transaction_date') is-invalid @enderror" value="{{ old('transaction_date') }}" placeholder="Enter Payment Date">
                                                @error('transaction_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label><b>Payment Time : <span class="text-danger">*</span></b></label>
                                                <input type="time" id="transaction_time" name="transaction_time"  class="form-control @error('transaction_time') is-invalid @enderror" value="{{ old('transaction_time') }}" placeholder="Enter Payment Time">
                                                @error('transaction_time')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="add-customer-btns text-start">
                                    <a href="{{ route('payment-request.index') }}" class="btn btn-danger">Cancel</a>
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
<script>
    var typed = "";
    $('#payment_mode').select2({
        language: {
            noResults: function(term) {
                typed = $('.select2-search__field').val();
            }
        }

    });
    $('#payment_mode').on('select2:select', function(e) {
        typed = ""; // clear
    });
    $("#but").on("click", function() {
        if (typed) {
            // var value = prompt("Do you have a state abbriviation for "+typed+"?"); // change typed to value where necessary

            // Set the value, creating a new option if necessary
            if ($('#payment_mode').find("option[value='" + typed + "']").length) {
                $('#payment_mode').val(typed).trigger('change');
            } else {
                // Create a DOM Option and pre-select by default

                var newOption = new Option(typed, typed, true, true);
                // Append it to the select
                $('#payment_mode').append(newOption).trigger('change');
            }
        }
    });
</script>
@endpush
