<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'state_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'customer_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
