<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;
use App\Models\Product;


class WishlistController extends Controller
{
    //
    public function viewWishlist(){

        return view('frontend.wishlist.viewwishlist');
    }
    public function getwishlist(){
        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);
    }
    public function removewishlistprodut($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully product removed']);
    }
}
