<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset ('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset ('assets/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset ('assets/dist/css/custom.css') }}">
    <!-- favicon -->
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset ('favicon.ico') }}" />

</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <img src="/assets/dist/img/tes-logo.png" alt="Default Logo" height="60 px">
                    <small class="float-right">Date: {{ date('d F Y', strtotime($data[0]->date)) }}</small>
                </h2>
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

                    @foreach ($details as $p)
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
                    Contact Supplier for Payment Methods.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><small><strong>Sub-total:</strong></small></th>
                            <td><small>{{ number_format($data[0]->total, 0,'.',',') }}</small></td>
                        </tr>
                        <tr>
                            <th><small><strong>Tax ( 0% ):</strong></small></th>
                            <td><small>{{ number_format($data[0]->total * 0, 0,'.',',') }}</small></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>{{ number_format($data[0]->total + ($data[0]->total * 0) , 0,'.',',') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>
