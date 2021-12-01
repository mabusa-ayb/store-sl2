@extends('layouts.ogani-layout.app')
@section('title', 'Product Category')
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
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    @include('layouts.ogani-layout.partials.message')
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+27 797 139 735</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>
                            #12 Kirschner Road <br>
                            Unit 33 Stanton Village<br>
                            Benoni AH North<br>
                            1501
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>08:00 am to 05:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>info@sl2.co.za</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3582.2263967179515!2d28.297900414475897!3d-26.124160267067282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s12%20Kirschner%20Road%20Unit%2033%20Stanton%20Village%20Benoni%20AH%20North%201501!5e0!3m2!1sen!2szw!4v1623247652523!5m2!1sen!2szw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>Benoni</h4>
                <ul>
                    <li>Phone: +27 797 139 735</li>
                    <li>
                        Add: #12 Kirschner Road <br>
                        Unit 33 Stanton Village<br>
                        Benoni AH North<br>
                        1501
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->
    @include('layouts.ogani-layout.partials.contact')
@endsection
