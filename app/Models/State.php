<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'abbreviation',
    ];

    // Relación con el modelo Customer
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
