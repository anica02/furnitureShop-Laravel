@extends('layouts.layout')

@section('csrf-token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    Dreamy | Furniture store
@endsection

@section('keywords')
    products, furniture, lamps, tables, armchairs, sofas
@endsection

@section('description')
    Dreamy furniture store, here to help you decorate your home with our furniture
@endsection

@section('header_class')
    fixed-top
@endsection
@section('banner')
    @include('fixed.banner')
@endsection


@section('content')
    <div class="container my-5">
        <div class="row">
            <h2 class="centering border-bottom font-italic">What do we offer?</h2>
        </div>
        <div id="productDes">

             @foreach($data['categoryId'] as $cat)

                <x-card
                    :image="$cat->img_src"
                    :imageAlt="$cat->name"
                    :title="$cat->name"
                    :description1="$cat->description1"
                    :description2="$cat->description2"
                    :idCat="$cat->id"
                ></x-card>

            @endforeach
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row my-5 col-12">
            <h2 class="centering border-bottom font-italic">Need help with room design, here are some ideas?</h2>
        </div>
        <div id="rooms-Gallery">
            <div class="row my-5" id="room">
                @foreach($data['rooms'] as $room)
                    <x-room-card
                        :src="$room['src']"
                        :alt="$room['alt']"
                    ></x-room-card>
                @endforeach
            </div>
        </div>
    </div>
@endsection
