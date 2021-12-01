@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/custom/style.css') }}">
@endpush

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="/images/slides/sld2.jpg" height="350px" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="/images/slides/sld3.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="/images/slides/sld4.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row">
        @foreach($categories as $category)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 box8">
                <a href="#"><img class="card-img-top" src="/images/categories/{{$category->image}}" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">{{$category->name}}</a>
                    </h4>

                    <?php
                    //Count Product in category
                    $productCount = App\OnlineProduct::where('category_id','=',$category->id)->get();
                    $productCount = count($productCount);
                    ?>

                        <div class="box-content">
                            <ul class="icon">
                                <li>
                                    @if($productCount != 0)
                                        <a href="{{url('productcategory/'.$category->id)}}">
                                    @else
                                        <a href="#">
                                    @endif
                                    <i class="fa fa-search"></i> </a> </li>
                                <li><a href="#"><i class="fa fa-link"></i> </a> </li>
                            </ul>
                        </div>

                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        @if($productCount == 1)
                            {{$productCount}} item available.
                        @elseif($productCount == 0)
                            No items available.
                        @else
                            {{$productCount}} items available.
                        @endif
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->
    <br><br>
    @include('store.partials.marketing')
@endsection
