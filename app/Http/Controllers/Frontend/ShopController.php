<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
// use App\Models\Slider;
use App\Models\Product;
// use App\Models\MultiImg;
use App\Models\Brand;


class ShopController extends Controller
{
    //
    public function shoppage(){
        $products = Product::query();
        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);
            $catIds = Category::select('id')->whereIn('category_slug_en',$slugs)->pluck('id')->toArray();
            $products = $products->whereIn('category_id',$catIds)->paginate(3);
        }
        
        if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('brand_slug_en',$slugs)->pluck('id')->toArray();
           // dd($brandIds);
            $products = $products->where('brand_id',$brandIds)->paginate(3);
            //dd($products);
        }
        else{
             $products = Product::where('status',1)->orderBy('id','DESC')->paginate(3);
        }

        
        //$products = Product::where('status',1)->orderBy('id','DESC')->paginate(6);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $brands = Brand::orderBy('brand_name_en','ASC')->get();

        return view('frontend.shop.shop_page',compact('products','categories','brands'));

    }
    public function ShopFilter(Request $request){
       // dd($request->all());
        $data = $request->all();
        
        //filter category
        $catUrl = "";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
            if(empty($catUrl)){
               // dd(1);
                $catUrl .= '&category='.$category;
            }
            else{
                $catUrl .=  ','.$category;
            }
            
                                                }
        }

        //Brand filter
        $brandUrl = "";
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
            if(empty($brandUrl)){
               // dd(1);
                $brandUrl .= '&brand='.$brand;
            }
            else{
                $brandUrl .=  ','.$brand;
            }
            
                                                }
        }

        return redirect()->route('shop.page',$catUrl.$brandUrl);
    }
    
}
