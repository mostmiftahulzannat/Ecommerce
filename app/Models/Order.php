<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    function billing()
    {
        return $this->hasOne(Billing::class,'id','billing_id');
    }
    function orderdetails()
    {
        return $this->hasMany(OrderDetails::class, 'id','order_id');
    }
}
