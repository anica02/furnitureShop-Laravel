<?php

namespace App\Http\Controllers;


use App\Helpers\ActivityLogger;
use App\Http\Requests\OrderFormRequest;
use App\Models\Order;
use App\Models\OrdersModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class OrdersController extends MainController
{
    public function index(Request $request){

         $this->data['orders']=$this->pagginate($request);
        return view('pages.orders.index',['data'=>$this->data]);
    }

    public function orderForm(Request $request){
        if($request->session()->has('cart')){
            return view('pages.orders.orderForm');
        }else{
            return back()->with('error', 'Your cart is empty');
        }

    }
    public function pagginate(Request $request){
        $all=DB::table('orders')->select('id');

        $query =DB::table('orders')->where('id_user', '=', session()->get('user')->id)->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('order_items')
                ->whereColumn('order_items.id_order', 'orders.id');
        });


        $perPage = 4;
        $query = $query->orderBy("id", "DESC");

        $query = $query->select("id", "address", "quantity", "total", "payment_type", "delivery_method", "created_at");

        return $query->paginate($perPage)->withQueryString();
    }

     public function orderFormSubmit(OrderFormRequest $request){

         if($request->session()->has('cart')){

             $products=DB::table("products")->join('price', 'products.id', '=', 'price.id_product')->leftJoin('discount_price', 'price.id', '=', 'discount_price.id_price')->whereNull('price.old')->whereNull('discount_price.old')->select("products.id as idProd","name", "img_src","img_alt","price", "price.id as id_price", "discount")->get();
             $cart=$request->session()->get('cart');
             $productsCount=count($cart);
             $user=$request->session()->get('user');

             try{
                 $order=new Order();
                 $order->id_user=$user->id;
                 $order->address=$request->address;
                 $order->quantity=$productsCount;

                 $order->payment_type=$request->payment;
                 $order->delivery_method=$request->delivery;
                 $total=0;

                 foreach($cart as $id=>$quantity){
                     foreach ($products as $prod){
                         if($prod->idProd == $id){

                             if($prod->discount){
                                $total+=(int)$quantity*$prod->discount;
                             }
                             else{
                                 $total+=(int)$quantity*$prod->price;
                             }
                         }
                     }
                 }

                 $order->total=$total;
                 $order->save();

                 $orderId=$order->id;

                 $param="{email=".$user->email."}{order id=".$orderId."}";
                 foreach($cart as $id=>$quantity){
                     foreach ($products as $prod){
                         if($prod->idProd == $id){

                             if($prod->discount){
                                 $price=(int)$quantity*$prod->discount;
                             }
                             else{
                                 $price=(int)$quantity*$prod->price;
                             }

                             DB::table('order_items')->insert([
                                 "id_order"=>$orderId,
                                 "id_product"=>$prod->idProd,
                                 "quantity"=>$quantity,
                                 "price"=>$price
                             ]);
                         }
                     }
                 }

                 $request->session()->forget('cart');
                 ActivityLogger::LogActivity("Order made ", $param);
                 return redirect()->route('orders');

             }catch (\Exception $e){
                 ActivityLogger::LogActivity("Error while making order", $param);
                 Log::error($e->getMessage(). "\n". $e->getTraceAsString());
                 return redirect()->back()->with('error-msg', 'An error occurred while checkout');
             }
         }
         else{
             return response()->setStatusCode(404);
         }
     }

    public  function deleteOrder(Request $request) {

        $orderId=$request->orderId;

        try{

            DB::table('orders')->where('id', '=', $orderId)->delete();

            ActivityLogger::LogActivity("Order deleted id= ",$orderId );

        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while deleting order","id=".$orderId);
            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error-msg', 'An error occurred while deleting order');
        }

    }


    public function showOrderItems(Request $request){
        $id=$request->orderItemId;
        $products=Product::all();
        $ordersItems=DB::table('order_items')->where("id_order", '=', $id)->get();

        return response()->json(["data"=>$ordersItems, "products"=>$products]);
    }

}
