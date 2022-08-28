<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;

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
        return response()->json(['success'=>'the item removed from cart']);

    }

    public function cartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty+1);
        return response()->json('increment');

    }
    public function cartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty-1);
        return response()->json('increment');

    }
    

}
