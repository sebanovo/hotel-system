<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    use HasFactory;

    protected $table = 'detalle_reservas';

    protected $fillable = [
        'precio_v',
        'cantidad',
        'reserva_id',
        'habitacion_id',
    ];

    public function habitacions()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }

    public function reservas()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

}
