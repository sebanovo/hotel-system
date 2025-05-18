<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitacions';

    protected $fillable = [
        'nro',
        'capacidad',
        'precio',
        'url_foto',
        'piso_id',
        'tipo_habitacion_id',
        'estado_id',
    ];

    public function piso()
    {
        return $this->belongsTo(Piso::class, 'piso_id');
    }

    public function tipo_habitacion()
    {
        return $this->belongsTo(TipoHabitacion::class, 'tipo_habitacion_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function detalle_ventas()
    {
        return $this->hasMany(DetalleVenta::class, 'habitacion_id');
    }

    public function detalle_habitacion()
    {
        return $this->hasMany(DetalleHabitacion::class, 'habitacion_id');
    }

    public function detalle_reservas()
    {
        return $this->hasMany(DetalleReserva::class, 'habitacion_id');
    }
}
