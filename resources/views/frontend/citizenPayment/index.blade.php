@extends('frontend.layouts.master')

@section('title')
Payment Request | List
@endsection

@push('styles')
<style>
    .btn-secondary {
        color: #fff;
        background-color: #387dff !important;
        border-color: #387dff !important;
    }
    .pagination li.active a.page-link {
        background: #387dff !important;
        border-color: #387dff !important;
        border-radius: 5px;
    }
    table.dataTable thead > tr > th.dt-orderable-asc, table.dataTable thead > tr > th.dt-orderable-desc, table.dataTable thead > tr > th.dt-ordering-asc, table.dataTable thead > tr > th.dt-ordering-desc, table.dataTable thead > tr > td.dt-orderable-asc, table.dataTable thead > tr > td.dt-orderable-desc, table.dataTable thead > tr > td.dt-ordering-asc, table.dataTable thead > tr > td.dt-ordering-desc {
        position: relative;
        padding-right: 0px !important;
    }
    table.dataTable th.dt-type-numeric, table.dataTable th.dt-type-date, table.dataTable td.dt-type-numeric, table.dataTable td.dt-type-date {
        text-align: left !important;
    }
    .form-control {
        border: 1px solid #387dff !important;
    }
    .d-flex1 {
        display: flex !important;
        flex-wrap: nowrap;
        flex-direction: row;
        align-content: center;
        justify-content: space-between;
        align-items: stretch;
    }
</style>
@endpush

@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Payment Request</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Payment Request List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body d-flex1">
                        <div class="justify-content-start">
                            <h5 class="card-title">All Payment Request List</h5>
                        </div>
                        <div class="justify-content-end">
                            <a href="{{ route('payment-request.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus me-2" aria-hidden="true"></i> Payment Request
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="data-table-export1 table">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Payment ID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Status</th>
                                        <th>Payment Date / Time</th>
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>
                                    @foreach ($citizenPayment as $key=>$value )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->transaction_id }}</td>
                                        <td>{{ $value->citizen?->name }}</td>
                                        <td></td>

                                        <td>
                                            @if ($value->payment_mode == 1)
                                            <span class="badge bg-success">Cash</span>
                                            @elseif($value->payment_mode == 2)
                                            <span class="badge bg-info">Cheque</span>
                                            @elseif($value->payment_mode == 3)
                                            <span class="badge bg-primary">Online Transfer</span>
                                            @elseif($value->payment_mode == 4)
                                            <span class="badge bg-warning">Google Pay</span>
                                            @elseif($value->payment_mode == 5)
                                            <span class="badge bg-danger">Phone Pay</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($value->transaction_status == 1)
                                            <span class="badge bg-primary">Pending</span>
                                            @elseif($value->transaction_status == 2)
                                            <span class="badge bg-success">Paid</span>
                                            @elseif($value->transaction_status == 3)
                                            <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ date( 'd-m-Y', strtotime($value->transaction_date) ) }}
                                            {{ date( 'H:i', strtotime($value->transaction_time) ) }}
                                        </td>

                                        <td class="no-export d-flex">
                                            <a href="{{ route('payment-request.edit', $value->id) }}" class="btn btn-warning btn-sm text-dark">
                                                <i class="far fa-edit me-2"></i>Edit
                                            </a>
                                            &nbsp;
                                            <form action="{{ route('payment-request.destroy', $value->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">
                                                    <i class="far fa-trash-alt me-2"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->
@endsection

@push('scripts')
<script>
    $('.data-table-export1').DataTable({
        scrollCollapse: true,
        autoWidth: true,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search",
            // paginate: {
            //     next: '<i class="ion-chevron-right"></i>',
            //     previous: '<i class="ion-chevron-left"></i>'
            // }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'csv',
                text: 'Excel',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':not(.no-export)',
                },
               header: true,
               title: 'Report',
               orientation: 'landscape',
               pageSize: 'A4',
               customize: function(doc) {
                  doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10
                  doc.defaultStyle.fontFamily = "sans-serif";
                // doc.defaultStyle.font = 'Arial';

               }
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-default',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
        ]
    });
</script>
@endpush
