<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function productPage()
    {
        return view('pages.dashboard.product-page');
    }


//    public function getImageUrl( $request)
//    {
//        $image = $request->file('image');
//        $imageExtension       = $image->getClientOriginalExtension(); // .png
//        $imageName            = time().'.'.$imageExtension; //394833.png
//        $directory            = 'uploads/';
//        $image->move($directory, $imageName);
//        $imageURL = $directory.$imageName;
//        return $imageURL;
//    }
    function productCreate(Request $request) {
        $user_id = $request->header('id');
//        $imageURL = $this->getImageUrl($request);

        $image = $request->file('image');
        $imageExtension       = $image->getClientOriginalExtension(); // .png
        $imageName            = time().'.'.$imageExtension; //394833.png
        $directory            = 'product-images/';
        $image->move($directory, $imageName);
        $imageURL = $directory.$imageName;

        return Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'image_url' =>$imageURL,
            'user_id' => $user_id,
            'category_id' =>$request->input('category_id')
        ]);

    }
    function productList(Request $request)
    {
        $user_id = $request->header('id');
        return Product::where('user_id','=',$user_id)->get();
    }

    function productByID(Request $request)
    {
       $product_id = $request->id;
       $user_id = $request->header('id');
       return Product::where('id',$product_id)->where('user_id',$user_id)->first();
    }

    function productUpdate(Request $request){

        $product_id = $request->input('id');
        $user_id = $request->header('id');

            // image path create
        if ($request->hasfile('image')) {
            // $imageURL = $this->getImageUrl($request); // we can call function from here
            $image = $request->file('image');
            $imageExtension       = $image->getClientOriginalExtension(); // .png
            $imageName            = time().'.'.$imageExtension; //394833.png
            $directory            = 'product-images/';
            $image->move($directory, $imageName);
            $imageURL = $directory.$imageName;

            // old image delete
            $filePath = $request->input('file_path');
            File::delete($filePath);

            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'image_url'=>$imageURL,
                'category_id'=>$request->input('category_id')
            ]);

        }
        else {
            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'category_id'=>$request->input('category_id'),
//                'image_url'=> $request->input('file_path')
            ]);
        }

    }

    function productDelete(Request $request){

        $user_id = $request->header('id');
        $product_id = $request->input('product_id');
        return Product::where('id',$product_id)->where('user_id',$user_id)->delete();

    }








}
