<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'cate_id';
    protected $fillable = ['cate_id ','cate_name','cate_img', 'cate_parent_id','deleted_at'];

    public function product(){
        return $this->hasMany(Products::class, 'category_id');
    }

    public $timestamps = true;
}
