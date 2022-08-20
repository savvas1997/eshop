<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    //
    public function subcategoryview(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subcategory','categories'));
    }
    public function subcategorystore(Request $request){

        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_gr' => 'required',
            'category_id' => 'required',
        ],[
            'subcategory_name_en.required' => 'INPUT SUBCategory English Name',
            'subcategory_name_gr.required' => 'INPUT SUBCategory Greek Name',
            'category_id.required' => 'Select Category Id',
        ]);

        
        SubCategory::insert([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_gr' => $request->subcategory_name_gr,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_gr' => strtolower(str_replace(' ','-',$request->subcategory_name_gr)),
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function subcategoryedit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    }
    public function subcategoryupdate(Request $request){
        $subcat_id = $request->id;
   
        SubCategory::findOrFail($subcat_id)->update([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_gr' => $request->subcategory_name_gr,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_gr' => strtolower(str_replace(' ','-',$request->subcategory_name_gr)),
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subcategory')->with($notification);
    }
    public function subcategorydelete($id){
         SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
/////////// Sub Sub Category Functions
    public function subsubcategoryview(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
       // $subcategory = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory =SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view',compact('categories','subsubcategory'));

    }
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }
    public function subsubcategorystore(Request $request){

        $request->validate([
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_gr' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ],[
            'subsubcategory_name_en.required' => 'INPUT SubSUBCategory English Name',
            'subsubcategory_name_gr.required' => 'INPUT SubSUBCategory Greek Name',
            'category_id.required' => 'Select Category Id',
        ]);

        
        SubSubCategory::insert([
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_gr' => $request->subsubcategory_name_gr,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_gr' => strtolower(str_replace(' ','-',$request->subsubcategory_name_gr)),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        $notification = array(
            'message' => 'Sub SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function subsubcategoryedit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);

        return view('backend.category.subsubcategory_edit',compact('subcategories','categories','subsubcategory'));
    }

    public function subsubcategoryupdate(Request $request){

        $subsubcat_id = $request->id;
   
        SubSubCategory::findOrFail($subsubcat_id)->update([
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_gr' => $request->subsubcategory_name_gr,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_slug_en)),
            'subsubcategory_slug_gr' => strtolower(str_replace(' ','-',$request->subsubcategory_slug_gr)),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,

        ]);

        $notification = array(
            'message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }
    public function subsubcategorydelete($id){
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub-SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
