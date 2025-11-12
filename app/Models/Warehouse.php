<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'state_id',
        'ban_estado',
        'user_gra',
        'user_mod',
    ];

    // Relación con el modelo State
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // Relación con el modelo User (usuario que creó el registro)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_gra');
    }

    // Relación con el modelo User (usuario que modificó el registro)
    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'user_mod');
    }
}
