@extends('layouts.admin')
@section('csrf-token')
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('title')
    Dreamy | Orders
@endsection
@section('keywords')
    address, quantity, total, user, payment type, delivery method,
@endsection
@section('description')
    Dreamy furniture store, orders
@endsection

@section('content')
    <div class="container-fluid border-top marginTB2">
        <div class="row">
            <div class="col-12 py-5">
                <h3 class="font-weight-bold font-italic text-center colorRottenCherry mb-5">Orders</h3>
                <form action="{{route("orders-admin")}}" method="GET">
                    <div class="row mb-5">
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >User</p>
                            <select name="userO" class="form-control">
                                <option value="" >Choose</option>
                                @foreach( $data['emails'] as $user)
                                    @if(session()->has('userO') && session()->get('userO')==$user->id_user)
                                        <option value="{{$user->id_user}}" selected>{{$user->email}}</option>
                                    @else
                                        <option value="{{$user->id_user}}">{{$user->email}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Payment type</p>
                            <select name="paymentU" class="form-control">
                                <option value="" >Choose</option>
                                <option value="card" @if(session()->has('paymentU') && session()->get('paymentU')=="card") selected @endif  >Card</option>
                                <option value="cash" @if(session()->has('paymentU') && session()->get('paymentU')=="cash") selected @endif  >Cash</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6  col-lg-4 col-xl-3 ">
                            <p class="font-weight-bold  mb-3 colorBlue font18" >Delivery method</p>
                            <select name="deliveryU" class="form-control">
                                <option value="" >Choose</option>
                                <option value="address" @if(session()->has('deliveryU') && session()->get('deliveryU')=="address") selected @endif >Home address</option>
                                <option value="postOffice" @if(session()->has('deliveryU') && session()->get('deliveryU')=="postOffice") selected @endif >Post office</option>

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
                        <p class="alert-danger my-5 text-center py-2 font-weight-bold">No orders had been made</p>
                    </div>
                    @else
                        <div class="container-fluid">
                            <div class="col-12 table-responsive ">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">User</th>
                                        <th scope="col" class="text-center">Address</th>
                                        <th scope="col" class="text-center">Quantity</th>
                                        <th scope="col" class="text-center">Total</th>
                                        <th scope="col" class="text-center">Payment type</th>
                                        <th scope="col" class="text-center">Delivery method</th>
                                        <th scope="col" class="text-center">Created at</th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="ordersTr">
                                    @foreach($model as $order)
                                        @foreach($data['users'] as $user)
                                            @if($order->id_user==$user->id)
                                                <tr id="orderId_{{$order->id}}">
                                                <td class="col-2 text-center">{{ $user->email}}</td>
                                            <td class="col-3 text-center">{{ $order->address }}</td>
                                            <td class="col-1 text-center"> {{ $order->quantity}} </td>
                                            <td class="col-3  text-center">{{ $order->total. " $"}}</td>
                                            <td class="col-1  text-center">{{ $order->payment_type}}</td>
                                            <td class="col-1  text-center">{{ $order->delivery_method}}</td>
                                            <td class="col-3  text-center">{{ $order->created_at}}</td>
                                            <td class="col-1 text-center"><button type="button" data-id="{{$order->id}}" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 btnShowOrderItemsAdmin" data-toggle="modal" data-target=".bd-example-modal-lg">
                                                    Show
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade  bd-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog  modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Order items</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <table class="table table-borderless tableBg">
                                                                    <thead>
                                                                    <tr class="borderBottom">
                                                                        <th scope="col" >Product</th>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col" >Price</th>
                                                                    </tr>
                                                                    </thead><tbody id="orderItems">
                                                                    </tbody></table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="colorMint btn btnSubmit font-weight-bold py-1 px-1" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="col-1  text-center"><button  onclick="deleteOrderAdmin({{$order->id}})" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 ">Remove</button></td>
                                        </tr>
                                        @endif
                                    @endforeach
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
