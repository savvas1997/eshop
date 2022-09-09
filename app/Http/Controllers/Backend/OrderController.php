<?php

namespace App\Http\Controllers\Backend;

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
use DB;
use App\Models\Product;


class OrderController extends Controller
{ 
    //
    public function pendingorders(){

        $orders = Order::where('status','Pending')->orderBy('id','DESC')->get();

        return view('backend.orders.pending_orders',compact('orders'));



    }

    public function pendingorderdetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $order_item = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders_details',compact('order','order_item'));


    }


    public function confirmedorders(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('backend.orders.confirmed_orders',compact('orders'));


    }

    public function processingorders(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('backend.orders.processing_orders',compact('orders'));
    }

    
    public function pickedorders(){
        $orders = Order::where('status','picked')->orderBy('id','DESC')->get();
        return view('backend.orders.picked_orders',compact('orders'));
    }

    public function shippedorders(){
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
        return view('backend.orders.shipped_orders',compact('orders'));
    }

    public function deliveredorders(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('backend.orders.delivered_orders',compact('orders'));
    }
    
    public function cancelorders(){
        $orders = Order::where('status','cancel')->orderBy('id','DESC')->get();
        return view('backend.orders.cancel_orders',compact('orders'));
    }

    public function pendingToconfirm($id){

        Order::findOrFail($id)->update([
            'status'=>'confirm',

        ]);

        $notification = array(
            'message' => 'Updated to Confirm Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.orders')->with($notification);
    }

    public function confirmToProcessing($id){

        Order::findOrFail($id)->update([
            'status'=>'processing',

        ]);

        $notification = array(
            'message' => 'Updated to Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.orders')->with($notification);

    }

    
    public function processingToPicked($id){

        Order::findOrFail($id)->update([
            'status'=>'picked',

        ]);

        $notification = array(
            'message' => 'Updated to Picked Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('processing.order')->with($notification);

    }

    public function pickedToshipped($id){

        Order::findOrFail($id)->update([
            'status'=>'shipped',

        ]);

        $notification = array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('picked.order')->with($notification);

    }
    
    
    public function shippedToDelivered($id){

        $product = OrderItem::where('order_id',$id)->get();
            foreach ($product as $item) {
                Product::where('id',$item->product_id)
                        ->update(['product_qty' => DB::raw('product_qty-'.$item->qty)]);
            } 

        Order::findOrFail($id)->update([
            'status'=>'delivered',

        ]);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('shipped.order')->with($notification);

    }

    
    public function invoicedownload($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        
        $order_item = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
      
        $pdf = PDF::loadView('backend.orders.order_invoice',compact('order','order_item'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
         ]);
         return $pdf->download('invoice.pdf');
         //return view('frontend.user.order.order_invoice',compact('order','order_item'));

    }

}
