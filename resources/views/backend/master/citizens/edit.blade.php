@extends('backend.layouts.master')

@section('title')
  User | Update
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
                        <h5>Edit User</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('citizen.update', $citizen->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="text" id="id" name="id" hidden  value="{{ $citizen->id }}" >

                            <div class="form-group-customer customer-additional-form">
                                <div class="row">

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label><b>Name : <span class="text-danger">*</span></b></label>
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $citizen->name }}" placeholder="Enter Name">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label><b>Email Id : <span class="text-danger">*</span></b></label>
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $citizen->email }}" placeholder="Enter Email Id">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label><b>Mobiile Number : <span class="text-danger">*</span></b></label>
                                            <input type="text" maxlength="10" id="mobile_no" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ $citizen->mobile_no }}" placeholder="Enter Mobiile Number">

                                            @error('mobile_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group mb-3" >
                                            <label><b class="text-dark">Select Admin : <span class="text-danger">*</span></b></label>
                                            <select class="form-control @error('user_id') is-invalid @enderror select2" id="user_id" name="user_id">
                                                <option value="">Select Admin</option>
                                                @foreach($admins as $admin)
                                                <option value="{{$admin->id}}" {{ ($citizen->user_id == $admin->id ? "selected":"") }}>{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group mb-3" >
                                            <label><b class="text-dark">Select Package : <span class="text-danger">*</span></b></label>
                                            <select class="form-control @error('package_id') is-invalid @enderror select2" id="package_id" name="package_id">
                                                <option value="">Select Package</option>
                                                @foreach($packages as $package)
                                                <option value="{{$package->id}}" {{ ($citizen->package_id == $package->id ? "selected":"") }}>{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('package_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3">
                                            <label><b>Package Amount : <span class="text-danger">*</span></b></label>
                                            <input type="text" readonly id="package_amt" name="package_amt" class="form-control @error('package_amt') is-invalid @enderror" value="{{ $citizen->package_amt }}" placeholder="Enter Package Amount">
                                            <input type="text" hidden id="captcha_type_id" name="captcha_type_id" class="form-control" value="{{ $citizen->captcha_type_id }}">
                                            @error('package_amt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="input-block mb-3" >
                                            <label><b>Payment Type : <span class="text-danger">*</span></b></label>
                                            <select class="@error('payment_type') is-invalid @enderror select" id="payment_type" name="payment_type">
                                                <option value="">Select Payment Type</option>
                                                <option value="1" {{ ($citizen->payment_type == "1" ? "selected":"") }}>Cash</option>
                                                <option value="2" {{ ($citizen->payment_type == "2" ? "selected":"") }}>Cheque</option>
                                                <option value="3" {{ ($citizen->payment_type == "3" ? "selected":"") }}>Online Transfer</option>
                                                <option value="4" {{ ($citizen->payment_type == "4" ? "selected":"") }}>GooglePay</option>
                                                <option value="5" {{ ($citizen->payment_type == "5" ? "selected":"") }}>PhonePay</option>
                                            </select>
                                            @error('payment_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="add-customer-btns text-start">
                                <a href="{{ route('citizen.index') }}" class="btn btn-danger">Cancel</a>
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
    var typed = "";
    $('#user_id').select2({
        language: {
            noResults: function(term) {
                typed = $('.select2-search__field').val();
            }
        }

    });
    $('#user_id').on('select2:select', function(e) {
        typed = ""; // clear
    });
    $("#but").on("click", function() {
        if (typed) {
            // var value = prompt("Do you have a state abbriviation for "+typed+"?"); // change typed to value where necessary

            // Set the value, creating a new option if necessary
            if ($('#user_id').find("option[value='" + typed + "']").length) {
                $('#user_id').val(typed).trigger('change');
            } else {
                // Create a DOM Option and pre-select by default

                var newOption = new Option(typed, typed, true, true);
                // Append it to the select
                $('#user_id').append(newOption).trigger('change');
            }
        }
    });
</script>

<script>
    var typed = "";
    $('#package_id').select2({
        language: {
            noResults: function(term) {
                typed = $('.select2-search__field').val();
            }
        }

    });
    $('#package_id').on('select2:select', function(e) {
        typed = ""; // clear
    });
    $("#but").on("click", function() {
        if (typed) {
            // var value = prompt("Do you have a state abbriviation for "+typed+"?"); // change typed to value where necessary

            // Set the value, creating a new option if necessary
            if ($('#package_id').find("option[value='" + typed + "']").length) {
                $('#package_id').val(typed).trigger('change');
            } else {
                // Create a DOM Option and pre-select by default

                var newOption = new Option(typed, typed, true, true);
                // Append it to the select
                $('#package_id').append(newOption).trigger('change');
            }
        }
    });
</script>

<script>
    var typed = "";
    $('#payment_type').select2({
        language: {
            noResults: function(term) {
                typed = $('.select2-search__field').val();
            }
        }

    });
    $('#payment_type').on('select2:select', function(e) {
        typed = ""; // clear
    });
    $("#but").on("click", function() {
        if (typed) {
            // var value = prompt("Do you have a state abbriviation for "+typed+"?"); // change typed to value where necessary

            // Set the value, creating a new option if necessary
            if ($('#payment_type').find("option[value='" + typed + "']").length) {
                $('#payment_type').val(typed).trigger('change');
            } else {
                // Create a DOM Option and pre-select by default

                var newOption = new Option(typed, typed, true, true);
                // Append it to the select
                $('#payment_type').append(newOption).trigger('change');
            }
        }
    });
</script>

{{-- Fetch Package Amount based on Package Id --}}
<script>
    $(document).ready(function(){

        $(document).on('change','#package_id', function() {
            let package_id = $(this).val();
            $('#package_amt').show();
            $.ajax({
                method: 'post',
                url: "{{ route('package_amt') }}",
                data: {
                    packageId: package_id,
                    _token : '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(data) {
                    $('#package_amt').val(data.package_amount);
                    $('#captcha_type_id').val(data.captcha_type);
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            })
        });
    });
</script>
@endpush
