<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product(){
    	return response()->json(Product::select('id', 'pro_name', 'pro_price', 'pro_avatar')->get(), 200);
    }

    public function productByID($id){
    	$product = Product::find($id);
    	if(is_null($product)){
    		return response()->json(["message" => "not found ID"], 404);	
    	}
    	return response()->json(Product::where('id', $id)->select('id', 'pro_name', 'pro_price', 'pro_avatar')->first(), 200);
    }

    public function productSave(Request $request){
    	$product = Product::create($request->all());
    	return response()->json($product, 201);
    }

    public function productUpdate(Request $request, $id){
    	$product = Product::find($id);
    	$product->update($request->all());
    	return response()->json($product, 200);
    }

    public function productDelete(Request $request, $id){
    	$product = Product::find($id);
    	$product->delete();
    	return response()->json(null, 204);
    }
}
