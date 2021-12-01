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
                    <h1 class="m-0 text-dark">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">Products</li>
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
                    <a href="{{ route('product.create') }}" class="btn btn-outline-info btn-sm float-right"><i class="far fa-plus-square"></i> &nbsp;Add</a>
                </div>
                <!-- /.card-header -->

                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" id="active-panel" data-toggle="tab" href="#activePanel" role="tab">Active&nbsp;&nbsp;<i class='nav-icon fas fa-sun'></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="#trash-panel" data-toggle="tab" href="#trashPanel" role="tab">Trash&nbsp;&nbsp;<i class='nav-icon fas fa-recycle'></i></a>
                        </li>
                    </ul>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active show" id="activePanel" role="tabpanel">
                            <table id="activeProducts" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Purchase Price</th>
                                    <th>Information</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Purchase Price</th>
                                    <th>Information</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="trashPanel" role="tabpanel">
                            <table id="trashProducts" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Purchase Price</th>
                                    <th>Information</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Purchase Price</th>
                                    <th>Information</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

    {{-- Modal--}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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
            $("#activeProducts").DataTable({
                responsive:false,
                autoWidth:false,
                processing:true,
                pagingType: 'full_numbers',
                stateSave:false,
                scrollY:true,
                scrollX:true,
                ajax:"{{ url('product/datatable') }}",
                order:[0,'desc'],
                columns:[
                    {data:'code', name:'code'},
                    {data:'name', name:'name'},
                    {data:'purchase_price', name:'purchase_price'},
                    {data:'information', name:'information'},
                    {data: 'status',
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

            $("#trashProducts").DataTable({
                responsive:false,
                autoWidth:false,
                processing:true,
                pagingType: 'full_numbers',
                stateSave:false,
                scrollY:true,
                scrollX:true,
                ajax:"{{ url('product/datatableTrash') }}",
                order:[0,'desc'],
                columns:[
                    {data:'code', name:'code'},
                    {data:'name', name:'name'},
                    {data:'purchase_price', name:'purchase_price'},
                    {data:'information', name:'information'},
                    {data: 'status',
                        render: function (data) {
                            if (data == '2') {
                                return '<span class="badge badge-danger">Deleted</span>';
                            }
                        },

                    },
                    {data:'action', name:'action', searchable: false, sortable: false}
                ]
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
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

        function undoTrash(dt) {
            if (confirm("Do you want to restore this data?")){
                $.ajax({
                    type:'POST',
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
        $('#modal-default').bind("show.bs.modal", function(e){
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
    </script>
@endpush
