<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Carbon\Carbon;
use DateTime;
use App\Models\Order;


class ReportController extends Controller
{
    //
    public function reportview(){

        return view('backend.report.report_view');
    }

    public function searchbydate(Request $request){
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        //return $formatDate;
        $orders= Order::where('order_date',$formatDate)->latest()->get();

        return view('backend.report.report_show',compact('orders'));

    }

   

    public function ReportByMonth(Request $request){

        $orders = Order::where('order_year',$request->year_name)->where('order_month',$request->month)->latest()->get();
        //dd($request->month);
        return view('backend.report.report_show',compact('orders'));
 
    }

    public function ReportByYear(Request $request){

        $orders = Order::where('order_year',$request->year)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
 
    } // end mehtod 
}
