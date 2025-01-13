<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

  function categoryPage()
  {
      return view('pages.dashboard.category-page');
  }

  function createCategory(Request $request)
  {
      try {
          $categoryName = $request->input('categoryName');
          $user_id = $request->header('id');
          Category::create([
              'name' => $categoryName,
              'user_id' => $user_id
          ]);
          return response()->json([
              'status' => 'success',
              'message' => 'Category created successfully'
          ]);
      }
      catch (Exception $exception){
          return response()->json([
              'status' => 'failed',
              'message' => 'Category creation Failed'
          ]);
      }



  }

    function categoryList(Request $request)
    {
        $user_id = $request->header('id');
        return Category::where('user_id','=',$user_id)->get();
    }

    function categoryByID(Request $request)
    {
        $category_id = $request->input('id');
        $user_id = $request->header('id');
        return Category::where('id','=',$category_id)->where('user_id','=',$user_id)->first();
    }
    function categoryUpdate(Request $request){
        try {
            $category_id = $request->category_id;
            $user_id = $request->header('id');
            $name = $request->categoryName;

            Category::where('id','=',$category_id)->where('user_id','=',$user_id)->update(['name' => $name]);
            return response()->json([
                'status' => 'success',
                'message' => 'Category Updated successfully'
            ]);
        }
        catch (Exception $exception){
            return response()->json([
                'status' => 'failed',
                'message' => 'Category Update Failed'
            ]);
        }
    }

    function categoryDelete(Request $request){
        $category_id=$request->input('id');
        $user_id=$request->header('id');
        return Category::where('id',$category_id)->where('user_id',$user_id)->delete();
    }


}

