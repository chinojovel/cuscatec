<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDetail extends Model
{
    use HasFactory;

    public $incrementing = false; // Deshabilitar incremento automático de ID
    protected $primaryKey = ['document_id', 'document_type_code', 'product_id']; // Clave primaria compuesta

    protected $fillable = [
        'document_id',
        'document_type_code',
        'product_id',
        'requested_quantity',
        'dispatched_quantity',
        'ban_estado',
        'user_gra',
        'user_mod',
    ];

    // Relación con el encabezado del documento
    public function documentHeader()
    {
        return $this->belongsTo(DocumentHeader::class, ['document_id', 'document_type_code'], ['id', 'document_type_code']);
    }

    // Relación con el producto
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
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
