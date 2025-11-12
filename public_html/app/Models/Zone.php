<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'name',
        'ban_estado',
        'user_gra',
        'user_mod',
    ];

    // Relación con la bodega
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
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
