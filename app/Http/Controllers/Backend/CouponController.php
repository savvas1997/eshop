<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{
    //
    public function couponview(){

        $coupons = Coupon::orderBy('id','DESC')->get();

        return view('backend.coupon.coupon_view',compact('coupons'));

    }
    public function couponstore(Request $request){

        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ]);

        
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            //'coupon_validity' => $request->coupon_validity,
            'coupon_validity' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function editcoupon($id){

        $coupons = Coupon::findOrFail($id);

        return view('backend.coupon.coupon_edit',compact('coupons'));

    }
    public function couponupdate(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ]);

        
        Coupon::findOrFail($request->id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            //'coupon_validity' => $request->coupon_validity,
            'coupon_validity' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.coupon')->with($notification);

    }
    public function deletecoupon($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
