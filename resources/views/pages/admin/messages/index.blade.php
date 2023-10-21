@extends('layouts.admin')
@section('csrf-token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Dreamy | Messages
@endsection
@section('keywords')
    message, admin, user, email
@endsection
@section('description')
    Dreamy furniture store, your messages
@endsection

@section('content')

    <div class="container-fluid my-3 ">
        <div class="row">
            <div class="col-12 py-5">
                <h3 class="font-weight-bold font-italic text-center colorBlue">Messages</h3>
                <form action="{{route("show-messages")}}" method="GET">
                    <div class="row mt-3">

                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Email</p>
                            <select name="emailMsg" class="form-control">
                                <option value="" selected>Choose</option>
                                @foreach( $users as $user)
                                    @if(session()->has('emailMsg') && session()->get('emailMsg')==$user->user)
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
                    @if(count($messages)!=0)
                        <div class="col-12 table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody id="messageTR">
                                @foreach($messages as $m)
                                    <tr id="msgId_{{$m->id}}">
                                        <td>{{$m->user}}</td>
                                        <td>{{$m->message}}</td>
                                        <td>{{$m->created_at}}</td>
                                        <td class="text-left">  <button  onclick="deleteMsg({{$m->id}})" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 btnDeleteMsg">Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No messages</p>
                        </div>
                    @endif

                </div>
                <div class="col-12">
                    {{ $messages->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
@endsection
