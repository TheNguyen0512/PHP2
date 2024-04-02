<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    protected $table = 'order_detail';
    protected $primaryKey = 'ordd_id';
    protected $fillable = ['ordd_id ','ordd_orders_id','ordd_product_name', 'ordd_product_price','ordd_quantity','ordd_product_id'];

    public function order(){
        return $this->belongsTo(Orders::class, 'ord_id');
    }

    public $timestamps = true;
}
