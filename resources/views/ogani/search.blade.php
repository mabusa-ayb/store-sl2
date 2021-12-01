@extends('layouts.ogani-layout.app')
@section('title', 'Shop')
@push('css')

@endpush

@section('content')
    @include('layouts.ogani-layout.partials.hero2')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('images/breadcrumbs/bc-tes.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Search</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Search</span>
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
                    <div class="container">
                        <h4>Search results for <span style="color: #e06e6e;" ><em>" {{$term}} "</em></span></h4>
                        <br><br>
                    </div>
                    @if($products->count() == 0)
                    <hr>
                    <div class="row">
                        <div class="container">
                            <h1><span style="color:#dbd2d2;text-shadow: 2px 2px 8px #CAB7B7;">No Products Available</span></h1>
                        </div>
                    </div>
                    @else
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{$products->count()}}</span> Product(s) found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('images/onlineproducts/'.$product->image_path) }}">
                                        <ul class="product__item__pic__hover">
                                            <li>
                                                <form action="{{ route('ogani-add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" id="id" name="id">
                                                    <input type="hidden" value="{{ $product->name }}" id="name" name="name">
                                                    <input type="hidden" value="{{ $product->price }}" id="price" name="price">
                                                    <input type="hidden" value="{{ $product->image_path }}" id="img" name="img">
                                                    <input type="hidden" value="{{ $product->slug }}" id="slug" name="slug">
                                                    <input type="hidden" value="1" id="quantity" name="quantity">
                                                    <button class="btn btn-secondary btn-sm"><i class="fa fa-shopping-cart"></i></a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{ url('/ogani-item/'.$product->id) }}">{{$product->name}}</a></h6>
                                        <h5>${{$product->price}}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                </div>

            </div>
        {!! $products->appends(Request::all())->links() !!}
    </section>

@endsection()
