@extends('layouts.backend.app')

@push('css')

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Purchase Order </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Transactions</li>
                        <li class="breadcrumb-item"><a href="{{route('purchase-order.index')}}">Purchases</a></li>
                        <li class="breadcrumb-item active">#{{$data[0]->num_invoice}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <img src="/assets/dist/img/tes-logo.png" alt="Default Logo" height="60 px">
                                    <small class="float-right">Date: {{ date('d F Y', strtotime($data[0]->date)) }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>{{$business[0]->name}}</strong><br>
                                    {{$business[0]->address}}<br>
                                    {{$business[0]->city}}<br>
                                    {{$business[0]->country}}<br>
                                    Phone: {{$business[0]->phone_number}}<br>
                                    Cell: {{$business[0]->cell_number}}<br>
                                    <small><strong>Email: {{$business[0]->email}}</strong></small>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{$data[0]->vendor->name}}</strong><br>
                                    {{$data[0]->vendor->address}}<br>
                                    Phone: {{$data[0]->vendor->phone_number}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{$data[0]->num_invoice}}</b><br>
                                <br>
                                <?php
                                if($data[0]->status == "order"){
                                    $text = "Order";
                                    $label = "info";
                                }
                                if($data[0]->status == "receive"){
                                    $text = "Received";
                                    $label = "warning";
                                }
                                ?>
                                <b>Status:</b> {!! "<span class='badge badge-".$label."'>".$text."</span>" !!}<br>
                                <b>Account:</b> 968-34567
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($detail as $p)
                                    <tr>
                                        <td>{{$p->product->name}}</td>
                                        <td>{{ number_format($p->total, 0,'.',',') }}</td>
                                        <td>{{ number_format($p->price, 0,'.',',') }}</td>
                                        <td>{{ number_format($p->price * $p->total, 0,'.',',') }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Payment Methods:</p>

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Contact Vendor for Payment Methods.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Total:</th>
                                            <td>{{ number_format($data[0]->total, 0,'.',',') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{ route('transaction/purchase-order/print/{id}', $data[0]->id) }}" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('js')

@endpush

