<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Brand;

use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index(){ 
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        $fetaured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special_offers = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();
        // return $skip_category->id;
        // die();
        return view('frontend.index',compact('categories','sliders','products','fetaured',
        'hot_deals','special_offers','special_deals','skip_category_0','skip_product_0',
        'skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'));
    }
    public function userlogout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function userprofile(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile',compact('user'));
    }
    public function userprofilestore(Request $request){
        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->profile_photo_path;
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
         
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('dashboard')->with($notification);


    }
    public function changepassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password',compact('user'));

    }
    public function updatepassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',

        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
              $user = User::find(Auth::id());
              $user->password = Hash::make($request->password);
              $user->save();  
              Auth::logout(); 
              return redirect()->route('user.logout');
      
        }
        else{
            return redirect()->back();
        }


    }

    public function productdetails($id,$slug){
        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);

        $color_gr = $product->product_color_gr;
        $product_color_gr = explode(',',$color_gr);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_gr = $product->product_size_gr;
        $product_size_gr = explode(',',$size_gr);

        $multiImages = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();
        return view('frontend.product.product_details',compact('product','multiImages',
        'product_color_en','product_color_gr','product_size_en','product_size_gr','relatedProduct'));
    }

    public function tagwiseproduct($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)
        ->orWhere('product_tags_gr',$tag)->orderBy('id','DESC')->paginate(3);
        // $products = Product::where('status',1)->where('product_tags_en',$tag)
        // ->where('product_tags_gr',$tag)->orderBy('id','DESC')->get();
        //dd($products);
        $categories = Category::orderBy('category_name_en','ASC')->get();

        return view('frontend.tags.tags_view',compact('products','categories'));


    }

    public function subcatwiseproduct($subcat_id, $slug){
        $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
        // $products = Product::where('status',1)->where('product_tags_en',$tag)
        // ->where('product_tags_gr',$tag)->orderBy('id','DESC')->get();
        //dd($products);
        $categories = Category::orderBy('category_name_en','ASC')->get();

        return view('frontend.product.subcategory_view',compact('products','categories'));

    }

    public function subsubcatwiseproduct($subsubcat_id, $slug){
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(3);
        // $products = Product::where('status',1)->where('product_tags_en',$tag)
        // ->where('product_tags_gr',$tag)->orderBy('id','DESC')->get();
        //dd($products);
        $categories = Category::orderBy('category_name_en','ASC')->get();

        return view('frontend.product.sub_subcategory_view',compact('products','categories'));

    }

    public function productviewAjax($id){
        $product = Product::with('category','brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',',$color);
        
        $size = $product->product_size_en;
        $product_size = explode(',',$size);

        return response()->json(array(
            'product'=>$product,
            'color'=>$product_color,
            'size'=>$product_size,

        ));
    }
}
