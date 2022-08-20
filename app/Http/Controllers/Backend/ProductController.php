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
     $categories = Category::latest()->get();
     $subcategories = SubCategory::latest()->get();
     $subsubcategories = SubSubCategory::latest()->get();
     $brands = Brand::latest()->get();
     $products = Product::findOrFail($id);

     return view('backend.product.product_edit',compact('categories','subcategories','subsubcategories','products','brands'));
   }
   public function productupdate(Request $request){
     $products_id = $request->id;
     $product_id = Product::findOrFail($product_id)->update([
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
     $notification = array(
          'message' => 'Product Updated Successfully',
          'alert-type' => 'success'
     );

          return redirect()->route('manage.product')->with($notification);
   }
}
