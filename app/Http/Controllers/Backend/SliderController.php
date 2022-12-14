<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use App\Models\Slider;

class SliderController extends Controller
{
    // 
    public function sliderview(){

        $sliders = Slider::latest()->get();

        return view('backend.slider.slider_view',compact('sliders'));
    }

    public function sliderstore(Request $request){

        $request->validate([
            
            'slider_img' => 'required',
        ],[
           
            'slider_img.required' => 'INPUT Slider Image',
        ]);

        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;

        Slider::insert([
            'title_en' => $request->title_en,
            'title_gr' => $request->title_gr,
            'description' => $request->description,
            'slider_img' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editslider($id){

        $sliders = Slider::findOrFail($id);

        return view('backend.slider.slider_edit',compact('sliders'));

    }
    public function sliderupdate(Request $request){
        $sldier_id = $request->id;
        $old = $request->old_image;

        if($request->file('slider_img')){
            unlink($old);
            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;

            Slider::findOrFail($sldier_id)->update([
                'title_en' => $request->title_en,
                'title_gr' => $request->title_gr,
                'description' => $request->description,
                'slider_img' => $save_url,

            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('manage.slider')->with($notification);
        }
        else{
            Slider::findOrFail($sldier_id)->update([
                'title_en' => $request->title_en,
                'title_gr' => $request->title_gr,
                'description' => $request->description,

            ]);
            $notification = array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('manage.slider')->with($notification);
        }

    }

    public function deleteslider($id){
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        unlink($img);
        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function sliderinactive($id){
        Slider::findOrFail($id)->update(['status'=>0,]);
        $notification = array(
            'message' => 'Slider Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function slidertactive($id){
        Slider::findOrFail($id)->update(['status'=>1,]);

        $notification = array(
            'message' => 'Slider Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
