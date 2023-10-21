@extends('layouts.admin')
@section('csrf-token')
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('title')
    Dreamy | Users
@endsection
@section('keywords')
        first name, lats name, email, active, Id_role
@endsection
@section('description')
    Dreamy furniture store, users
@endsection

@section('content')
    <div class="container-fluid border-top marginTB2">
        <div class="row">
            <div class="col-12 py-5">
                <h3 class="font-weight-bold font-italic text-center colorRottenCherry mb-5">Users</h3>
                <form action="{{route("users")}}" method="GET">
                    <div class="row mb-5">
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Email</p>
                            <select name="emailU" class="form-control">
                                <option value="" >Choose</option>
                                @foreach( $data['emails'] as $user)
                                    @if(session()->has('emailU') && session()->get('emailU')==$user->email)
                                        <option value="{{$user->email}}" selected>{{$user->email}}</option>
                                    @else
                                        <option value="{{$user->email}}">{{$user->email}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Role</p>
                            <select name="roleU" class="form-control">
                                <option value="" >Choose</option>
                                @foreach( $data['roles'] as $role)
                                    @if(session()->has('roleU') && session()->get('roleU')==$role->id)
                                        <option value="{{$role->id}}" selected>{{$role->role}}</option>
                                    @else
                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Active</p>
                            <select name="statusU" class="form-control">
                                <option value="" >Choose</option>
                                <option value="0" @if(session()->has('statusU') && session()->get('statusU')=="0") selected @endif >Inactive</option>
                                <option value="1" @if(session()->has('statusU') && session()->get('statusU')=="1") selected @endif >Active</option>

                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3">
                            <p class="font-weight-bold  mb-3 colorBlue font18">Filter</p>
                            <button type="submit" class="btn btnSubmit colorMint font-weight-bold font18" >Submit</button>
                        </div>
                    </div>

                </form>
                <div id="orderStatus">
                    @if(count($model)==0)
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No users had been found</p>
                        </div>
                    @else
                        <div class="container-fluid">
                            <div class="col-12 table-responsive ">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">First name</th>
                                        <th scope="col" class="text-center">Last name</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">Id_role</th>
                                        <th scope="col" class="text-center">Active</th>
                                        <th scope="col" class="text-center">Created at</th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="ordersTr">
                                    @foreach($model as $user)
                                        <tr id="userId_{{$user->id}}">
                                            <td class="col-2 text-center">{{ $user->first_name }}</td>
                                            <td class="col-1 text-center"> {{ $user->last_name}} </td>
                                            <td class="col-3  text-center">{{ $user->email}}</td>
                                            <td class="col-1  text-center">{{ $user->id_role}}</td>
                                            <td class="col-1  text-center">{{ $user->active}}</td>
                                            <td class="col-3  text-center">{{ $user->created_at}}</td>
                                            <td class="col-1 text-center"><button type="button" data-id="{{$user->id}}" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 btnShowUserParam" data-toggle="modal" data-target=".bd-example-modal-lg">
                                                    Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade  bd-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">User</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                                <form action="{{route('edit-user')}}" method="POST">
                                                                   @csrf
                                                                    @method('PATCH')
                                                                    <div id="user">

                                                                    </div>
                                                                </form>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="colorMint btn btnSubmit font-weight-bold py-1 px-1" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="col-1  text-center"><button  onclick="deleteUser({{$user->id}})" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 ">Delete</button></td>
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
