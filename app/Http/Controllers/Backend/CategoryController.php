<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function categoryview(){

        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function categorystore(Request $request){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_gr' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'INPUT Category English Name',
            'category_name_gr.required' => 'INPUT Category Greek Name',
            'category_icon.required' => 'INPUT Category Icon',
        ]);

        
        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_gr' => $request->category_name_gr,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_gr' => strtolower(str_replace(' ','-',$request->category_name_gr)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function categoryedit($id){

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));


    }
    public function categoryupdate(Request $request, $id){
        $cat_id = $request->id;
   
        Category::findOrFail($cat_id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_gr' => $request->category_name_gr,
            'category_slug_en' => strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_gr' => strtolower(str_replace(' ','-',$request->category_name_gr)),
            'category_icon' => $request->category_icon,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function categorydelete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
