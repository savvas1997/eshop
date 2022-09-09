<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReturnController extends Controller
{
    //
    public function returnrequest(){

        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();

        return view('backend.return_order.return_request',compact('orders'));
    }
    public function returnrequestapprove($id){
        Order::where('id',$id)->update([
            'return_order' => 2,
        ]);

        $notification = array(
            'message' => 'Return Order Approved',
            'alert-type' => 'success',
        );

        return  redirect()->back()->with($notification);

    }
    public function returnallrequest(){
        $orders = Order::where('return_order',2)->orderBy('id','Desc')->get();
        return view('backend.return_order.all_return_request',compact('orders'));
    }
}
