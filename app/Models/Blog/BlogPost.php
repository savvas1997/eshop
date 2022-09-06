<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogPostCategory;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title_en',
        'title_gr',
        'slug_en',
        'slug_gr',
        'details_en',
        'details_gr',
        'image',
    ];
    public function blogpostcategory(){
        return $this->belongsTo(BlogPostCategory::class,'category_id','id');
    }
}
