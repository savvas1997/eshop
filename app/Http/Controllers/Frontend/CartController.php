<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;

class CartController extends Controller
{
    //
    public function addtocart(Request $request, $id){
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

}
