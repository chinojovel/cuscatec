<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'period',
        'product_id',
        'warehouse_id',
        'quantity',
        'user_gra',
        'user_mod',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
