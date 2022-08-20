<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
class BrandController extends Controller
{
    //
    public function brandview(){

        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));

    }
    public function brandstore(Request $request){

        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_gr' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'INPUT Brand English Name',
            'brand_name_gr.required' => 'INPUT Brand Greek Name',
            'brand_image.required' => 'INPUT Brand Image',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_gr' => $request->brand_name_gr,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_gr' => strtolower(str_replace(' ','-',$request->brand_name_gr)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function brandedit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));

    }

    public function brandupdate(Request $request){
        $brand_id = $request->id;
        $brand_image = $request->old_image;

        if($request->file('brand_image')){
            unlink($brand_image);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
    
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_gr' => $request->brand_name_gr,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_gr' => strtolower(str_replace(' ','-',$request->brand_name_gr)),
                'brand_image' => $save_url,
            ]);
    
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('all.brand')->with($notification);
        }
        else{
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_gr' => $request->brand_name_gr,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_gr' => strtolower(str_replace(' ','-',$request->brand_name_gr)),
                
            ]);
    
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('all.brand')->with($notification);
        }


    }

    public function branddelete($id){
        //dd($id);
        $brand = Brand::findOrFail($id);
        $image = $brand->brand_image;
        unlink($image);

        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

}
