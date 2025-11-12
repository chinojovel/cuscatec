<?php
// app/Models/TrackingStatusHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'tracking_status', 'user_id', 'changed_at'];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
