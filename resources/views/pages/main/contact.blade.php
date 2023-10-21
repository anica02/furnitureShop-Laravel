@extends('layouts.layout')

@section('title')
    Dreamy | Contact
@endsection
@section('keywords')
    products, lamp, table, armchair, sofa, nightstand, sort, purchase, discount
@endsection
@section('description')
    Dreamy furniture store, contact admin
@endsection
@section('content')
    <div class="container-fluid marginTop5 px-5 ">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-4 py-5 m-auto" id="loginForm">
                <h2 class="font-weight-bold font-italic text-center mb-3 colorRottenCherry">Send message to admin</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{session('error')}}</p>
                    </div>
                    @elseif(session('success'))
                    <div class="alert alert-success">
                        <p>{{session('success')}}</p>
                    </div>
                @endif
                <form action="{{route('message')}}" method="POST" name="formLogin" enctype="multipart/form-data">
                    @csrf
                    <div class="col-6 mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Admin:</label>
                        <select name="admin" class="form-control">
                            <option value="">Choose</option>
                            @foreach($admins as $a)
                                <option value="{{$a->id}}">{{$a->email}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="font-weight-bold colorRottenCherry font18">Message:</label>
                        <textarea name="message" class="form-control" id="messageAdmin">

                        </textarea>
                        @error('message')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="col text-center mt-2 ">
                        <button type="submit" class="btn btnSubmit colorMint font-weight-bold font18 " >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
