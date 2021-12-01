@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/custom/style.css') }}">
@endpush

@section('content')
    <div style="margin-top: 20px; margin-bottom: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb blue-grey lighten-4">
                <li class="breadcrumb-item"><a class="black-text" href="/">Home</a></li>
                <li class="breadcrumb-item active">{{$category[0]->name}}</li>
            </ol>
        </nav>
    </div>

    <div class="row" style="margin-top: 60px; margin-bottom: 30px;">
        @if(!$categoryProducts->isEmpty())
            @foreach($categoryProducts as $pro)
                <div class="col-lg-3">
                    <div class="card" style="margin-bottom: 20px; height: auto;">
                        <img src="/images/onlineproducts/{{ $pro->image_path }}"
                             class="card-img-top mx-auto"
                             style="height: 150px; width: 150px;display: block;"
                             alt="{{ $pro->image_path }}"
                        >
                        <div class="card-body">
                            <a href="/onlineproducts/{{$pro->id}}"><h6 class="card-title">{{ $pro->name }}</h6></a>
                            <p>${{ $pro->price }}</p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img">
                                <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug">
                                <input type="hidden" value="1" id="quantity" name="quantity">
                                <div class="card-footer" style="background-color: white;">
                                    <div class="row">
                                        <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                            <i class="fa fa-shopping-cart"></i> add to cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12 alert alert-success alert-dismissible fade show" role="alert">
                No items to display!
            </div>
        @endif
    </div>

@endsection
