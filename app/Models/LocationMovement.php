<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'document_type_code',
        'product_id',
        'warehouse_id',
        'zone_id',
        'shelf',
        'column',
        'level',
        'quantity',
        'month_year',
        'operation_date',
        'created_by',
        'modified_by',
        'user_gra',
        'user_mod'
    ];

    public $timestamps = true;

    // Relación con DocumentDetail
    public function documentDetail()
    {
        return $this->belongsTo(DocumentDetail::class, ['document_id', 'document_type_code', 'product_id'], ['document_id', 'document_type_code', 'product_id']);
    }

    // Relación con Location
    public function location()
    {
        return $this->belongsTo(Location::class, ['warehouse_id', 'zone_id', 'shelf', 'column', 'level'], ['warehouse_id', 'zone_id', 'shelf', 'column', 'level']);
    }

    // Relación con User (bitácora)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}
