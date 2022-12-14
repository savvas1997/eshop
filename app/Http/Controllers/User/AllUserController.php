<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Auth;
use Carbon\Carbon;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf;



class AllUserController extends Controller
{
    
    public function myorders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_view',compact('orders'));
    }

    public function orderdetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $order_item = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details',compact('order','order_item'));

    }
    public function invoice_download($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        
        $order_item = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        //$pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order','order_item'));
       // return $pdf->download('invoice.pdf');
        $pdf = PDF::loadView('frontend.user.order.order_invoice',compact('order','order_item'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
         ]);
         return $pdf->download('invoice.pdf');
         //return view('frontend.user.order.order_invoice',compact('order','order_item'));

    }

    public function ReturnOrder(Request $request,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
            //'status' =>, 
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);

    }

    public function returnOrderList(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.user.order.return_order_view',compact('orders'));
    }

    public function cancelOrderList(){
        $orders = Order::where('user_id',Auth::id())->where('status','cancel')->orderBy('id','DESC')->get();
        return view('frontend.user.order.cancel_order_view',compact('orders'));
    }
    
     ///////////// Order Traking ///////

     public function OrderTraking(Request $request){

        $invoice = $request->code;

        $track = Order::where('invoice_no',$invoice)->first();

        if ($track) {

            // echo "<pre>";
            // print_r($track);

        return view('frontend.traking.track_order',compact('track'));

        }else{

            $notification = array(
            'message' => 'Invoice Code Is Invalid',
            'alert-type' => 'error'
        );

        return redirect()->route('my.orders')->with($notification);

        }
    } // end mehtod 


}
