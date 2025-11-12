<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'document_type_code',
        'warehouse_id',
        'ban_estado',
        'user_gra',
        'user_mod',
    ];

    // Relación con la bodega
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Relación con el tipo de documento (desde warehouse_movements)
    public function documentType()
    {
        return $this->belongsTo(WarehouseMovement::class, 'document_type_code', 'document_type_code')
                    ->whereColumn('warehouse_id', 'warehouse_id');
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
