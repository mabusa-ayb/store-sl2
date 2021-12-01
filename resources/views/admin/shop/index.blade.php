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
                    <h1 class="m-0 text-dark">Business</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Admin</li>
                        <li class="breadcrumb-item active">Business Details</li>
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
                    <h3 class="card-title"><small>View Details</small></h3>
                    <a href="business/{{$data[0]->id}}/edit" class="btn btn-outline-success btn-sm float-right"><i class="far fa-edit"></i> &nbsp;Edit</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Logo</label>
                            <div class="col-sm-8">
                                @if($data[0]->logo == '')
                                    <img src="/assets/dist/img/tes-logo.png" alt="Default Logo" height="100 px">
                                @else
                                    <img src="{{$data[0]->logo}}" alt="{{$data[0]->name}} Logo">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{$data[0]->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="address" name="address" disabled> {{$data[0]->address}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="city" name="city" value="{{$data[0]->city}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="country" name="country" value="{{$data[0]->country}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$data[0]->phone_number}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cell Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cell_number" name="cell_number" value="{{$data[0]->cell_number}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email" value="{{$data[0]->email}}" disabled>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                        <div class="card-footer">

                        </div>

                <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

@endsection



