@extends('blank.blank')

@section('title', 'Cart')
@section('page', 'Cart')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br><br>
                    <ul>
                        <div class="col-md-10 col-xs-12">
                            <div class="product">
                                <div class="product-body">
                                    <p class="product-category"></p>
                                    <h3 class="product-name"><a href=""> All Products</a></h3>
                                    <h4 class="product-price">Total: {{ $totalPrice }} $</h4>
                                    <div class="product-rating">
                                    </div>
                                    <form action="{{ route('product.order.all') }}" method="post">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-shopping-cart"></i> Create Order!</button>
                                        @csrf
                                    </form>

                                    <!-- <button class="btn btn-success"><i class="fa fa-shopping-cart"></i><a href="{{ route('product.order.all') }}"> Create Order!</a></button> -->
                                    <!-- <button class="btn btn-danger"><i class="fa fa-trash"></i> <a href="{{ route('product.order.all.delete') }}"> Delete orders</a></button> -->

                                    <form action="{{ route('product.order.all.delete') }}" method="post">
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete Orders</button>
                                        @method('delete')
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach($cart as $item)
                            <div class="col-md-10 col-xs-12">
                                <div class="product">
                                    <div class="product-img">
                                        <img src=" {{ asset('./img/product0'.$item->id.'.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{  $item->category }}</p>
                                        <h3 class="product-name"><a href="{{ route('product.show', $item->id) }}"> {{ $item->title }} </a></h3>
                                        <h4 class="product-price">$ {{ $item->price }}</h4>
                                        <div class="product-rating">
                                        </div>
                                        <!-- <button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Buy it now!</button> -->
                                        <form action="{{ route('product.cart.delete', $item->id) }}" method="post">
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete Item</button>
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
