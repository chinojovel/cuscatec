<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseMovement extends Model
{
    use HasFactory;

    protected $primaryKey = ['warehouse_id', 'document_type_code']; // Clave compuesta
    public $incrementing = false; // Deshabilitar incremento automático de ID

    protected $fillable = [
        'warehouse_id',
        'document_type_code',
        'description',
        'operator', //1 entrada -1 salida
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
