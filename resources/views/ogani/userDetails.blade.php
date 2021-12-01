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
                            <a href="/profile">{{ Auth::user()->email }}</a>
                            <span>Profile</span>
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
                <h4>User Details</h4>
                <form action="{{route('user-details.update', $data[0]->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="fname" value="{{ $data[0]->fname }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="sname" value="{{ $data[0]->fname }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="address1" value="{{ $data[0]->address1 }}">
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)" value="{{ $data[0]->address2 }}" name="address2">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" value="{{ $data[0]->city }}">
                            </div>
                            <div class="checkout__input">
                                <p>County/State/Province<span>*</span></p>
                                <input type="text" name="province" value="{{ $data[0]->province }}">
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" value="{{ $data[0]->country }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phoneNumber" value="{{ $data[0]->phoneNumber }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" value="{{Auth::user()->email}}" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Profile Update</h4>

                                <p>
                                    If Any changes have been made to the Profile details Please Click on the button below.
                                </p>

                                <button type="submit" class="site-btn">UPDATE DETAILS</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
