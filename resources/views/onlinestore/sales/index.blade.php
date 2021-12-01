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
                    <h1 class="m-0 text-dark">Online Sales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Online Store</li>
                        <li class="breadcrumb-item active">Sales</li>
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
                    Sales
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="sales" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Customer email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total ($)</th>
                            <th>View</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Customer email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total ($)</th>
                            <th>View</th>
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
            $("#sales").DataTable({
                responsive: true,
                autoWidth: false,
                pagingType: 'full_numbers',
                stateSave:false,
                scrollY:true,
                scrollX:true,
                ajax:"{{ url('onlinetransactions/datatable') }}",
                order:[0,'desc'],
                columns:[
                    {data:'invoiceNumber', name:'invoiceNumber'},
                    {data: 'email', name:'email'},
                    {data: 'date', name:'date'},
                    {data: 'status',
                        render: function (data) {
                            if (data == '0') {
                                return '<span class="badge badge-warning">Pending</span>';
                            }
                            if (data == '1') {
                                return '<span class="badge badge-success">Completed</span>';
                            }

                        },

                    },

                    {data:'total', name:'total'},

                    {data:'action', name:'action', searchable: false, sortable: false}
                ]
            });

        });

    </script>
    <script>
        function deleteData(dt){
            if (confirm("Do you want to Complete this Order?")){
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
@endpush


