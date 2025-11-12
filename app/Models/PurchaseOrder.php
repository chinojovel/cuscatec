<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'order_date',
        'status',
        'total_quantity',
        'received_quantity',
        'remarks',
        'order_number',
        'total_amount'
    ];

    
    /**
     * Relación con el modelo `Supplier`.
     * Una orden de compra pertenece a un proveedor.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relación con el modelo `PurchaseOrderItem`.
     * Una orden de compra puede tener muchos productos asociados.
     */
    public function items()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }


   
}
