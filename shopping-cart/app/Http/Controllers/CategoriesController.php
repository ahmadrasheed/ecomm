<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoriesController extends Controller
{


    public function getCategories(){
        $categories=Category::all();

        return view('Admin.categories',['categories'=>$categories]);


    }

    public function postDeleteOrUpdate(Request $request){

        $data = $request->all();
        $category=Category::find($request->input('id'));

        if(isset($data['delete'])){

            if($category)
                $category->delete();

            return redirect()->route('categories.index');
        }

        if(isset($data['update'])){

            $category->name=$request->input('name');
            $category->update();
            return redirect()->back();
        }

    }

    public function postAdd(Request $request){
        $data=$request->all();

        if(isset($data['add'])){
            $category=new Category();
            $category->name=$request->input('name');

            $category->save();
            return redirect()->back();
        }

    }


    public function getCategoryById($id){
        $category=Category::find($id);
        if(isset($category))
        return $category->name;
        return "sorry, NO items in this category";



    }



}
