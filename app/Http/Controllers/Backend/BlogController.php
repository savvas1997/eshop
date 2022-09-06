<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use App\Models\Blog\BlogPost;
use Image;


class BlogController extends Controller
{
    //
    public function blogcategory(){
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view',compact('blogcategory'));

    }

    public function blogcategorystore(Request $request){

        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_gr' => 'required',
        ],[
            'blog_category_name_en.required' => 'INPUT Category English Name',
            'blog_category_name_gr.required' => 'INPUT Category Greek Name',
        ]);

        
        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_gr' => $request->blog_category_name_gr,
            'blog_category_slug_en' => strtolower(str_replace(' ','-',$request->blog_category_name_en)),
            'blog_category_slug_gr' => strtolower(str_replace(' ','-',$request->blog_category_name_gr)),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'BlogCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }


    public function blogcategoryedit($id){
        $blogcategory = BlogPostCategory::findOrfail($id);

        return view('backend.blog.category.category_edit',compact('blogcategory'));
    }
    public function blogcategoryupdate(Request $request){

        $catblog_id = $request->id;

        BlogPostCategory::findOrFail($catblog_id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_gr' => $request->blog_category_name_gr,
            'blog_category_slug_en' => strtolower(str_replace(' ','-',$request->blog_category_name_en)),
            'blog_category_slug_gr' => strtolower(str_replace(' ','-',$request->blog_category_name_gr)),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category')->with($notification);
    }

    public function blogcategorydelete($id){
        BlogPostCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // blog post methods

    public function viewblogpost(){
        $blogpost = BlogPost::with('blogpostcategory')->latest()->get();
       

        return view('backend.blog.post.post_view',compact('blogpost'));
    }

    public function addblogpost(){
        $blogpost = BlogPost::latest()->get();
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.post.post_add',compact('blogpost','blogcategory'));

    }

    public function blogpoststore(Request $request){

        
        $request->validate([
            'title_en' => 'required',
            'title_gr' => 'required',
            'details_en' => 'required',
            'details_gr' => 'required',
            'category_id' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(780,433)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;

        BlogPost::insert([
            'title_en' => $request->title_en,
            'title_gr' => $request->title_gr,
            'details_en' => $request->details_en,
            'details_gr' => $request->details_gr,
            'category_id' => $request->category_id,
            'slug_en' => strtolower(str_replace(' ','-',$request->title_en)),
            'slug_gr' => strtolower(str_replace(' ','-',$request->title_gr)),
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('view.post')->with($notification);



    }

    public function blogpostedit($id){

        $blogpost = BlogPost::findOrFail($id);
        $blogcategory = BlogPostCategory::latest()->get();

        return view('backend.blog.post.post_edit',compact('blogpost','blogcategory'));

    }

     
    public function blogpostupdate(Request $request){
          
        $request->validate([
            'title_en' => 'required',
            'title_gr' => 'required',
            'details_en' => 'required',
            'details_gr' => 'required',
            'category_id' => 'required',
            
        ]);
      //dd($request->id);
        BlogPost::findOrFail($request->id)->update([
            'title_en' => $request->title_en,
            'title_gr' => $request->title_gr,
            'details_en' => $request->details_en,
            'details_gr' => $request->details_gr,
            'category_id' => $request->category_id,
            'slug_en' => strtolower(str_replace(' ','-',$request->title_en)),
            'slug_gr' => strtolower(str_replace(' ','-',$request->title_gr)),
            
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('view.post')->with($notification);


    }

    public function blogpostimageupdate(Request $request){
        $old_img = $request->old_img;
        $pro_id = $request->id;
   
        unlink($old_img);
   
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(740,433)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;
   
        BlogPost::findOrFail($pro_id)->update([
             'image' => $save_url,
             'updated_at' => Carbon::now(),
   
        ]);
   
        $notification = array(
             'message' => ' Images Post Updated Successfully',
             'alert-type' => 'info'
        );
   
        return redirect()->back()->with($notification);
    }
    

    public function blogpostdelete($id){
        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

   
   

}
