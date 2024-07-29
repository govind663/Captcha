@extends('backend.layouts.master')

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
                    <h3 class="page-title">Manage Payment Request</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        @if($status == 1)
                        <li class="breadcrumb-item active">All Pending List</li>
                        @elseif($status == 2)
                        <li class="breadcrumb-item active">All Success List</li>
                        @elseif($status == 3)
                        <li class="breadcrumb-item active">All Cancel List</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-10">
                            @if($status == 1)
                            <h5 class="card-title">All Pending List</h5>
                            @elseif($status == 2)
                            <h5 class="card-title">All Success List</h5>
                            @elseif($status == 3)
                            <h5 class="card-title">All Cancel List</h5>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="data-table-export1 table table-nowrap table-responsive">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Transaction ID</th>
                                        <th>User Name</th>
                                        <th>Requested Amount</th>
                                        <th>Payment Date / Time</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Status</th>
                                        <th class="no-export">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($citizenPayment as $key=>$value )
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->transaction_id }}</td>
                                        <td>{{ $value->citizen?->name }}</td>
                                        <td>{{ $value->request_amount }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($value->transaction_date)) }} /
                                            {{ date('H:i A', strtotime($value->transaction_time)) }}
                                        </td>

                                        @if($value->payment_mode == 1)
                                        <td><span class="badge bg-warning">Cash</span></td>
                                        @elseif($value->payment_mode == 2)
                                        <td><span class="badge bg-info">Cheque</span></td>
                                        @elseif($value->payment_mode == 3)
                                        <td><span class="badge bg-primary">Online Transfer</span></td>
                                        @elseif($value->payment_mode == 4)
                                        <td><span class="badge bg-warning">Google Pay</span></td>
                                        @elseif($value->payment_mode == 5)
                                        <td><span class="badge bg-danger">Phone Pay</span></td>
                                        @endif


                                        @if($value->transaction_status == 1)
                                        <td><span class="badge bg-primary">Pending</span></td>
                                        @elseif($value->transaction_status == 2)
                                        <td><span class="badge bg-success">Paid</span></td>
                                        @elseif($value->transaction_status == 3)
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        @endif

                                        <td class="no-export ">
                                            <a href="" class="btn btn-warning btn-sm text-dark">
                                                <i class="far fa-eye me-2"></i>View
                                            </a>
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
