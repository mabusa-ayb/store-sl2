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
                    <h1 class="m-0 text-dark">Online Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Online Store</li>
                        <li class="breadcrumb-item"><a href="{{route('onlineproduct.index')}}">Products</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Horizontal Form -->
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title"><small>Online Product Details</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('onlineproduct.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Select Product</label>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="hidden" readonly="true" class="form-control" id="id_raw_product_1" name="productid">
                                                    <input type="text" readonly="true" class="form-control" id="name_raw_product_1" name="name" placeholder="Product Name...">
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="/transaction/sales/product/popup_media/1" class="btn btn-outline-primary" title="Product" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        <select class="form-control" name="category">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br>

                        <label>Product Details</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="details" name="details" placeholder="Product Details..." required>
                        </div>

                        <br>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Product Price</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Product Price..." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Shipping Cost</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="shipping" name="shipping" placeholder="Shipping Cost..." required>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <br>

                        <label>Product Description</label>
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <textarea class="description" name="description" id="description"></textarea>
                                </div>
                            </div>
                        </div>

                        <br>

                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Product Image</label>
                        <div class="form-group row">
                            <div class="input-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Save</button>
                        <button type="reset" class="btn btn-default float-right">Reset</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
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
                    <h4 class="modal-title">Products</h4>
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
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        tinymce.init({
            selector:'textarea.description',
            width: '100%',
            height: 300
        });
    </script>
    <script>
        $('#modal-default').bind("show.bs.modal", function(e){
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
    </script>
@endpush
