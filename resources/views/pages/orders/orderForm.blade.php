@extends('layouts.layout')

@section('title')
    Dreamy | Order form
@endsection
@section('keywords')
   address, payment type, delivery method
@endsection
@section('description')
    Dreamy furniture store, order form
@endsection
@section('content')
    <div class="container-fluid border-top my-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-5 py-5 m-auto">
                <h2 class="font-weight-bold font-italic text-center mb-3 colorRottenCherry">Order form</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{session('error')}}</p>
                    </div>
                @endif
                <form action="{{route('order-form-submit')}}" method="POST" name="formOrder" enctype="multipart/form-data">
                    @csrf
                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18 ">Address:*</label>
                        <input type="text" name="address" class="form-control" value="{{old('addres')}}" placeholder="Dimitrija Tucovića 12, Beograd 11000"/>
                        @error('address')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Payment type:*</label>
                        <select name="payment" class="form-control">
                            <option value="0">Choose</option>
                            <option value="card">credit card</option>
                            <option value="cash">cash</option>
                        </select>
                        @error('payment')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div  class="form-group col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18" for="delivery">Delivery: *</label><br/>
                        <input type="radio" name="delivery" id="address" value="adress"> Home address &nbsp;
                        <input type="radio" name="delivery" id="postOffice" value="postOffice"> The post office

                            @error('delivery')
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
