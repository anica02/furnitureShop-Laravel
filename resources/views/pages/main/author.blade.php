@extends('layouts.layout')
@section('title')
    Dreamy | Author
@endsection
@section('keywords')
    products,cart, author, store
@endsection
@section('description')
    Dreamy furniture store, something about our author
@endsection

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-6 text-center mb-3" id="authorImg">
                <img src="{{asset('assets/img/DSC02387-2.jpg')}}" alt="author"/>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card py-3 px-4" id="authorText">
                    <div class="card-body">
                        <h4 class="card-title">My name is Anica Radenković</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Here's something about me</h6>
                        <p class="card-text fontSize">Date of birth: 14.02.2002</p>
                        <p class="card-text fontSize">Status: Student</p>
                        <p class="card-text fontSize">Place of study: ICT College</p>
                        <p class="card-text fontSize">Module: Web programming</p>
                        <p class="card-text fontSize">Title after graduation: Professional Engineer of Electrical Engineering and Computing</p>
                        <p class="card-text fontSize">Objective: Acquiring adequate knowledge, expertise and skills to work in creative places in the field of programming</p>
                        <a href="https://anica02.github.io/portfolioWebPage/" class="card-link fontSize" target="_blank">My portfolio</a><br/>
                        <a href="{{asset('assets/Dokumentacija.pdf')}}" target="_blank"  class=" colorRottenCherry font18">Dokumentacija</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
