@extends('layouts.layout')
@section('header_class')
    fixed-top
@endsection
@section('csrf-token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Dreamy | Cart
@endsection
@section('keywords')
    products, lamp, table, armchair, sofa, nightstand, sort, purchase, discount
@endsection
@section('description')
    Dreamy furniture store, your cart
@endsection
@section('content')
    <div class="container border-top  marginTB2">
        <div class="row">
            <div class="col-12 py-5">
                <h3 class="font-weight-bold font-italic text-center colorRottenCherry">Cart status</h3>
                <div id="cartStatus">
                    @if(empty($cartItems))
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">Cart is empty</p>
                        </div>
                    @else

                        @foreach($cartItems as $cart)

                            <x-cart-row :idProd="$cart->idProd" :image="$cart->img_src" :alt="$cart->img_alt" :name="$cart->name" :price="$cart->price" :discount="$cart->discount" >

                            </x-cart-row>
                            <hr/>
                            @endforeach

                    @endif

                </div>
                <div class="row my-4">

                    <div class="col-6 text-center font18">
                        <p>Remove all from cart</p>
                            <a href="{{route('remove-all')}}" class="btn removeButton colorMint py-1 px-1 font18">Remove all</a>

                    </div>
                    <div class="col-6 text-center font18">
                        <p>Go to checkout</p>
                        <a href="{{route('checkout')}}" class="btn removeButton colorMint py-1 px-1 font18">Checkout</a>
                    </div>
                </div>
            </div>
            <!--<div class="col-12 col-md-3 text-center col-lg-4 py-5" id="cart">
                <img src="{{asset('assets/img/flat-design-g85fbe6512_640.png')}}" alt="Shopping bag" class="my-5"/>
            </div>-->
        </div>
    </div>

@endsection
