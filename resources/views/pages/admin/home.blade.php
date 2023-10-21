@extends('layouts.admin')
@section('title')
    Dreamy | Admin panel
@endsection
@section('keywords')

@endsection
@section('description')
    Dreamy furniture store, admin panel
@endsection
@section('content')


    <h1 class="h2 colorBlue">Dashboard</h1>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div class="container">
            <div class="row align-items-center g-4 mb-5">
                <div class="col-12 col-md-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-users stat"></i>
                        <div class="ms-3 colorBlue">
                            <h4 class="mb-0">{{$data['users']}} customers</h4>
                            <p class="text-800 fs--1 mb-0">Active</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-clock stat"></i>
                        <div class="ms-3 colorBlue">
                            <h4 class="mb-0">{{$data['orders']}} orders</h4>
                            <p class="text-800 fs--1 mb-0">Total orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-store stat"></i>
                        <div class="ms-3 colorBlue">
                            <h4 class="mb-0">{{$data['inStock']}}  products</h4>
                            <p class="text-800 fs--1 mb-0">In stock</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <div class="d-flex align-items-center"><i class="fas fa-store-slash stat"></i>
                        <div class="ms-3 colorBlue">
                            <h4 class="mb-0">{{$data['outOfStock']}}  products</h4>
                            <p class="text-800 fs--1 mb-0">Out of stock</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12 py-5">
                <h3 class="font-weight-bold font-italic text-center colorBlue">User activities</h3>
                <form action="{{route("home-admin")}}" method="GET">
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18">Name</p>
                            <select name="nameAc" class="form-control">
                                <option value="" >Choose</option>
                                @foreach($data['acNames'] as $name)
                                    @if(session()->has('nameAc') && session()->get('nameAc')==$name->name)
                                         <option value="{{$name->name}}" selected >{{$name->name}}</option>
                                    @else
                                        <option value="{{$name->name}}" >{{$name->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Users</p>
                            <select name="userAc" class="form-control">
                                <option value="" >Choose</option>
                                @foreach($data['acUsers'] as $user)
                                    @if(session()->has('userAc') && session()->get('userAc')==$user->user)
                                    <option value="{{$user->user}}" selected>{{$user->user}}</option>
                                    @else
                                        <option value="{{$user->user}}">{{$user->user}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3">
                            <p class="font-weight-bold  mb-3 colorBlue font18">Filter</p>
                        <button type="submit" class="btn btnSubmit colorMint font-weight-bold font18" >Submit</button>
                        </div>
                    </div>

                </form>

                <div id="messages" class="mt-5">
                    @if(count($activities)!=0)
                        <div class="col-12 table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Data</th>
                                </tr>
                                </thead>
                                <tbody id="activitiesTR">
                                @foreach($activities as $a)
                                    <tr>
                                        <td>{{$a->name}}</td>
                                        <td>{{$a->user}}</td>
                                        <td>{{$a->date}}</td>
                                        <td>{{$a->request_data}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No activities</p>
                        </div>
                    @endif

                </div>
                <div class="col-12">
                    {{ $activities->links("pagination::bootstrap-4") }}
                </div>

            </div>
        </div>
    </div>


@endsection
