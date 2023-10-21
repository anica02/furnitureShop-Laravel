@extends('layouts.form')

@section('title')
    Dreamy | Register
@endsection
@section('keywords')
    register, name, email ,password
@endsection
@section('description')
    Dreamy furniture store, create your account
@endsection
@section('content')
    <div class="container-fluid marginTop3 px-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 py-5  m-auto" id="loginForm">
                <h2 class="font-weight-bold font-italic text-center mb-3 colorRottenCherry">Register</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{session('error')}}</p>
                    </div>
                @endif
                <form action="{{route('register-post')}}" method="POST" name="formRegister" enctype="multipart/form-data">
                    @csrf

                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">First name:</label>
                        <input type="text" name="firstName" class="form-control" value="{{old('firstName')}}"/>
                        @error('firstName')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Last name:</label>
                        <input type="text" name="lastName" class="form-control" value="{{old('lastName')}}"/>
                        @error('lastName')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>


                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}"/>
                        @error('email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Password:</label>
                       <input type="text" name="password" class="form-control" value="{{old('password')}}"/>
                        @error('password')
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
