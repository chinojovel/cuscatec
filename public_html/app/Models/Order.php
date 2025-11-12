<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'customer_id',
        'user_id',
        'total_price',
        'order_date',
        'correlative',
        'payment_status',
        'coupon_code',
        'coupon_type',
        'discount_amount',
        'type',
        'total',
        'tracking_number',
        'tracking_status',
        'state_id'
    ];

    protected $dates = ['order_date'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
