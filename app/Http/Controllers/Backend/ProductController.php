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

class ProductController extends Controller
{
    //
   public function addproduct(){

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add',compact('categories','brands'));

   }
}
