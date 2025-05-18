<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    protected $table = 'pisos';

    protected $fillable = [
        'numero',
    ];

    public function habitacions()
    {
        return $this->hasMany(Habitacion::class, 'piso_id');
    }
}
