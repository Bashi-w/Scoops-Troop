<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getAllProducts(){
        $data = Product::all();
        return response()->json([
            'products' => $data
        ],200);
    }

    public function getSingleProduct($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'message' => 'Product Not FOund'
            ],404); 
        }

        return response()->json([
            'product' => $product
        ],200);
    }

    public function addNewProduct(StoreProductRequest $request){

        try{
            $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();

            Product::create(
                [
                    'name' => $request->name,
                    'image' => $imageName,
                    'price' => $request->price,
                    'description' =>$request->description
                ]
                );

                Storage::disk('public')->put($imageName, file_get_contents($request->image));

                return response()->json([
                    'message' => "Product successfully created"
                ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong',
                'message' => $e->getMessage()
            ], 500);
        }
    }

     public function updateProduct(StoreProductRequest $request, $id){
        try{
            //Find product
            $product = Product::find($id);
            if(!$product){
                return response()->json([
                    'message' => 'Product Not Found'
                ],404); 
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;

            if($request->image){
                //public storage
                $storage = Storage::disk('public');

                //delete old image
                if($storage->exists($product->image)){
                    $storage->delete($product->image);
                }

                //get image name
                $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
                $product->image = $imageName;

                //save image in public folder
                $storage->put($imageName, file_get_contents($request->image));
            }

            $product->update();

            return response()->json([
                'message' => "Product updated successfully"
            ],200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => "Something went wrong"
            ], 500);
        }
     }

     public function deleteProduct($id){
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'message' => 'Product Not Found'
            ],404); 
        }

        $storage = Storage::disk('public');

        //delete old image
        if($storage->exists($product->image)){
            $storage->delete($product->image);
        }

        $product->delete();
        
        return response()->json([
            'message' => "Product deleted successfully"
        ], 200);

     }



    
}
