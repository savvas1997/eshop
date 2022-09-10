<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;
use Image;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //
    public function alladminrole(){
        $adminuser = Admin::where('type',2)->latest()->get();
        return view('backend.role.admin_role_all',compact('adminuser'));
    }
    public function adadminrole(){
        
        return view('backend.role.admin_role_create');
    }
    public function adminuserstore(Request $request){

       $image = $request->profile_photo_path;
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
       $save_url = 'upload/admin_images/'.$name_gen;

       Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
            'shipping' => $request->shipping,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,
            'type' => 2,
            'profile_photo_path' => $save_url,
            'created_at' => Carbon::now(),      

       ]);
       $notification = array(
        'message' => 'Admin User Created Successfully',
        'alert-type' => 'success',
       );

       return redirect()->route('all.admin.user')->with($notification);
    }

    public function editadminrole($id){
        $adminuser = Admin::findOrFail($id);

        return view('backend.role.admin_role_edit',compact('adminuser'));
    }
 
    public function adminuserupdate(Request $request){

        $iduser = $request->id;
        $old_img = $request->old_image;
        if($request->file('profile_photo_path')){
           // dd($request->old_image);
        unlink($old_img);
       $image = $request->profile_photo_path;
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(225,225)->save('upload/admin_images/'.$name_gen);
       $save_url = 'upload/admin_images/'.$name_gen;
           // dd($save_url);
        Admin::findOrFail($iduser)->update([
             'name' => $request->name,
             'email' => $request->email,
             'phone' => $request->phone,
             'brand' => $request->brand,
             'category' => $request->category,
             'product' => $request->product,
             'slider' => $request->slider,
             'coupons' => $request->coupons,
             'shipping' => $request->shipping,
             'blog' => $request->blog,
             'setting' => $request->setting,
             'returnorder' => $request->returnorder,
             'review' => $request->review,
             'stock' => $request->stock,
             'reports' => $request->reports,
             'alluser' => $request->alluser,
             'adminuserrole' => $request->adminuserrole,
             'type' => 2,
             'profile_photo_path' => $save_url,
             'created_at' => Carbon::now(),      
 
        ]);
        $notification = array(
         'message' => 'Admin User Created Successfully',
         'alert-type' => 'success',
        );
 
        return redirect()->route('all.admin.user')->with($notification);
    }
    else{
        Admin::findOrFail($iduser)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,
            'shipping' => $request->shipping,
            'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,
            'type' => 2,
            'profile_photo_path' => $request->old_image,
            'created_at' => Carbon::now(),      

       ]);
       $notification = array(
        'message' => 'Admin User Created Successfully',
        'alert-type' => 'success',
       );

       return redirect()->route('all.admin.user')->with($notification);
 
    }


    }

    public function deleteadminrole($id){
        Admin::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
