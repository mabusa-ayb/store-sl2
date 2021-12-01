@extends('layouts.backend.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title"><small>Product Details</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('product.update', $data[0]->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product code</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="code" name="code" value="{{$data[0]->code}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{$data[0]->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stock Available</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="stock_available" name="stock_available" value="{{$data[0]->stock_available}}">
                            </div>
                        </div>
                        <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Purchase Price</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="purchase_price" name="purchase_price" value="{{$data[0]->purchase_price}}" step="0.01" min="0" max="10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Selling Price</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="selling_price" name="selling_price" value="{{$data[0]->selling_price}}" step="0.01" min="0" max="10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" {{ $data[0]->status === 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $data[0]->status === 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Product Information</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" id="information" name="information">{{$data[0]->information}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                            <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

@endsection
