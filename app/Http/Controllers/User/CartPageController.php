<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;
use App\Models\Coupon;

use Illuminate\Support\Facades\Session;


class CartPageController extends Controller
{
    //
    public function mycart(){

        return view('frontend.wishlist.view_mycart');
    }

    public function getcartproduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' =>$carts,
            'cartQty'=>$cartQty,
            'cartTotal'=>$cartTotal,
        ));

    }
    public function cartremove($rowId){

        Cart::remove($rowId);
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        return response()->json(['success'=>'the item removed from cart']);

    }

    public function cartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty+1);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' =>  round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
                // 'coupon_name' => $coupon->coupon_name,

            ]);
        }


        return response()->json('increment');

    }
    public function cartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty-1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' =>  round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
                // 'coupon_name' => $coupon->coupon_name,

            ]);
        }

        return response()->json('increment');

    }
    

}
