<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes; // Agrega SoftDeletes aquí

    protected $fillable = [
        'name',
        'description',
        'stock',
        'image_url',
        'created_by',
        'modified_by',
        'category_id',
        'total_stock'
    ];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    /**
     * Relación con el modelo Category.
     * Un producto pertenece a una categoría.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productStocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

    public function getTotalStockAttribute()
    {
        return $this->productStocks()->sum('quantity');
    }
}
