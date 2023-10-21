@extends('layouts.admin')

@section('title')
    Dreamy | Insert new product
@endsection
@section('keywords')
    products, color, material, price, category, image, discount price, discount type
@endsection
@section('description')
    Dreamy furniture store, insert product
@endsection
@section('content')
    <div class="container-fluid border-top">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-5 py-5 m-auto">
            <h2 class="font-weight-bold font-italic text-center mb-3 colorRottenCherry">Insert new product</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{session('error')}}</p>
                    </div>
                @endif
            <form action="{{route('products-post')}}" method="POST" name="formInsertProduct" enctype="multipart/form-data">
                @csrf
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18 ">Name:*</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}"/>
                    @error('name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18">Price:*</label>
                    <input type="number" name="price" class="form-control" value="{{old('price')}}"/>
                    @error('price')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18">Color:*</label>
                   <select name="color" class="form-control">
                       <option value="0">Choose</option>
                       @foreach($data['colors'] as $color)
                           <option value="{{$color->id}}" @if(old('color')==$color->id) selected @endif>{{$color->color}}</option>
                       @endforeach
                   </select>
                    @error('color')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18">Category:*</label>
                    <select name="category" class="form-control">
                        <option value="0">Choose</option>
                        @foreach($data['categories'] as $cat)
                            <option value="{{$cat->id}}" @if(old('category')==$cat->id) selected @endif>{{$cat->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18">Material:*</label>
                    <select name="material" class="form-control">
                        <option value="0">Choose</option>
                        @foreach($data['materials'] as $mat)
                            <option value="{{$mat->id}}" @if(old('material')==$mat->id) selected @endif>{{$mat->name}}</option>
                        @endforeach
                    </select>
                    @error('material')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="colorRottenCherry font18 font-weight-bold">Discount type: </label>
                    <select name="discountFilter" class="font18 form-control" id="discountFilter">
                        <option value="0">Choose</option>
                        @foreach($data['discounts'] as $dis)
                            <option value="{{$dis->id}}" @if(old('discountFilter')==$dis->id) selected @endif>{{$dis->name}}</option>
                        @endforeach
                    </select>
                    @error('discountFilter')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18">Discount price:</label>
                    <input type="text" name="discountPrice" class="form-control"
                           value="{{old('discountPrice')}}"
                    />
                    @error('discountPrice')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label class="font-weight-bold colorRottenCherry font18">Product image:*</label>
                    <input type="file" name="image" class="form-control"/>
                    @error('image')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col text-center ">
                    <button type="submit" class="btn btnSubmit colorMint font-weight-bold font18 " >Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection
