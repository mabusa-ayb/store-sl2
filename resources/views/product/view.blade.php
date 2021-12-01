@extends('layouts.backend.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
                        <li class="breadcrumb-item active">{{ $data[0]->name }}</li>
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
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title"><small>View Details <em><span class="detail_modifier">Modified by {{ $data[0]->user_modify->name }}</span></em></small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('product.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product code</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="code" name="code" value="{{$data[0]->code}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{$data[0]->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Stock Available</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="stock_available" name="stock_available" value="{{$data[0]->stock_available}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Purchase Price</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="purchase_price" name="purchase_price" value="{{$data[0]->purchase_price}}" disabled step="0.01" min="0" max="10" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Selling Price</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="selling_price" name="selling_price" value="{{$data[0]->selling_price}}" disabled step="0.01" min="0" max="10">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-3">
                                @if( $data[0]->status === 1)
                                    <input type="text" class="form-control" id="status" name="status" value="Active" disabled>
                                @elseif( $data[0]->status === 0)
                                    <input type="text" class="form-control" id="status" name="status" value="Inactive" disabled>
                                @elseif( $data[0]->status === 2)
                                    <input type="text" class="form-control" id="status" name="status" value="Deleted" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Product Information</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" id="information" name="information" disabled>{{$data[0]->information}}</textarea>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    @if($data[0]->status != 2)
                    <div class="card-footer">
                        <a href="{{url('master/product/'.$data[0]->id.'/edit')}}" class="btn btn-warning" title="Edit"><i class='nav-icon fas fa-edit'></i></a>
                    </div>
                    @endif
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

@endsection
