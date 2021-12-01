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
                        <li class="breadcrumb-item"><a href="/onlinestore/onlinetransactions/onlinesales">Sales</a></li>
                        <li class="breadcrumb-item active">{{ $data[0]->invoiceNumber }}</li>
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
                    Sale Details
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row" style="padding-bottom: 40px;">
                        <div class="col-md-6">
                            <h5 style="padding-bottom: 10px;"><span style="color: grey;">Transaction</span> Details</h5>
                            <div class="row">
                                <div class="col-md-6 col-sm-12"><strong>Order Number: </strong></div>
                                <div class="col-md-6 col-sm-12">{{ $data[0]->id }}</div>
                                <div class="col-md-6 col-sm-12"><strong>Invoice Number: </strong></div>
                                <div class="col-md-6 col-sm-12">{{ $data[0]->invoiceNumber }}</div>
                                <div class="col-md-6 col-sm-12"><strong>Sale Total: </strong></div>
                                <div class="col-md-6 col-sm-12">${{ $data[0]->total }}</div>
                                <div class="col-md-6 col-sm-12"><strong>Transaction Date: </strong></div>
                                <div class="col-md-6 col-sm-12">{{ date('d-m-Y', strtotime($data[0]->date)) }}</div>
                            </div>

                            <br><br>
                            <strong>Status: </strong>
                            @if($data[0]->status == 0)
                                <button class="btn btn-warning btn-sm">Pending</button>
                            @elseif($data[0]->status == 1)
                                <button class="btn btn-success btn-sm">Completed</button>
                            @endif
                            <br><br>
                            <strong>Product(s): </strong><br>
                            @foreach($transactions as $transaction)
                                <?php
                                $product = \App\Model\Master\Product::where('id','=', $transaction->product_id)->first();
                                ?>
                                @if( $product != NULL )
                                {{ $product->name }}, Quantity: {{ $transaction->quantity }}, Total: ${{ $transaction->price }}
                                @endif
                                <br>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h5 style="padding-bottom: 10px;"><span style="color: grey;">Customer</span> Details</h5>
                            <div class="row">
                                <div class="col-md-6 col-sm-12"><strong><strong>Name: </strong></strong></div>
                                <div class="col-md-6 col-sm-12">{{ ucwords($customer[0]->fname).' '.ucwords($customer[0]->sname)}}</div>
                                <div class="col-md-6 col-sm-12"><strong>Email: </strong></div>
                                <div class="col-md-6 col-sm-12">{{ $customer[0]->email }}</div>
                                <div class="col-md-6 col-sm-12"><strong>Phone #: </strong></div>
                                <div class="col-md-6 col-sm-12">{{ $customer[0]->phoneNumber }}</div>
                            </div>

                            <br><br>
                            <strong>Address </strong><br>
                            {{ $customer[0]->address1 }}<br>
                            {{ $customer[0]->address2 }}<br>
                            {{ $customer[0]->city }}, {{ $customer[0]->province }}<br>
                            {{ strtoupper($customer[0]->country) }}<br><br>

                            @if($data[0]->status == 0)
                                <form class="form-horizontal" method="POST" action="{{route('onlinesales.update', $data[0]->id)}}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $data[0]->id }}">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">COMPLETE ORDER</button>
                                </form>
                            @endif

                            @if($data[0]->status == 1)
                                <form class="form-horizontal" method="POST" action="">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $data[0]->id }}">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">UNDO ORDER COMPLETION</button>
                                </form>
                            @endif

                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->

@endsection



