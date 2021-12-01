@extends('layouts.ogani-layout.app')
@section('title', 'Order')

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
    @include('layouts.ogani-layout.partials.hero2')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('images/breadcrumbs/bc-tes.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Customer Profile</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <a href="{{ url('profile') }}">{{ Auth::user()->email }}</a>
                            <span>{{ $data->invoiceNumber }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Products</h4>
                            <ul>
                                @foreach($categories as $pcat)
                                    <li><a href="{{ url('/ogani-category/'.$pcat->id) }}">{{$pcat->name}}</a></li>
                                @endforeach
                            </ul>
                            <br><br>
                            <h4>Shopping</h4>
                            <ul>
                                <li><a href="{{ url('/ogani-cart') }}">Cart</a></li>
                                <li><a href="{{ url('/ogani-checkout') }}">Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Logged in as</span>  <strong>{{ ucwords(Auth::user()->name) }}</strong>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6></h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Invoice Number:</strong>
                            </div>
                            <div class="col-md-6">{{ $data->invoiceNumber }}</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Order Number:</strong>
                            </div>
                            <div class="col-md-6">{{ $data->id }}</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Order Total:</strong>
                            </div>
                            <div class="col-md-6">$ {{ $data->total }}</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Order Status:</strong>
                            </div>
                            <div class="col-md-6">
                                @if($data->status == 0)
                                    <strong><span style="color: red;">PENDING</span></strong>
                                @elseif($data->status == 1)
                                    <strong><span style="color: green;">COMPLETED</span></strong>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div>
                            <h5>Purchased Items</h5>
                            <br>
                            <div class="col-md-12">
                                <table id="purchases" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price ($)</th>
                                        <th>Image</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price ($)</th>
                                        <th>Image</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection()
@push('js')
    <!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#purchases").DataTable({
                responsive: true,
                autoWidth: false,
                pagingType: 'full_numbers',
                stateSave:false,
                scrollY:true,
                scrollX:true,
                ajax:"{{ url('profile/orders/datatable/'.$data->id) }}",
                order:[0,'desc'],
                columns:[
                    {data:'name', name:'name'},
                    {data:'quantity', name:'quantity'},
                    {data:'price', name:'price'},
                    {data:'image', name:'image', searchable: false, sortable: false}
                ]
            });

        });

    </script>
@endpush
