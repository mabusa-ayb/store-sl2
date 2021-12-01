@extends('layouts.ogani-layout.app')
@section('title', 'Checkout')
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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Checkout {{ Carbon\Carbon::now()->timestamp }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ url('ogani-order') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="fname" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="sname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="address1" required>
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)" name="address2">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="checkout__input">
                                <p>County/State/Province<span>*</span></p>
                                <input type="text" name="province" required>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="notes" placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach($cartCollection as $item)
                                    <li>
                                        {{$item->name}} -
                                        <small class="text-muted"><strong>Qty: {{$item->quantity}}</strong></small>
                                        <input type="hidden" name="quantity[]" value="{{$item->quantity}}">
                                        <span>{{ \Cart::get($item->id)->getPriceSum() }}</span>
                                        <input type="hidden" name="price[]" value="{{ \Cart::get($item->id)->getPriceSum() }}">
                                        <input type="hidden" name="itemID[]" value="{{$item->id}}">
                                        <input type="hidden" readonly="true" class="form-control" id="my_product" name="my_product[]">
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>${{ \Cart::getTotal() }}</span></div>
                                <div class="checkout__order__total">Total <span>${{ \Cart::getTotal() }}</span></div>

                                <input type="hidden" name="subtotal" value="{{ \Cart::getTotal() }}">
                                <input type="hidden" name="total" value="{{ \Cart::getTotal() }}">

                                <p>
                                    Items bought are subject to <a href="" target="_blank">terms and conditions</a>.
                                </p>

                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment" name="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" name="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @if( \Cart::getTotal() != '0')
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
