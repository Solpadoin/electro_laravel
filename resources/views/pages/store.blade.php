@extends('blank.blank')

@section('title', 'Store')
@section('page', 'Store')

@section('content')
    <!-- ASIDE -->
    <div id="aside" class="col-md-3">
        <!-- aside Widget -->
        <form method="GET" action="{{ route('store.search.full') }}">
            <div class="aside">
                <h3 class="aside-title">Categories</h3>
                <div class="checkbox-filter">

                    <div class="input-checkbox">
                        <input type="checkbox" id="laptops" name="laptops">
                        <label for="laptops">
                            <span></span>
                            Laptops
                            <small>(0)</small>
                        </label>
                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="smartphones" name="smartphones">
                        <label for="smartphones">
                            <span></span>
                            Smartphones
                            <small>(0)</small>
                        </label>
                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="cameras" name="cameras">
                        <label for="cameras">
                            <span></span>
                            Cameras
                            <small>(0)</small>
                        </label>
                    </div>

                    <div class="input-checkbox">
                        <input type="checkbox" id="accessories" name="accessories">
                        <label for="accessories">
                            <span></span>
                            Accessories
                            <small>(0)</small>
                        </label>
                    </div>
                </div>
            </div>
        <!-- /aside Widget -->

        <!-- aside Widget -->
            <div class="aside">
                <h3 class="aside-title">Price</h3>
                <div class="price-filter">
                    <div id="price-slider"></div>
                    <div class="input-number price-min">
                        <input id="price-min" type="number" name="price-min">
                        <span class="qty-up">+</span>
                        <span class="qty-down">-</span>
                    </div>
                    <span>-</span>
                    <div class="input-number price-max">
                        <input id="price-max" type="number" name="price-max">
                        <span class="qty-up">+</span>
                        <span class="qty-down">-</span>
                    </div>
                </div>
            </div>
            <!-- /aside Widget -->

            <!-- aside Widget -->
            <div class="aside">
                <h3 class="aside-title">Brand</h3>
                <div class="checkbox-filter">
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-1">
                        <label for="brand-1">
                            <span></span>
                            SAMSUNG
                            <small>(578)</small>
                        </label>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-2">
                        <label for="brand-2">
                            <span></span>
                            LG
                            <small>(125)</small>
                        </label>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-3">
                        <label for="brand-3">
                            <span></span>
                            SONY
                            <small>(755)</small>
                        </label>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-4">
                        <label for="brand-4">
                            <span></span>
                            SAMSUNG
                            <small>(578)</small>
                        </label>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-5">
                        <label for="brand-5">
                            <span></span>
                            LG
                            <small>(125)</small>
                        </label>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-6">
                        <label for="brand-6">
                            <span></span>
                            SONY
                            <small>(755)</small>
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit Filter</button>
        </form>
        <!-- /aside Widget -->

        <!-- aside Widget -->
        <div class="aside">
            <h3 class="aside-title">Top selling</h3>

            @foreach($sale as $product)
                <div class="product-widget">
                    <div class="product-img">
                        <img src="{{ asset('./img/product0'.$product->id.'.png') }}" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">{{ $product->category }}</p>
                        <h3 class="product-name"><a href="{{ route('product.show', $product->id )}}">{{ $product->title }}</a></h3>
                        <h4 class="product-price">${{ $product->price }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /aside Widget -->
    </div>
    <!-- /ASIDE -->

    <!-- STORE -->
    <div id="store" class="col-md-9">
        <!-- store top filter -->
        <div class="store-filter clearfix">
            <div class="store-sort">
                <label>
                    Sort By:
                    <select class="input-select">
                        <option value="0">Popular</option>
                        <option value="1">Position</option>
                    </select>
                </label>

                <label>
                    Show:
                    <select class="input-select">
                        <option value="0">20</option>
                        <option value="1">50</option>
                    </select>
                </label>
            </div>
            <ul class="store-grid">
                <li class="active"><i class="fa fa-th"></i></li>
                <li><a href="#"><i class="fa fa-th-list"></i></a></li>
            </ul>
        </div>
        <!-- /store top filter -->

        <!-- store products -->
        <div class="row">
        @foreach($products as $product)
            <!-- product -->
            <div class="col-md-4 col-xs-6">
                <a href ="{{ route('product.show', $product->id) }}"><div class="product">
                    <div class="product-img">
                        <img src="{{ asset('./img/product0'.$product->id.'.png') }}" alt="">
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
                            <form class="product-btns" method="post" action="{{ route('product.wishlist.add', $product->id) }}">
                                @csrf
                                <button class="add-to-wishlist" type="submit"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                            </form>

                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <form class="add-to-cart" method="post" action="{{ route('product.cart.add', [$product->id, 1]) }}">
                            @csrf
                            <button class="add-to-cart-btn" type="submit"><i class="fa fa-heart-o"></i><span class="tooltipp"> add to cart</span></button>
                        </form>

                        <!-- <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>-->
                    </div>
                </div></a>
            </div>
            <!-- /product -->
                <div class="clearfix visible-sm visible-xs"></div>
        @endforeach
        </div>
        <!-- /store products -->

        <!-- store bottom filter -->
        <div class="pull-right">
            @if ( method_exists ( $products , 'links' ) )
                {{ $products->appends(request()->query())->links() }}
            @endif
        </div>
        <!-- /store bottom filter -->
    </div>
    <!-- /STORE -->
@endsection
