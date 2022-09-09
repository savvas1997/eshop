<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
use Carbon\carbon;

class ReviewController extends Controller
{
    // 
    public function reviewstore(Request $request){
        $product = $request->product_id;
        $request->validate([
            'comment' => 'required',
            'summary' => 'required'
        ]);
        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Review Will Aprove By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function PendingReview(){
        $review = Review::where('status',0)->orderBy('id','DESC')->get();

        return  view('backend.review.pending_review',compact('review'));
    }

    public function allreview(){
        $reviews = Review::where('status',1)->orderBy('id','DESC')->get();

        return view('backend.review.publish_review',compact('reviews'));
    }
    public function ReviewApprove($id){
        Review::where('id',$id)->update([
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'Review Aproved By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function Reviewdelete($id){

        Review::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
