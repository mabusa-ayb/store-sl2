<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Latest Products</h2>
                </div>
            </div>
        </div>

        @if($products->count() > 0)
        <div class="row featured__filter">

            @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('images/onlineproducts/'.$product->image_path) }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{ url('ogani-item/'.$product->id) }}">{{$product->name}}</a></h6>
                        <h5>${{$product->price}}</h5>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        @else
            <div class="row">
                <div class="container">
                    <div class="center">
                        <h2><span style="color:#dbd2d2;text-shadow: 2px 2px 8px #CAB7B7;position: relative;">No Products Available</span></h2>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<!-- Featured Section End -->
