@extends('layouts.admin')
@section('csrf-token')
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('title')
    Dreamy | Products
@endsection
@section('keywords')
    image, name, status, color, category, material, price, discount name, discount
@endsection
@section('description')
    Dreamy furniture store, products
@endsection

@section('content')
    <div class="container-fluid border-top marginTB2">
        <div class="row">
            <div class="col-12 py-5">
                <a  class="btn  btnProduct colorMint font-weight-bold text-center"  href="{{route('products-form')}}">
                   INSERT NEW PRODUCT
                </a>
                <h3 class="font-weight-bold font-italic text-center colorRottenCherry mb-5">Products</h3>
                <form action="{{route("products-admin")}}" method="GET">
                    <div class="row mb-5">
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-2 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Discount</p>
                            <select name="discountP" class="form-control">
                                <option value="" >Choose</option>
                                @foreach( $data['discounts'] as $d)
                                    @if(session()->has('discountP') && session()->get('discountP')==$d->id)
                                        <option value="{{$d->id}}" selected>{{$d->name}}</option>
                                    @else
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-2 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Category</p>
                            <select name="categoryP" class="form-control">
                                <option value="" >Choose</option>
                                @foreach( $data['categories'] as $c)
                                    @if(session()->has('categoryP') && session()->get('categoryP')==$c->id)
                                        <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-2 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Status</p>
                            <select name="statusP" class="form-control">
                                <option value="">Choose</option>
                                <option value="0" @if(session()->has('statusP') && session()->get('statusP')=="0") selected @endif >Out of stock</option>
                                <option value="1" @if(session()->has('statusP') && session()->get('statusP')=="1") selected @endif  >In stock</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-2">
                            <p class="font-weight-bold  mb-3 colorBlue font18">Name</p>
                            <input type="search" name="nameP" class="btn btnSubmit colorMint font-weight-bold font18 form-control" value="@if(session()->has('nameP')){{session()->get('nameP') }}@endif" >
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-2">
                            <p class="font-weight-bold  mb-3 colorBlue font18">Filter</p>
                            <button type="submit" class="btn btnSubmit colorMint font-weight-bold font18" >Submit</button>
                        </div>
                    </div>

                </form>
                <div id="orderStatus">
                    @if(count($model)==0)
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No products where found</p>
                        </div>
                    @else
                        <div class="container-fluid">
                            <div class="col-12 table-responsive ">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Image</th>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Color</th>
                                        <th scope="col" class="text-center">Category</th>
                                        <th scope="col" class="text-center">Material</th>
                                        <th scope="col" class="text-center">Price</th>
                                        <th scope="col" class="text-center">Discount name</th>
                                        <th scope="col" class="text-center">Discount</th>
                                        <th scope="col" class="text-center">Created at</th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="ordersTr">
                                    @foreach($model as $product)

                                        <tr id="orderId_{{$product->prodId}}">
                                            <td class="col-2 text-center"><img  class="imgWidth" src="{{asset('assets/img/'.$product->imgSrc)}}" alt="{{$product->imgAlt}}"></td>
                                            <td class="col-1 text-center"> {{ $product->productName}} </td>
                                            <td class="col-1  text-center">{{ $product->status}}</td>
                                            <td class="col-1  text-center">{{ $product->color}}</td>
                                            <td class="col-1  text-center">{{ $product->category}}</td>
                                            <td class="col-1  text-center">{{ $product->material}}</td>
                                            <td class="col-1  text-center">{{$product->price}} $</td>
                                            <td class="col-2  text-center">{{$product->discountName}}</td>
                                            @if($product->discountPrice)
                                            <td class="col-1  text-center">{{$product->discountPrice}} $</td>

                                            @else
                                                <td class="col-1  text-center"></td>
                                                @endif
                                            <td class="col-2  text-center">{{$product->createdAt}}</td>
                                            <td class="col-1 text-center">
                                                <a type="button" class="btn btnCart  btnProduct colorMint font-weight-bold" href="{{route("update-product-form", [ "id" => $product->prodId])}}">
                                                    EDIT
                                                </a>
                                            </td>

                                            <td class="col-1  text-center"> <form action="{{route("product-delete", [ "id" => $product->prodId])}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn  btnProduct colorMint font-weight-bold">
                                                        DELETE
                                                    </button>
                                                </form></td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    @endif

                </div>
                <div class="col-12">
                    {{ $model->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>

@endsection
