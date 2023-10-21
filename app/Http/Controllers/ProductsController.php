<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductsController extends MainController
{
    public function index(Request $request){

        $model=new ProductModel();

        $this->data['categoryId']=Category::all();
        $this->data['colors']=Color::all();
        $this->data['discounts']=Discount::all();

        $request->session()->forget('color');
        $request->session()->forget('discount');
        $request->session()->forget('status');
        $request->session()->forget('keyword');
        $request->session()->forget('category');
        $request->session()->forget('color');
        $request->session()->forget('priceSort');
        //dd($model->search($request));

        return view('pages.products.index', ["data"=> $this->data, "model"=> $model->search($request)]);
    }







}
