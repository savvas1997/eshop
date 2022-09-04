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

class CashController extends Controller
{
    //
    public function CashOrder(Request $request){

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }
        else{
            $total_amount = round(Cart::total());
        }       

            $order_id = Order::insertGetId([

                'user_id'=> Auth::user()->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'post_code'=>$request->post_code,
                'division_id'=>$request->division_id,
                'district_id'=>$request->district_id,
                'state_id'=>$request->state_id,
                'notes'=>$request->notes,

                'payment_type'=>'Cash On Delivery',
                'payment_method'=>'Cash On Delivery',
                
                'currency'=>'Eur',
                'amount'=>$total_amount,

                'invoice_no'=>'EOS'.mt_rand(10000000,99999999),
                'order_date'=>Carbon::now()->format('d F Y'),
                'order_month'=>Carbon::now()->format('F Y'),
                'order_year'=>Carbon::now()->format('Y'),
                
                
                'created_at'=>Carbon::now(),
                'status'=>'Pending',




            ]);

            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'name'=>$invoice->name,
                'email'=>$invoice->email,
                'amount'=>$total_amount,

            ];

            Mail::to($request->email)->send(new OrderMail($data));



            $carts = Cart::content();
            foreach($carts as $cart){
                OrderItem::insert([
                    'order_id'=>$order_id,
                    'product_id'=>$cart->id,
                    'color'=> $cart->options->color,
                    'size'=> $cart->options->size,
                    'qty'=> $cart->qty,
                    'price'=> $cart->price,
                    'created_at'=> Carbon::now(),

                ]);
            }

            if(Session::has('coupon')){
                Session::forget('coupon');
            }

            Cart::destroy();

            $notification = array(
                'message' => 'Successfully payment',
                'alert-type' => 'success'
           );

           return redirect()->route('dashboard')->with($notification);


    }
}
