<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Image;
class ProductController extends Controller
{
    //
   public function addproduct(){

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add',compact('categories','brands'));

   }
   public function productstore(Request $request){

     $image = $request->file('product_thambnail');
     $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
     Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
     $save_url = 'upload/products/thambnail/'.$name_gen;


    $product_id = Product::insertGetId([
          'brand_id' => $request->brand_id,
          'category_id'=> $request->category_id,
          'subcategory_id'=> $request->subcategory_id,
          'subsubcategory_id'=> $request->subsubcategory_id,
          'product_name_en'=> $request->product_name_en,
          'product_name_gr'=> $request->product_name_gr,
          'product_slug_en'=> strtolower(str_replace(' ', '-',$request->product_name_en)),
          'product_slug_gr'=> strtolower(str_replace(' ', '-',$request->product_name_gr)),
          'product_code'=> $request->product_code,
          'product_qty'=> $request->product_qty,
          'product_tags_en'=> $request->product_tags_en,
          'product_tags_gr'=> $request->product_tags_gr,
          'product_size_en'=> $request->product_size_en,
          'product_size_gr'=> $request->product_size_gr,
          'product_color_en'=> $request->product_color_en,
          'product_color_gr'=> $request->product_color_gr,
          'selling_price'=> $request->selling_price,
          'discount_price'=> $request->discount_price,
          'short_descp_en'=> $request->short_descp_en,
          'short_descp_gr'=> $request->short_descp_gr,
          'long_descp_en'=> $request->long_descp_en,
          'long_descp_gr'=> $request->long_descp_gr,
          'product_thambnail'=> $save_url,
          'hot_deals'=> $request->hot_deals,
          'featured'=> $request->featured,
          'special_offer'=> $request->special_offer,
          'special_deals'=> $request->special_deals,
          'status'=> 1,
          'created_at' => Carbon::now(),
     ]);

     //multiple image upload

     $images = $request->file('multi_img');
     foreach($images as $img){
          $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
          Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
          $uploadPath = 'upload/products/multi-image/'.$make_name;

          MultiImg::insert([
               'product_id' => $product_id,
               'photo_name' => $uploadPath,
               'created_at' => Carbon::now(),

          ]);
     }

     $notification = array(
          'message' => 'Product Added Successfully',
          'alert-type' => 'success'
     );

          return redirect()->route('manage.product')->with($notification);
   }
   public function manageproduct(){
     $products = Product::latest()->get();
     return view('backend.product.product_view',compact('products'));
   }
   public function editproduct($id){
     $multiImgs = MultiImg::where('product_id',$id)->get();
     $categories = Category::latest()->get();
     $subcategories = SubCategory::latest()->get();
     $subsubcategories = SubSubCategory::latest()->get();
     $brands = Brand::latest()->get();
     $products = Product::findOrFail($id);

     return view('backend.product.product_edit',compact('categories','subcategories','subsubcategories','products','brands','multiImgs'));
   }
   public function productupdate(Request $request){
     $products_id = $request->id;
      Product::findOrFail($products_id)->update([
          'brand_id' => $request->brand_id,
          'category_id'=> $request->category_id,
          'subcategory_id'=> $request->subcategory_id,
          'subsubcategory_id'=> $request->subsubcategory_id,
          'product_name_en'=> $request->product_name_en,
          'product_name_gr'=> $request->product_name_gr,
          'product_slug_en'=> strtolower(str_replace(' ', '-',$request->product_name_en)),
          'product_slug_gr'=> strtolower(str_replace(' ', '-',$request->product_name_gr)),
          'product_code'=> $request->product_code,
          'product_qty'=> $request->product_qty,
          'product_tags_en'=> $request->product_tags_en,
          'product_tags_gr'=> $request->product_tags_gr,
          'product_size_en'=> $request->product_size_en,
          'product_size_gr'=> $request->product_size_gr,
          'product_color_en'=> $request->product_color_en,
          'product_color_gr'=> $request->product_color_gr,
          'selling_price'=> $request->selling_price,
          'discount_price'=> $request->discount_price,
          'short_descp_en'=> $request->short_descp_en,
          'short_descp_gr'=> $request->short_descp_gr,
          'long_descp_en'=> $request->long_descp_en,
          'long_descp_gr'=> $request->long_descp_gr,
          //'product_thambnail'=> $save_url,
          'hot_deals'=> $request->hot_deals,
          'featured'=> $request->featured,
          'special_offer'=> $request->special_offer,
          'special_deals'=> $request->special_deals,
          'status'=> 1,
          'created_at' => Carbon::now(),
     ]);
     $notification = array(
          'message' => 'Product Updated Successfully',
          'alert-type' => 'success'
     );

          return redirect()->route('manage.product')->with($notification);
   }

   public function multiImageUpdate(Request $request){

     $images = $request->multi_img;

     foreach($images as $id => $img){
         // dd($id, $img);
          $imgDelete = MultiImg::findOrFail($id);
          unlink($imgDelete->photo_name);

          $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
          Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
          $uploadPath = 'upload/products/multi-image/'.$make_name;
          MultiImg::where('id', $id)->update([
               'photo_name' => $uploadPath,
               'updated_at' => Carbon::now(),
          ]);

     } //end foreach
     $notification = array(
          'message' => 'Product Images Updated Successfully',
          'alert-type' => 'info'
     );

     return redirect()->back()->with($notification);

   }

   public function thambnailImageUpdate(Request $request){

     $old_img = $request->old_img;
     $pro_id = $request->id;

     unlink($old_img);

     $image = $request->file('product_thambnail');
     $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
     Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
     $save_url = 'upload/products/thambnail/'.$name_gen;

     Product::findOrFail($pro_id)->update([
          'product_thambnail' => $save_url,
          'updated_at' => Carbon::now(),

     ]);

     $notification = array(
          'message' => ' Images ThambNail Updated Successfully',
          'alert-type' => 'info'
     );

     return redirect()->back()->with($notification);

   }

   public function productmultidelete($id){

     $img = MultiImg::findOrFail($id);
     unlink($img->photo_name);
     MultiImg::findOrFail($id)->delete();

     $notification = array(
          'message'=>'Image deleted successfully',
          'alert-type'=>'info',
     );
     return redirect()->back()->with($notification);
   }

   public function productinactive($id){
     Product::findOrFail($id)->update(['status'=>0,]);
     $notification = array(
          'message'=>'Product Inactive',
          'alert-type'=>'info',
     );
     return redirect()->back()->with($notification);
   }

   public function productactive($id){
     Product::findOrFail($id)->update(['status'=>1,]);
     $notification = array(
          'message'=>'Product Active',
          'alert-type'=>'info',
     );
     return redirect()->back()->with($notification);
   }

   public function productdelete($id){

     $product = Product::findOrFail($id);
     unlink($product->product_thambnail);
     Product::findOrFail($id)->delete();
     
     $images = MultiImg::where('product_id',$id)->get();
     foreach($images as $img){
          unlink($img->photo_name);
          MultiImg::where('product_id',$id)->delete();
     }

     $notification = array(
          'message'=>'Product Deleted Successfully',
          'alert-type'=>'success',
     );
     return redirect()->back()->with($notification);

   }

}
