<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'proImg_id';
    protected $fillable= ['proImg_id','proImg_img','proImg_order','product_id'];
    protected $dates = ['created_at', 'updated_at'];
}
