{{-- @extends('layouts.app') --}}

@extends('blank.blank')

@section('title', 'Wishlist')
@section('page', 'Wishlist')

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
                        @foreach($wishlist as $item)
                            <div class="col-md-10 col-xs-12">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{ asset('./img/product0'.$item->id.'.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{  $item->category }}</p>
                                        <h3 class="product-name"><a href="{{ route('product.show', $item->id) }}"> {{ $item->title }} </a></h3>
                                        <h4 class="product-price">$ {{ $item->price }}</h4>
                                        <div class="product-rating">
                                        </div>
                                        <form action="{{ route('product.cart.add', [$item->id, 1]) }}" method="post">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                            @csrf
                                        </form>

                                        <!-- <button class="btn btn-success"><i class="fa fa-shopping-cart"></i> <a href="{{ route('product.cart.add', [$item->id, 1]) }}"> Add to cart</a></button>
                                        -->

                                        <form action="{{ route('product.wishlist.delete', $item->id) }}" method="post">
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete Item</button>
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
