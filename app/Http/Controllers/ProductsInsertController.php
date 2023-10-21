<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\ProductInsertRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Material;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductsInsertController extends MainController
{
    public function show(){
        $this->data['colors']=Color::all();
        $this->data['categories']=Category::all();
        $this->data['materials']=Material::all();
        $this->data['discounts']=Discount::all();
        return view ('pages.admin.products.insert', ["data"=>$this->data]);
    }

    public function insert(ProductInsertRequest $request){

        $imageName = time() . '.' . $request->image->extension();

        try {
            DB::beginTransaction();

            $newProduct = Product::create(
                ["name"=> $request->name,
                    "img_src" => $imageName,
                    "status"=>0,
                    "img_alt"=> $request->name,
                    "id_category"=>$request->category,
                    "id_color"=>$request->color,
                    "id_material"=>$request->material]
            );
            $prodId=$newProduct->id;
            $param="{id:".$prodId."}{name:".$request->name."}{img_src:".$imageName."}{img_alt:". $request->name."}{id_category:".$request->category."}{id_color".$request->color."}{id_material:".$request->material."}";
           $newPrice=Price::create(
                ["id_product"=> $prodId, "price" => $request->price]
            );
                if($request->get('discountFilter')!=0){

                    DB::table('discount_price')->insert([
                        "id_price"=>$newPrice->id,
                        "id_discount"=>(int)$request->get('discountFilter'),
                        "discount"=>(float)$request->get('discountPrice')
                    ]);
                }

            DB::commit();
            ActivityLogger::LogActivity("Product inserted", $param);
            $request->image->move(public_path('assets/img/'), $imageName);
            return redirect()->route('products-admin');

        } catch(\Exception $e){
            DB::rollBack();
            ActivityLogger::LogActivity("Error while inserting product", $param);
            Log::error($e->getMessage().'\n'. $e->getTraceAsString());
            if(File::exists(public_path('/assets/img/' . $imageName))){
                File::delete(public_path('/assets/img/' . $imageName));
            }
            return redirect()->back()->with('error', 'An error occurred while inserting product');
        }


    }
}
