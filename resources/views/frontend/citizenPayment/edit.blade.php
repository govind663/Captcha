@extends('frontend.layouts.master')

@section('title')
  Payment Request | Update
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
                        <h5>Edit Payment Request</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('payment-request.update', $citizenPayment->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="text" id="id" name="id" hidden  value="{{ $citizenPayment->id }}" >

                            <div class="row">
                                <h5 class="card-title text-primary mb-2">Basic Details : -</h5>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Name : <span class="text-danger">*</span></b></label>
                                        <input type="hidden" id="citizen_id" name="citizen_id" class="form-control" value="{{ Auth::user()->id }}">
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Email Id : <span class="text-danger">*</span></b></label>
                                        <input type="email" disabled id="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Per Captcha Amount : <span class="text-danger">*</span></b></label>
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->package_amt }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Request Amount : <span class="text-danger">*</span></b></label>
                                        <input type="text"  id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ $citizenPayment->amount }}" placeholder="Enter request Amount">

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
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->bank_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Branch Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->branch_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Account Holder Name : <span class="text-danger">*</span></b></label>
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->account_holder_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Account Number : <span class="text-danger">*</span></b></label>
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->account_number }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>IFSC Code : <span class="text-danger">*</span></b></label>
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->ifsc_code }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3" >
                                        <label><b>Payment Mode : <span class="text-danger">*</span></b></label>
                                        <select class="@error('payment_mode') is-invalid @enderror select" id="payment_mode" name="payment_mode">
                                            <option value="">Select Payment Mode</option>
                                            <option value="1" {{ ($citizenPayment->payment_mode == "1" ? "selected":"") }}>Cash</option>
                                            <option value="2" {{ ($citizenPayment->payment_mode == "2" ? "selected":"") }}>Cheque</option>
                                            <option value="3" {{ ($citizenPayment->payment_mode == "3" ? "selected":"") }}>Online Transfer</option>
                                            <option value="4" {{ ($citizenPayment->payment_mode == "4" ? "selected":"") }}>GooglePay</option>
                                            <option value="5" {{ ($citizenPayment->payment_mode == "5" ? "selected":"") }}>PhonePay</option>
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
                                        <div class="cal-icon cal-icon-info">
                                            <input type="text" id="transaction_date" name="transaction_date"  class="form-control datetimepicker @error('transaction_date') is-invalid @enderror" value="{{ date( 'd-m-Y', strtotime($citizenPayment->transaction_date) ) }}" placeholder="Enter Payment Date">
                                            @error('transaction_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Payment Time : <span class="text-danger">*</span></b></label>
                                        <input type="time" id="transaction_time" name="transaction_time"  class="form-control @error('transaction_time') is-invalid @enderror" value="{{ date( 'H:i', strtotime($citizenPayment->transaction_time) ) }}" placeholder="Enter Payment Time">
                                        @error('transaction_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-block mb-3">
                                        <label><b>Notes : <span class="text-danger">*</span></b></label>
                                        <textarea type="text" id="notes" name="notes"  class="form-control @error('notes') is-invalid @enderror" value="{{ $citizenPayment->notes }}" placeholder="Enter Notes">{{ $citizenPayment->notes }}</textarea>
                                        @error('notes')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="add-customer-btns text-start">
                                <a href="{{ route('payment-request.index') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Update</button>
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
