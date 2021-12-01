@extends('layouts.backend.app')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Date range picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}">
@endpush

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Purchases</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Transaction</li>
                        <li class="breadcrumb-item active">Purchases</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <!--<h3 class="card-title">Vendors</h3>-->
                    <a href="{{ route('purchase-order.create') }}" class="btn btn-outline-info btn-sm float-right"><i class="far fa-plus-square"></i> &nbsp;Add</a>
                </div>
                <!-- /.card-header -->
                <div style="padding-left: 30px;padding-right: 30px;">
                    <form class="form-horizontal" method="GET" role="form" autocomplete="off">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="status" class="col-sm-4 col-form-label">Filter</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="status" name="status">
                                        <option value="0" {{$status == "0" ? 'selected' : ''}}>All</option>
                                        <option value="order" {{$status == "order" ? 'selected' : ''}}>Order</option>
                                        <option value="receive" {{$status == "receive" ? 'selected' : ''}}>Received</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="startDate" class="col-md-6" name="" id="">Start Date</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="startDate" id="startDate" value="{{$startDate}}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="col-md-6" name="" id="">End Date</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="endDate" id="endDate" value="{{$endDate}}" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="show-all" name="mode" value="all" {{$mode == 'all' ? 'checked' : ''}}>
                                            <label for="show-all">Show All</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default float-left">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table id="transactions" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

@endsection

@push('js')
    <!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $.ajaxSetup({
                header:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#transactions").DataTable({
                responsive: true,
                autoWidth: false,
                pagingType: 'full_numbers',
                stateSave:false,
                scrollY:true,
                scrollX:true,
                ajax:"{!! url('purchase-order/datatable?status='.$status.'&startDate='.$startDate.'&endDate='.$endDate.'&mode='.$mode) !!}",
                order:[0,'desc'],
                columns:[
                    {data:'num_invoice', name:'num_invoice'},
                    {data:'date', name:'date'},
                    {data:'name', name:'name'},
                    {data:'total', name:'total'},
                    {
                        data: 'status',
                        render: function (data) {
                            if (data == 'order') {
                                return '<span class="badge badge-success">Order</span>';
                            }
                            if (data == 'receive') {
                                return '<span class="badge badge-warning">Received</span>';
                            }

                        },

                    },
                    {data:'action', name:'action', searchable: false, sortable: false}
                ]
            });

        });

    </script>
    <script>
        function deleteData(dt){
            if (confirm("Do you want to delete this data?")){
                $.ajax({
                    type:'DELETE',
                    url:$(dt).data("url"),
                    data:{
                        "_token":"{{ csrf_token() }}"
                    },
                    success:function(response) {
                        if (response.status){
                            location.reload();
                        }
                    },
                    error:function(response) {
                        console.log(response);
                    }
                });
            }
            return false;
        }
    </script>
    <script>
        function received(dt){
            if (confirm("Confirm Order Receipt?")){
                $.ajax({
                    type:'POST',
                    url:$(dt).data("url"),
                    data:{
                        "_token":"{{ csrf_token() }}",
                    },
                    success:function(response) {
                        if (response.status){
                            location.reload();
                        }
                    },
                    error:function(response) {
                        console.log(response);
                    }
                });
            }
            return false;
        }
    </script>
    <script>
        $(function(){
            $('#startDate').datepicker({
                autoclose: true,
                dateFormat: 'dd-mm-yy',
            })
            $('#endDate').datepicker({
                autoclose: true,
                dateFormat: 'dd-mm-yy',
            })
        });
    </script>
@endpush
