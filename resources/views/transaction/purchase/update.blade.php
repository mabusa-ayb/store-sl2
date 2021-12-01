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
                    <h1 class="m-0 text-dark">Purchase Order</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Transaction</li>
                        <li class="breadcrumb-item"><a href="{{route('purchase-order.index')}}">Purchases</a></li>
                        <li class="breadcrumb-item active">Edit Purchase Order</li>
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
                    <h3 class="card-title"><small>Purchase Order Details</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('purchase-order.update', $data[0]->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="date" name="date" value="{{date('d-m-Y', strtotime($data[0]->date))}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Invoice Number</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{$data[0]->num_invoice}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Information</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" id="information" name="information" required>{{$data[0]->information}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Supplier Name</label>
                            <div class="col-sm-10">
                                <input type="hidden" readonly="true" class="form-control" id="id_ven" name="id_ven" value="{{$data[0]->id_vendor}}">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" readonly="true" class="form-control" id="name_ven" name="name_ven" value="{{$data[0]->vendor->name}}" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="/transaction/purchase-order/vendor/popup_media" class="btn btn-outline-primary" title="Vendor" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label>Products Details</label>
                        <div class="col-md-12 field-wrapper">

                            @if(isset($data))

                                <?php
                                $i = 1;
                                ?>

                                @foreach($detail as $key=>$value)

                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="hidden" readonly="true" class="form-control" value="<?=$value['id_product'];?>" id="id_raw_product_<?=$i;?>" name="id_raw_product[]">
                                                    <input type="text" readonly="true" class="form-control" value="<?=$value['product']->name;?>" id="name_raw_product_<?=$i;?>" name="name_raw_product[]" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="/transaction/purchase-order/product/popup_media/{{$i}}" class="btn btn-outline-primary" title="Product" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" value="<?=$value['price'];?>" id="price_<?=$i;?>" name="price[]" placeholder="Price">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" value="<?=$value['total'];?>" id="total_<?=$i;?>" name="total[]" placeholder="Total Quantity" required>
                                        </div>

                                        <?php
                                        if($i==1){
                                        ?>

                                        <div class="col-sm-2">
                                            <a href="javascript:void(0)" class="btn btn-primary add_Button" title="Add Row"><i class="fas fa-plus"></i></a>
                                        </div>

                                        <?php
                                        }else{
                                        ?>

                                        <div class="col-sm-2">
                                            <a href="javascript:void(0)" class="btn btn-danger remove" title="Delete"><i class="fas fa-minus"></i></a>
                                        </div>

                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <?php
                                    $i++;
                                    ?>

                                @endforeach

                            @endif

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
    <script>
        $(document).ready(function () {
            var addButton = $('.add_Button');
            var wrapper = $('.field-wrapper');
            var X = "{{ $detail_count + $i }}";

            $(addButton).click(function(){
                X++;
                $(wrapper).append(
                    '<div class="form-group row">'+
                    '<div class="col-md-6">'+
                    '<div class="row">'+
                    '<div class="col-md-10">'+
                    '<input type="hidden" readonly="true" class="form-control" id="id_raw_product_'+X+'" name="id_raw_product[]">'+
                    '<input type="text" readonly="true" class="form-control" id="name_raw_product_'+X+'" name="name_raw_product[]" placeholder="Product Name...">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                    '<a href="/transaction/purchase-order/product/popup_media/'+X+'" class="btn btn-outline-primary" title="Product" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search" aria-hidden="true"></i></a>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<input type="text" class="form-control" id="price_'+X+'" name="price[]" placeholder="Price">'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<input type="text" class="form-control" id="total_'+X+'" name="total[]" placeholder="Total Quantity" required>'+
                    '</div>'+
                    '<div class="col-sm-2">'+
                    '<a href="javascript:void(0)" class="btn btn-danger remove" title="Delete"><i class="fas fa-minus"></i></a>'+
                    '</div>'+
                    '</div>'
                );
            });

            $(wrapper).on('click','.remove',function(e){
                if(confirm("Do you want to delete this row?")){
                    e.preventDefault();
                    $(this).parent().parent().remove();
                }
            })
        })
    </script>
    <script>
        $(function(){
            $('#date').datepicker({
                autoclose: true,
                dateFormat: 'dd-mm-yy',
            })
        });
    </script>
    <script>
        $('#modal-default').bind("show.bs.modal", function(e){
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
    </script>
@endpush
