<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
       'fecha_inicio',
       'fecha_salida',
       'estado_id',
       'user_cliente_id',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cliente_users()
    {
        return $this->belongsTo(User::class, 'user_cliente_id');
    }

    public function nota_ventas()
    {
        return $this->hasMany(NotaVenta::class, 'reserva_id');
    }

    public function detalle_reservas()
    {
        return $this->hasMany(DetalleReserva::class, 'reserva_id');
    }

}
