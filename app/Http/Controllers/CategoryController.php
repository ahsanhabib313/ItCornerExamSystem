<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add_category_view(){
        return view('admin.add-category');
    }
    public function add_category_store(Request $request){
        $validationRules = [
            'name' => 'required|max:100|min:10|unique:categories'
        ];
        $validator = Validator::make($request->all(),$validationRules);
        if($validator->fails()) {
            return Response::json(['failed'=>$validator->errors()]);
        }else{
            $category = new Category();
            $category->name = $request->name;
            if($category->save()){
                return Response::json(["success"=>"Category Successfully Added"]);
            }else{
                return Response::json(["failed"=>"Operation Failed! Please try again later"]);
            }
        }
    }

    //show the all categories
    public function show_category(Request $request){

        //get the all categories
        $categories = Category::all();
        return view('admin.show-category', compact('categories'));

    }

    //update the category
    public function update_category(Request $request){
        $update = Category::where('id',$request->id)
                        ->update([
                            'name' => $request->name,
                        ]);

        if($update){
            return response()->json([
                'success' => 'Category Updated Successfully...!'
            ]);
        }else{
            return response()->json([
                'error' => 'Category does not update, Please try again...!'
            ]);
        }
    }

    //delete the category
    public function delete_category(Request $request){

        $delete = DB::table('categories')->where('id',$request->id)->delete();

        if($delete){
            return response()->json([
                'success' => 'Category Deleted Successfully...!'
            ]);
        }else{
            return response()->json([
                'error' => 'Category does not delete, Please try again...!'
            ]);
        }
    }
}
