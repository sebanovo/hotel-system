<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleHabitacion extends Model
{
    use HasFactory;

    protected $table = 'detalle_habitacions';

    protected $fillable = [
        'articulo_id',
        'habitacion_id',
    ];

    public function habitacions()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }

    public function articulos()
    {
        return $this->belongsTo(Articulo::class, 'articulo_id');
    }

}
