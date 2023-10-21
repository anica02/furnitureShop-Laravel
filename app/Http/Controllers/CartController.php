<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\AddToCartRequest;


use App\Models\Order;
use App\Models\OrdersModel;
use App\Models\Product;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends MainController
{


    public function index(Request $request){

        if($request->session()->has("cart")) {
            $productIds = array_keys($request->session()->get("cart"));
            $model = new ProductModel();
            $products = $model->getProductsByID($productIds);
            return view("pages.cart.index", [
                "cartItems" => $products
            ]);
        } else {
            return view("pages.cart.index", ['cartItems'=>[]]);
        }
    }

    public function update(Request $request) {

        $id = $request->productId;
        $qty = $request->quantity;
            $param="{id=".$id."}{quantity=".$qty."}";
        if(session()->has("cart")) {
            $cart = session()->get("cart");

            if(isset($cart[$id])) {
                $cart[$id] = $qty;
                session()->put("cart", $cart);
            }
        }
        ActivityLogger::LogActivity("Product added to cart",$param) ;
    }
    public function add(AddToCartRequest $request){

        if($request->session()->has("cart")) {
            $cart = $request->session()->get("cart");

            if(isset($cart[$request->productId])) {
                $cart[$request->productId] = $cart[$request->productId]+1;
            } else {
                $cart[$request->productId] = 1;
            }
            ActivityLogger::LogActivityReq("Product added to cart");
            $request->session()->put("cart", $cart);

        } else {
            $cart = [];
            $productId = $request->productId;
            $key = strval($productId);
            $cart[$key] = 1;
            ActivityLogger::LogActivityReq("Product added to cart");
            $request->session()->put("cart", $cart);

        }
    }

    public  function remove(Request $request) {

        $cart = session()->get("cart");
        if(isset($cart[$request->productId])) {
            unset($cart[$request->productId]);
            session()->put("cart", $cart);
            if(count(session()->get("cart"))==0){
                ActivityLogger::LogActivityReq("Product removed from cart");
                $request->session()->forget('cart');
            }
        } else {
            return response()->setStatusCode(404);
        }
    }

    public  function removeAll(Request $request) {
        ActivityLogger::LogActivityReq("Products removed from cart");
        $request->session()->forget('cart');
        return redirect()->back();
    }



}
