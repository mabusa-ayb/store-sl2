@extends('layouts.ogani-layout.app')
@section('title', 'Cart')
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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    @include('layouts.ogani-layout.partials.message')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        @if($cartCollection->count() < 1)
                            <div class="container">
                                <h2><span style="color:#dbd2d2;text-shadow: 2px 2px 8px #CAB7B7;">No Products in the Shopping Cart.</span></h2>
                            </div>
                        @else
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartCollection as $item)
                            <tr>
                                <td class="shoping__cart__item">
                                    <a href="{{ url('ogani-item/'.$item->id) }}">
                                    <img src="/images/onlineproducts/{{ $item->attributes->image }}" alt="" width="80">
                                    <h5>{{ $item->name }}</h5>
                                    </a>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $item->price }}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <form action="{{ url('/ogani-update') }}" method="POST">
                                        @csrf
                                            <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                        <div class="row">
                                            <div class="col-sm-8">

                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" name="quantity" value="{{ $item->quantity }}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-4">
                                                    <button class="btn btn-outline-secondary" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </form>


                                </td>
                                <td class="shoping__cart__total">
                                    ${{ \Cart::get($item->id)->getPriceSum() }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <!--<span class="icon_close"></span>-->
                                    <form action="{{ route('ogani-remove') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                        <button class="btn btn-outline-secondary" style="margin-right: 10px;"><i class="icon_close"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-6">
                    @if(count($cartCollection)>0)
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <form action="{{ url('ogani-clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="site-btn"><span class="icon_loading"></span> Clear Cart</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <br>
                    <a href="{{ route('ogani-shop') }}" class="primary-btn cart-btn"><i class="fa fa-shopping-cart"></i> CONTINUE SHOPPING</a>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>${{ \Cart::getTotal() }}</span></li>
                            <li>Total <span>${{ \Cart::getTotal() }}</span></li>
                        </ul>
                        <a href="/ogani-checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
