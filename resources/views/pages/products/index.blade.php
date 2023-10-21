@extends('layouts.layout')
@section('csrf-token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
@section('header_class')
    fixed-top
@endsection
@section('title')
    Dreamy | Products
@endsection
@section('keywords')
    products, lamp, table, armchair, sofa, nightstand, sort, purchase, discount
@endsection
@section('description')
    Dreamy furniture store, where you can purchase furniture with a good discount
@endsection
@section('content')
    <div class="container-fluid marginTop">
        <hr/>
    </div>

    <div class="container-fluid my-5">
        @if (session('error'))
            <div class="alert alert-danger">
                <p>{{session('error')}}</p>
            </div>
        @endif
        <div class="row">

            <div class="col-12 col-sm-3 col-lg-2 mb-5 ">
                <div id="filterP">
                <form action="{{route('products')}}" method="GET">

                    <div id="filter">
                        <ul>
                            <li class="active">
                                <h5 class="filterC py-1 pl-2 font-weight-bold pointer">Categories</h5>
                                <ul class="list-group mb-2 pointer" id="categories" >

                                            @foreach($data['categoryId'] as $cat)
                                                @if(session()->has('category'))

                                                        <li class="list-group-item borderLi">
                                                                    <input type="checkbox" value="{{$cat->id}}" name="chCat[]" class="chCat" id="{{$cat->id}}"
                                                                    @for($i=0;$i <= count(session()->get('category')); $i++)
                                                                        @if(session()->get('category.'.$i)==$cat->id)
                                                                            checked
                                                                            @endif
                                                                        @endfor
                                                                    />
                                                                    {{$cat->name}}
                                                        </li>
                                                @else
                                            <li class="list-group-item borderLi">
                                                <input type="checkbox" value="{{$cat->id}}" name="chCat[]" class="chCat" id="{{$cat->id}}">
                                                {{$cat->name}}
                                            </li>
                                        @endif
                                            @endforeach
                                </ul>
                            </li>
                            <li>
                                <h5 class="filterC py-1 pl-2 font-weight-bold pointer">Colors</h5>
                                <ul class="list-group mb-2 pointer" id="colors">

                                    @foreach($data['colors'] as $col)
                                        @if(session()->has('color'))
                                        <li class="list-group-item borderLi">
                                            <input type="checkbox" value="{{$col->id}}" name="chCol[]" class="chCol" id="{{$col->id}}"
                                                   @for($i=0;$i <= count(session()->get('color')); $i++)
                                                       @if(session()->get('color.'.$i)==$col->id)
                                                           checked
                                                  @endif
                                                @endfor

                                            /> {{$col->color}}
                                        </li>
                                            @else
                                            <li class="list-group-item borderLi">
                                                <input type="checkbox" value="{{$col->id}}" name="chCol[]" class="chCol" id="{{$col->id}}">
                                                {{$col->color}}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <h5 class="filterC py-1 pl-2 font-weight-bold pointer">
                                    Producst status </h5>
                                <ul class="list-group pointer">

                                    <li class="list-group-item borderLi"> <input type="radio" name="status" @if(session()->has('status') && session()->get('status')=='1') checked @endif class="radioS" value="1" /> In stock</li>
                                    <li class="list-group-item borderLi"> <input type="radio" name="status" @if(session()->has('status') && session()->get('status')=='0') checked @endif class="radioS" value="0" /> Out of stock</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col mb-3" id="priceHtml">
                        <label class="font-weight-bold font18 colorRottenCherry">Sort by price</label>
                        <select name="priceSort" class="font18" id="priceSort">
                            <option value="0">Choose</option>
                            <option value="1" @if(session()->has('priceSort') && session()->get('priceSort')=='1') selected @endif >Price descending</option>
                            <option value="2" @if(session()->has('priceSort') && session()->get('priceSort')=='2') selected @endif >Price growing</option>
                        </select>
                    </div>

                    <div class="col mb-3" id="dicountHtml">
                        <label class="colorRottenCherry font18 font-weight-bold">Show dicsounts</label>
                        <select name="discountFilter" class="font18" id="discountFilter">
                            <option value="0">Choose</option>
                            @foreach($data['discounts'] as $dis)
                                @if(session()->has('discount') && session()->get('discount')==$dis->id)
                                <option value="{{$dis->id}}" selected>{{$dis->name}}</option>
                                    @else
                                    <option value="{{$dis->id}}">{{$dis->name}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>

                    <div class="col mb-3">
                        <div class="form-inline">
                            <input type="search" name="keyword" id="find" placeholder="Search by name.." value="@if(session()->has('keyword')) {{session()->get('keyword')}} @endif"/>
                        </div>
                    </div>

                    <div class="col">
                        <button class="btn btnFilter" type="submit">Filter</button>
                    </div>

                </form>
                </div>

            </div>

            <div class="col-12 col-sm-9 col-lg-10">
                <div class="row" id="products">

                    @forelse ($model as $prod)
                        <x-product
                            :name="$prod->productName"
                            :price="$prod->price"
                            :color="$prod->color"
                            :category="$prod->category"
                            :prodId="$prod->prodId"
                            :imgAlt="$prod->imgAlt"
                            :imgSrc="$prod->imgSrc"
                            :discountName="$prod->discountName"
                            :discountStyle="$prod->css"
                            :discountPrice="$prod->discountPrice"
                            :status="$prod->status"
                            :material="$prod->material"
                        >
                        </x-product>
                    @empty
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No products were found</p>
                        </div>
                    @endforelse
                </div>

                <div class="col-12">

                    {{ $model->links("pagination::bootstrap-4") }}
                </div>



            </div>
        </div>
    </div>

@endsection
