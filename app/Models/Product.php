<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'product_name_en',
        'product_name_gr',
        'product_slug_en',
        'product_slug_gr',
        'product_code',
        'product_qty',
        'product_tags_en',
        'product_tags_gr',
        'product_size_en',
        'product_size_gr',
        'product_color_en',
        'product_color_gr',
        'selling_price',
        'discount_price',
        'short_descp_en',
        'short_descp_gr',
        'long_descp_en',
        'long_descp_gr',
        'product_thambnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status',
    ];
}
