<div class="col-lg-3">
    <div style="margin-bottom: 20px;">
        <h1 class="my-4">
            <img src="/assets/dist/img/tes-logo.png" alt="Default Logo" height="100 px">
        </h1>
        <!--
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><h5>Product Categories</h5></a>
            </li>

            @foreach($categories as $category)

                <?php
                //Count Product in category
                $catProduct = App\OnlineProduct::where('category_id','=',$category->id)->get();
                $count = count($catProduct);
                ?>
                @if($count > 0)
                    <li class="nav-item">
                        <a class="nav-link" href="/productcategory/{{$category->id}}">{{$category->name}} <span class="badge badge-info">{{$count}}</span></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">{{$category->name}} <span class="badge badge-info">{{$count}}</span></a>
                    </li>
                @endif
            @endforeach
        </ul>-->

        <div class="list-group">

            <a href="javascript:void(0)" class="list-group-item active"><i class="fa fa-search"></i> <span>Product Categories</span></a>
            @foreach($categories as $category)

                <?php
                //Count Product in category
                $catProduct = App\OnlineProduct::where('category_id','=',$category->id)->get();
                $count = count($catProduct);
                ?>
                @if($count > 0)
                    <a href="/productcategory/{{$category->id}}" class="list-group-item"><i class="fa fa-star"></i> <span>{{$category->name}} <span class="badge badge-info">{{$count}}</span></span></a>
                @else
                    <a href="javascript:void(0)" class="list-group-item"><i class="fa fa-star"></i> <span>{{$category->name}} <span class="badge badge-info">{{$count}}</span></span></a>
                @endif
            @endforeach
        </div>
    </div>

    <div id="hide">
        @if (!(request()->is('productcategory/*')))
            <div style="margin-top: 20px;">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#"><h5>Latest Products</h5></a>
                    </li>
                </ul>
                <div id="stage" class="item" style="padding-left: 10px; padding-right: 10px;">
                    @foreach($products as $product)
                        <a title="{{$product->name}} - ${{$product->price}}" href="/onlineproducts/{{$product->id}}"><span class="notify-badge">NEW</span><img src="/images/onlineproducts/{{ $product->image_path }}" width="100%" height="100%"></a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>
<!-- /.col-lg-3 -->
