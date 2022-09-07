<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use Carbon\Carbon;
use App\Models\Blog\BlogPost;

class HomeBlogController extends Controller
{
    //
    public function blogpost(){
        $blogpost = Blogpost::latest()->get();
        $blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_list',compact('blogpost','blogcategory'));

    }

    public function blogpostdetails($id){
        $blogpost = Blogpost::findOrFail($id);
        $blogcategory = BlogPostCategory::latest()->get();
        return view('frontend.blog.blog_details',compact('blogpost','blogcategory'));
    }

    public function homeblogcatpost($category_id){
        $blogpost = Blogpost::where('category_id',$category_id)->orderBy('id','DESC')->get();
        $blogcategory = BlogPostCategory::latest()->get();


        return view('frontend.blog.blog_cat_list',compact('blogpost','blogcategory'));
    }
}
