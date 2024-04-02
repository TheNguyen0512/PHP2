<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'pro_id';
    protected $fillable= ['pro_id','pro_name','pro_brand','pro_description','pro_price','pro_quantity','pro_status','category_id','pro_img', 'created_at','is_featured'];

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id', 'cate_id');
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id', 'pro_id');
    }
}
