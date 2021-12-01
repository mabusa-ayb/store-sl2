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
                            <span>Order Complete</span>
                        </div>
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
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div style="padding: 30px 10px 0px 10px">
                    <h2><span style="color:#dbd2d2;text-shadow: 2px 2px 8px #CAB7B7;">Transaction completed Successfully.</span></h2>
                    <div style="padding: 20px 5px 20px 5px">
                        An email containing your invoice has been sent to <strong><span style="color: grey;">{{ $email }}</span></strong> .<br>
                        <strong style="color: red;">NOTE</strong> Please make your payment within the next 7 days!
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

@endsection
