<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'zone_id',
        'shelf',
        'column',
        'level',
        'quantity',
        'location_type',
        'ban_estado',
        'user_gra',
        'user_mod',
    ];

    // Relación con el producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con la bodega
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Relación con la zona
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    // Relación con el usuario que creó el registro
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_gra');
    }

    // Relación con el usuario que modificó el registro
    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'user_mod');
    }
}
