@extends('layouts.form')

@section('title')
    Dreamy | Login
@endsection
@section('keywords')
   login, email, password, account, register
@endsection
@section('description')
    Dreamy furniture store, login
@endsection
@section('content')
    <div class="container-fluid marginTop5 px-5 ">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 py-5 m-auto" id="loginForm">
                <h2 class="font-weight-bold font-italic text-center mb-3 colorRottenCherry">Login</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{session('error')}}</p>
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-danger">
                        <p>{{session('success')}}</p>
                    </div>
                @endif
                <form action="{{route('login')}}" method="POST" name="formLogin" enctype="multipart/form-data">
                    @csrf
                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}"/>
                    </div>
                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Password:</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}"/>
                    </div>
                    <div class="col-12">
                        <a class="colorMint font18 font-weight-bold register" href="{{route('register')}}">Don't have an account? Register here </a>
                    </div>
                    <div class="col text-center mt-2 ">
                        <button type="submit" class="btn btnSubmit colorMint font-weight-bold font18 " >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
