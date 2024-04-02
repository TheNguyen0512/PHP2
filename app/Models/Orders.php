<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $primaryKey = 'ord_id';
    protected $fillable = ['ord_id ','ord_user_name','ord_Dob', 'ord_address','ord_phone_no','ord_pay_status','ord_payment','ord_status','ord_note','ord_promotion','ord_total_original','ord_ship','ord_total'];

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class, 'ordd_id');
    }

    public $timestamps = true;
}
