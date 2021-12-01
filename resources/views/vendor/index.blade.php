@extends('layouts.backend.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Vendors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">Vendors</li>
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
                    <a href="{{ route('vendor.create') }}" class="btn btn-outline-info btn-sm float-right"><i class="far fa-plus-square"></i> &nbsp;Add</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="vendors" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Person</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Person</th>
                            <th>Phone Number</th>
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
            $("#vendors").DataTable({
                responsive: true,
                autoWidth: true,
                pagingType: 'full_numbers',
                stateSave:false,
                scrollY:true,
                scrollX:true,
                ajax:"{{ url('vendor/datatable') }}",
                order:[0,'desc'],
                columns:[
                    {data:'name', name:'name'},
                    {data:'address', name:'address'},
                    {data:'contact_person', name:'contact_person'},
                    {data:'phone_number', name:'phone_number'},
                    {
                        data: 'status',
                        render: function (data) {
                            if (data == '1') {
                                return '<span class="badge badge-success">Active</span>';
                            }
                            if (data == '0') {
                                return '<span class="badge badge-warning">Inactive</span>';
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
@endpush
