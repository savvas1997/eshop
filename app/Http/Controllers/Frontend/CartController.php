<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;

use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    //
    public function addtocart(Request $request, $id){
        
        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        //dd($request->selling_price)

        if($product->discount_price == NULL){
            Cart::add([
                'id'=>$id,
                'name'=>$request->product_name,
                'qty'=>$request->quantity,
                'price'=>$product->selling_price,
                'weight'=>1,
                'options'=>[
                    'image' => $product->product_thambnail, 
                    'color' => $request->color,
                    'size' => $request->size,
                ],


            ]);
            return response()->json(['success' => 'Successfully Added on Your cart']);
        }
        else{
            Cart::add([
                'id'=>$id,
                'name'=>$request->product_name,
                'qty'=>$request->quantity,
                'price'=>$product->discount_price,
                'weight'=>1,
                'options'=>[
                    'image' => $product->product_thambnail, 
                    'color' => $request->color,
                    'size' => $request->size,
                ],
                

            ]);
            return response()->json(['success' => 'Successfully Added on Your cart']);

        }

    }

    public function addminicart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' =>$carts,
            'cartQty'=>$cartQty,
            'cartTotal'=>$cartTotal,
        ));


    }

    public function removeminicart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart']);

    }

    public function AddToWishlist(Request $request, $product_id){

    
        if (Auth::check()) {
           // dd(1);
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if(!$exists)
            {
                Wishlist::insert([
                    'user_id' => Auth::id(), 
                    'product_id' => $product_id, 
                    'created_at' => Carbon::now(), 
                ]);
            return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            }
            else{
                return response()->json(['error' => 'This Product is already onyour wishlist']);
            }
        }else{

            return response()->json(['error' => 'At First Login Your Account']);

        }

    } // end method 

    //coupon
    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if($coupon){
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' =>  round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
                // 'coupon_name' => $coupon->coupon_name,

            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Apply Successfully',
            ));
        }
        else{
            return response()->json(['error'=>'Invalid Coupon']);
        }



    }

    public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));

        }
    } // end method 


 // Remove Coupon 
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }


    public function checkoutcreate(){

        if(Auth::check()){
            if(Cart::total() > 0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name','ASC')->get();
                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));
            }
            else{
                $notification = array(
                    'message' => 'Add Product first',
                    'alert-type'=> 'error'
                );
                return redirect()->to('/')->with($notification);
            }

        }
        else{

            $notification = array(
                'message' => 'Log in before purshace',
                'alert-type'=> 'error'
            );
            return redirect()->route('login')->with($notification);
        }

    }


}
