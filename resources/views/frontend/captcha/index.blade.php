@extends('frontend.layouts.master')

@section('title')
Manage Captcha | List
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
                    <h3 class="page-title">Manage Captcha </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Captcha List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="row card-body">
                        <div class="col-10">
                            <h5 class="card-title">All Captcha List</h5>
                        </div>
                        <div class="col-2 float-right">
                            <a href="{{ route('captcha.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Captcha
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="data-table-export1 table">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>User Name</th>
                                        <th>Captcha Type</th>
                                        <th>Right Captcha</th>
                                        <th>Wrong Captcha</th>
                                        <th>Total Captcha</th>
                                        <th>Total Earning</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($captcha as $key=>$value )
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->citizen?->name }}</td>
                                        @if($value->captcha_type_id == 1)
                                        <td><span class="badge bg-success">Easy</span></td>
                                        @elseif($value->captcha_type_id == 2)
                                        <td><span class="badge bg-warning">Medium</span></td>
                                        @elseif($value->captcha_type_id == 3)
                                        <td><span class="badge bg-danger">Hard</span></td>
                                        @endif
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
               title: 'All Captcha Type List',
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
