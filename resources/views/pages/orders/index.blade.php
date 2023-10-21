@extends('layouts.layout')
@section('csrf-token')
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('title')
    Dreamy | Orders
@endsection
@section('keywords')
    address, total, quantity, payment type, delivery method
@endsection
@section('description')
    Dreamy furniture store, your orders
@endsection
@section('header_class')
    fixed-top
@endsection
@section('content')
    <div class="container-fluid border-top marginTB2">
        <div class="row">
            <div class="col-12 py-5">
                <h3 class="font-weight-bold font-italic text-center colorRottenCherry">My orders</h3>
                <div id="orderStatus">
                    @if(count($data['orders'])==0))
                        <div class="col-12">
                            <p class="alert-danger my-5 text-center py-2 font-weight-bold">You haven't purchased anything</p>
                        </div>
                    @else
                            <div class="container-fluid">
                                <div class="col-12 table-responsive ">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
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
                                        @foreach($data['orders'] as $order)

                                            <tr id="orderId_{{$order->id}}">
                                                <td class="col-3 text-center">{{ $order->address }}</td>
                                                <td class="col-1 text-center"> {{ $order->quantity}} </td>
                                                <td class="col-3  text-center">{{ $order->total. " $"}}</td>
                                                <td class="col-1  text-center">{{ $order->payment_type}}</td>
                                                <td class="col-1  text-center">{{ $order->delivery_method}}</td>
                                                <td class="col-3  text-center">{{ $order->created_at}}</td>
                                                <td class="col-1 text-center"><button type="button" data-id="{{$order->id}}" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 btnShowOrderItems" data-toggle="modal" data-target=".bd-example-modal-lg">
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

                                                <td class="col-1  text-center"><button  onclick="deleteOrder({{$order->id}})" class="colorMint btn btnSubmit font-weight-bold py-1 px-1 ">Cancel</button></td>

                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                    @endif

                </div>
            </div>
            <div class="col-12">

                {{ $data['orders']->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>

@endsection
