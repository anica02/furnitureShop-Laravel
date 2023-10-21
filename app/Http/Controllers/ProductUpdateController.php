<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Material;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;



class ProductUpdateController extends MainController
{
   private $productPriceNew;
   private $productDiscount;
    public function show($id){
        $product = Product::find($id);
        $productPrice=DB::table('price')->select('price', 'id')->where('id_product', '=', $id)->whereNull('old')->first();
        $productDiscount=DB::table('discount_price')->select('discount','id_discount')->where('id_price', '=', $productPrice->id)->whereNull('old')->first();
        $this->data['discounts']=Discount::all();
        $this->data['colors']=Color::all();
        $this->data['categories']=Category::all();
        $this->data['materials']=Material::all();
            return view('pages.admin.products.update', ["product"=>$product,"productPrice"=>$productPrice, "productDiscount"=>$productDiscount ,"data"=>$this->data]);
    }

    public function update(ProductUpdateRequest $request, $id){
        try {

            DB::beginTransaction();
            $product = Product::find($id);
            $param="{Id=".$product->id."}";
            if(!$product) {
                return redirect()->back()->with("error", "There is no product in the database with this id");
            }
            else{

                if($product->name!=$request->get('name')){
                    $product->name = $request->get("name");
                    $param.="{name=".$request->get('name')."}";
                }

                if($request->file('pImage')){
                    if(File::exists(public_path('/assets/img/' . $product->img_src))){
                        File::delete(public_path('/assets/img/' . $product->img_src));
                    }
                    $file=$request->file('pImage');
                    $fileName=time().".".$file->getClientOriginalExtension();

                    $file->move(public_path('assets\img'), $fileName);

                    $product->img_src=$fileName;
                    $product->img_alt=$product->name;

                    $param.="{image=".$fileName."}";
                }

                if($product->status!=$request->get('status')){
                    $product->status = (int)$request->get("status");
                    $param.="{status=".$request->get('status')."}";
                }

                if($product->id_category!=$request->get('category')){
                    $product->id_category = $request->get("category");
                    $param.="{id_category=".$request->get('category')."}";
                }

                if($product->id_color!=$request->get('color')){
                    $product->id_color = $request->get("color");
                    $param.="{id_color=".$request->get('color')."}";
                }

                if($product->id_material!=$request->get('material')){
                    $product->id_material = $request->get("material");
                    $param.="{id_material=".$request->get('material')."}";
                }
                $product->save();
            }


            $productPrice = DB::table('price')->select('id', 'price', 'id_product')->where('id_product', '=', $id)->orderByDesc('id')->first();

            if($productPrice){
                    if($productPrice->price != (float)$request->get('price')){
                        DB::table('price')->where('id','=',$productPrice->id)->update(['old'=>1]);
                        $price= new Price();
                        $price->id_product=$id;
                        $price->price=(float)$request->get('price');
                        $this->productPriceNew=$price->id;
                        $price->save();
                        $param.="{price=".$request->get('price')."}";
                    }
            }
            else{
                $price= new Price();
                $price->id_product=$id;
                $price->price=(float)$request->get('price');
                $this->productPriceNew=$price->id;
                $price->save();
                $param.="{price=".$request->get('price')."}";
            }

            if(empty($this->productPriceNew)){
                $this->productDiscount =DB::table('discount_price')->select('id','id_discount', 'id_price', 'discount')->where('id_price', '=', $productPrice->id)->orderByDesc('id')->first();
            }
            else{
                $this->productDiscount =DB::table('discount_price')->select('id','id_discount', 'id_price', 'discount')->where('id_price', '=', $this->productPriceNew->id)->orderByDesc('id')->first();
            }

            if($this->productDiscount){

                if($request->get('discountFilter')=="0"){
                    DB::table('discount_price')->where('id_price', '=', $this->productDiscount->id_price)->delete();
                }
                elseif($request->get('discountFilter')==$this->productDiscount->id_discount && $request->get('discountPrice')!=$this->productDiscount->discount){
                    DB::table('discount_price')->where('id_price', '=', $this->productDiscount->id_price)->update(['old'=>1]);
                    DB::table('discount_price')->insert([
                        "id_price"=>$this->productDiscount->id_price,
                        "id_discount"=>(int)$request->get('discountFilter'),
                        "discount"=>(float)$request->get('discountPrice')
                    ]);
                    $param.="{discount_filter=".$request->get('discountFilter')."}";
                    $param.="{discount_price=".$request->get('discountFilter')."}";
                }
                elseif($request->get('discountFilter')!="0" && !empty($request->get('discountPrice'))){
                    if($this->productDiscount->id_discount!=$request->get('discountFilter')){
                        DB::table('discount_price')->where('id_price', '=', $this->productDiscount->id_price)->update(['old'=>1]);

                        DB::table('discount_price')->insert([
                            "id_price"=>$this->productDiscount->id_price,
                            "id_discount"=>(int)$request->get('discountFilter'),
                            "discount"=>(float)$request->get('discountPrice')
                        ]);
                        $param.="{discount_filter=".$request->get('discountFilter')."}";
                        $param.="{discount_price=".$request->get('discountFilter')."}";
                    }
                }
            }
            elseif($request->get('discountFilter')!="0" && !empty($request->get('discountPrice'))){
                DB::table('discount_price')->insert([
                    "id_price"=>$productPrice->id,
                    "id_discount"=>(int)$request->get('discountFilter'),
                    "discount"=>(float)$request->get('discountPrice')
                ]);
                $param.="{discount_filter=".$request->get('discountFilter')."}";
                $param.="{discount_price=".$request->get('discountFilter')."}";
            }


            ActivityLogger::LogActivity("Product updated", $param);
            DB::commit();
            return  redirect()->route("products-admin");

        } catch (\Exception $e) {
            ActivityLogger::LogActivity("Error while updating product","id=".$product->id);

            echo $e->getMessage()." ". $e->getMessage();
            Log::error( $e->getMessage(). " " . $e->getTraceAsString());
            return  redirect()->back()->with("error", "An error has occurred, while editing product");
        }

    }

    public function delete(Request $request,$id){
        try{


            $product = Product::find($id);

            if(!$product) {
                return redirect()->back()->with("error", "There is no product in the database with this id");
            }
            DB::table('products')->where('id', '=', $id)->delete();
            if(File::exists(public_path('/assets/img/products/' . $product->img_src))){
                File::delete(public_path('/assets/img/products/' . $product->img_src));
            }
            ActivityLogger::LogActivity("Product deleted ", "id=".$product->id);
            return  redirect()->route("products-admin");
        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while deleting product","id=".$product->id);
            Log::error(  $e->getMessage(). " " . $e->getTraceAsString());
            return  redirect()->back()->with("error", "An error has occurred, while deleting product");
        }
    }
}
