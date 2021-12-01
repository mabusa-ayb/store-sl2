@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/custom/style.css') }}">
@endpush

@section('content')
    <div style="margin-top: 20px; margin-bottom: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb blue-grey lighten-4">
                <li class="breadcrumb-item"><a class="black-text" href="/">Home</a></li>
                <li class="breadcrumb-item active">{{$item[0]->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <img src="/images/onlineproducts/{{ $categoryProduct[0]->image_path }}"
                 class="fit-image"
                 alt="{{ $categoryProduct[0]->image_path }}"
            >
        </div>
        <div class="col-lg-5">
            <div style="padding: 30px;">
                <h3 class="my-3">{{ $categoryProduct[0]->name }}</h3>
                <p>
                    <span style="color: #7e7e7e;"><small>Specifications</small></span><br>
                    {{ $categoryProduct[0]->details }}
                </p>
                <p>
                    <span style="color: #7e7e7e;"><small>Available Sizes</small></span><br>
                    @if($categoryProduct[0]->sizes != null)
                        {{ $categoryProduct[0]->sizes }}
                    @else
                        N/A
                    @endif
                </p>

                <p>
                    <span style="color: #7e7e7e;"><small>Available Colours</small></span><br>
                    @if($categoryProduct[0]->colours != null)
                        {{ $categoryProduct[0]->colours }}
                    @else
                        N/A
                    @endif
                </p>

                <div style="background-color: #6c757d; color: #ffffff; padding: 10px;">
                    <h4 class="mb-0">$ {{ $categoryProduct[0]->price }}</h4>
                    <small>Excl. Tax</small>
                </div>

            </div>

            <div class="card-body">
                <form action="{{ route('cart.store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $categoryProduct[0]->id }}" id="id" name="id">
                    <input type="hidden" value="{{ $categoryProduct[0]->name }}" id="name" name="name">
                    <input type="hidden" value="{{ $categoryProduct[0]->price }}" id="price" name="price">
                    <input type="hidden" value="{{ $categoryProduct[0]->image_path }}" id="img" name="img">
                    <input type="hidden" value="{{ $categoryProduct[0]->slug }}" id="slug" name="slug">
                    <input type="hidden" value="1" id="quantity" name="quantity">
                    <div class="card-footer" style="background-color: white;">
                        <div class="row">
                            <button class="btn btn-primary btn-sm" class="tooltip-test" title="add to cart">
                                <i class="fa fa-shopping-cart"></i> add to cart
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <br>
    <div style="margin-bottom: 80px;">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p class="text-justify">{!! $categoryProduct[0]->description !!}</p>
            </div>
        </div>
    </div>

@endsection
