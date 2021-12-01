@extends('layouts.ogani-layout.app')
@section('title', 'Product')
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
                        <h2>{{ $product[0]->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <a href="{{ url('/ogani-category/'.$productCategory[0]->id) }}">{{ $productCategory[0]->name }}</a>
                            <span>{{ $product[0]->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ asset('/images/onlineproducts/'.$product[0]->image_path) }}" alt="{{ $product[0]->name }}">
                        </div>
                        <!--<div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg" src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg" src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg" src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg" src="img/product/details/thumb-4.jpg" alt="">
                        </div>-->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product[0]->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__details__price">${{ $product[0]->price }}</div>
                        <p>{{ $product[0]->details }}</p>

                        <form action="{{ route('ogani-add') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $product[0]->id }}" id="id" name="id">
                            <input type="hidden" value="{{ $product[0]->name }}" id="name" name="name">
                            <input type="hidden" value="{{ $product[0]->price }}" id="price" name="price">
                            <input type="hidden" value="{{ $product[0]->image_path }}" id="img" name="img">
                            <input type="hidden" value="{{ $product[0]->slug }}" id="slug" name="slug">
                            <input type="hidden" value="1" id="quantity" name="quantity">

                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" name="quantity">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">ADD TO CART</button>
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        </form>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            @if($product[0]->sizes != NULL)
                            <li><b>Sizes</b> <span>{{ $product[0]->sizes }}</span></li>
                            @endif
                            @if($product[0]->colours != NULL)
                            <li><b>Colours</b> <span>{{ $product[0]->colours }}</span></li>
                            @endif
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Test Info section -->
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="false">Description</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="true">Reviews & Comments <span>({{ count($comments) }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{!! $product[0]->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane active" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">

                                    @if (Auth::check())
                                        <form class="form-horizontal" method="POST" action="{{route('comments.store')}}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="2" id="comment" name="comment" placeholder="Comment..." required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="site-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        Login or register on the Platform to comments or review the product.<br>
                                        <a class="site-btn" href="{{ route('register') }}">Register</a>
                                    @endif
                                    <br><br>

                                        @if(count($comments) > 0)

                                        <div style="background-color: #f0eded; padding: 20px; border-radius: 5px;">
                                            <h6>Comments</h6>
                                            @foreach($comments as $comment)
                                            <p>
                                                {{ $comment->comment }}
                                                <?php
                                                    $commenter = App\User::where('id','=', $comment->commenter_id)->first();
                                                ?>
                                                <br>
                                                <small><strong>{{ $commenter->name }}</strong>, <span style="color: red;">{{ date('Y-m-d', strtotime($comment->updated_at)) }}</span></small>
                                            </p>
                                            @endforeach
                                        </div>

                                        @else
                                        <p><strong>No comments available!</strong></p>
                                        @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Test Info Section -->
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
    <!-- Related Product Section Begin -->
    @if($relatedProducts->count() > 0)
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($relatedProducts as $rel)
                    @if($rel->id != $product[0]->id)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('/images/onlineproducts/'.$rel->image_path) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ url('/ogani-item/'.$rel->id) }}">{{$rel->name}}</a></h6>
                                <h5>${{$rel->price}}</h5>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
 
