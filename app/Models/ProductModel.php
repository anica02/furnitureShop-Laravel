<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductModel
{
    use HasFactory;

    public $price=[
        "1" => ["price", "desc"],
        "2" => ["price", "asc"],
    ];

    public function search(Request $request) {

        $query =Product::join('colors', 'products.id_color', '=', 'colors.id')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->join('price', 'products.id', '=', 'price.id_product')
            ->join('materials', 'materials.id', '=', 'products.id_material')
            ->leftjoin('discount_price', 'price.id', '=', 'discount_price.id_price')
            ->leftjoin('discounts', 'discount_price.id_discount', '=', 'discounts.id')
            ->where('discount_price.old', '=', 0)
            ->orWhere('discount_price.old', '=', NULL)
            ->whereNull('price.old')
            ->whereNull('products.old')
        ;



        if($request->has("chCat")){
            $query = $query->whereIn("products.id_category", $request->get("chCat"));

            $request->session()->put("category",$request->get("chCat") );

        }
        if($request->has("chCol")){
            $query = $query->whereIn("products.id_color", $request->get("chCol"));
            $request->session()->put("color",$request->get("chCol") );
        }

        if($request->has("discountFilter") && $request->get('discountFilter')!="0") {
            $query = $query->where('discounts.id', 'like', $request->get("discountFilter"));
            $request->session()->put("discount",$request->get("discountFilter") );
        }

        if($request->has("status")){
            $query = $query->where('products.status', '=', $request->get("status"));
            $request->session()->put("status",$request->get("status") );
        }

        if($request->has("keyword") && !empty($request->get("keyword"))) {
            $v = $request->get("keyword");
            $query = $query->where("products.name", 'like', '%' . $v . '%');
            $request->session()->put("keyword",$request->get("keyword") );
        }
        if($request->has("priceSort") && $request->get('priceSort')!='0') {
            $sort = $this->getOrderBy($request,"priceSort", $this->price);
            $query = $query->orderBy($sort[0], $sort[1]);
            $request->session()->put("priceSort",$request->get("priceSort") );
        }

        $perPage = 4;
        $query=$query->orderByDesc('products.id');


       $query=$query->select(['materials.name as material','products.id as prodId','products.name as productName', 'products.status as status', 'products.img_src as imgSrc', 'products.img_alt as imgAlt', 'colors.color as color', 'categories.name as category', 'price.price as price', 'discounts.name as discountName', 'discounts.css_style as css', 'discount_price.discount as discountPrice']);

        return $query->paginate($perPage)->withQueryString();

    }
    public function searchProducts(Request $request) {

        $query =Product::join('colors', 'products.id_color', '=', 'colors.id')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->join('price', 'products.id', '=', 'price.id_product')
            ->join('materials', 'materials.id', '=', 'products.id_material')
            ->leftjoin('discount_price', 'price.id', '=', 'discount_price.id_price')
            ->leftjoin('discounts', 'discount_price.id_discount', '=', 'discounts.id')
            ->where('discount_price.old', '=', 0)
            ->orWhere('discount_price.old', '=', NULL)
            ->whereNull('price.old')
            ->whereNull('products.old')
        ;


        if($request->has("discountP") && $request->get('discountP')!="") {
            $query = $query->where('discounts.id', 'like', $request->get("discountP"));
            $request->session()->put("discountP",$request->get("discountP") );
        }
        if($request->has("categoryP") && $request->get('categoryP')!="") {
            $query = $query->where('categories.id', 'like', $request->get("categoryP"));
            $request->session()->put("categoryP",$request->get("categoryP") );
        }
        if($request->has("statusP") && $request->get('statusP')!=""){
            $query = $query->where('products.status', '=', (int)$request->get("statusP"));
            $request->session()->put("statusP",$request->get("statusP") );
        }

        if($request->has("nameP") && !empty($request->get("nameP"))) {
            $v = $request->get("nameP");
            $query = $query->where("products.name", 'like', $v );
            $request->session()->put("nameP",$request->get("nameP") );
        }

        $perPage = 4;
        $query=$query->orderByDesc('products.id');

        $query=$query->select(['products.created_at as createdAt','materials.name as material','products.id as prodId','products.name as productName', 'products.status as status', 'products.img_src as imgSrc', 'products.img_alt as imgAlt', 'colors.color as color', 'categories.name as category', 'price.price as price', 'discounts.name as discountName', 'discounts.css_style as css', 'discount_price.discount as discountPrice']);

        return $query->paginate($perPage)->withQueryString();

    }

    private  function getOrderBy(Request $request, $sortName,$array) {

        $defaultSort = $array["1"];

        if($request->has($sortName) && is_numeric($request->get($sortName))) {
            if(isset($array[$request->get($sortName)])) {
                $sort = $array[$request->get($sortName)];
                if($sort) {
                    $defaultSort = $sort;
                }
            }
        }
        return $defaultSort;
    }



    public  function getProductsByID($ids) {
        return DB::table("products")->join('price', 'products.id', '=', 'price.id_product')->leftJoin('discount_price', 'price.id', '=', 'discount_price.id_price')->whereIn("products.id", $ids)->whereNull('price.old')->whereNull('discount_price.old')->select("products.id as idProd","name", "img_src","img_alt","price", "price.id as id_price", "discount")->get();
    }


}
