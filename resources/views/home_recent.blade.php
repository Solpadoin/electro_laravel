@extends('blank.blank')

@section('title', 'My Profile')
@section('page', 'My Profile')

@section('content')
    <!-- section title -->
    <div class="col-md-12">
        <div class="section-title">
            <h3 class="title">Recent Viewed</h3>
            <div class="section-nav">
                <ul class="section-tab-nav tab-nav">
                    <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                    <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                    <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                    <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /section title -->

    <!-- Products tab & slick -->
    <div class="col-md-12">
        <div class="row">
            <div class="products-tabs">
                <!-- tab -->
                <div id="tab1" class="tab-pane active">
                    <div class="products-slick" data-nav="#slick-nav-1">
                        @foreach($recent as $product)
                            <!-- product -->
                            <div class="product">
                                <div class="product-img">
                                    <img src="./img/product01.png" alt="">
                                    <div class="product-label">
                                        <span class="sale">-30%</span>
                                        <span class="new">NEW</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $product->category }}</p>
                                    <h3 class="product-name"><a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a></h3>
                                    <h4 class="product-price">$ {{ $product->price }}</del></h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <form method="POST" class="product-btns" action="{{ route('product.wishlist.add', $product->id) }}">
                                            @csrf
                                            <button class="add-to-wishlist" type="submit"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                            <button class="add-to-compare"  type="submit"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                        </form>
                                        <a class="product-btns" href="{{ route('product.show', $product->id) }}"><button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button></a>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <form method="POST" class="add-to-cart" action="{{ route('product.cart.add', [$product->id, 1]) }}">
                                        @csrf
                                        <button class="add-to-cart-btn" type="submit"><i class="fa fa-shopping-cart"></i><span class="tooltipp">add to cart</span></button>
                                    </form>
                                </div>
                            </div>
                            <!-- /product -->
                        @endforeach
                    </div>
                    <div id="slick-nav-1" class="products-slick-nav"></div>
                </div>
                <!-- /tab -->
            </div>
        </div>
    </div>
@endsection
