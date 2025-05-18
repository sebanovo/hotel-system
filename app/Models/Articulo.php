<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $fillable = [
        'nombre',
    ];

    public function detalle_habitacions()
    {
        return $this->hasMany(DetalleHabitacion::class, 'articulo_id');
    }
}
