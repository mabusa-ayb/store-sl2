<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($categories as $cat)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('images/categories/'.$cat->image) }}">
                            <h5><a href="{{url('/ogani-category/'.$cat->id)}}">{{$cat->name}}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->
