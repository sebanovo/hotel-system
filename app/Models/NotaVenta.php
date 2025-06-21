<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;

    protected $table = 'nota_ventas';

    protected $fillable = [
        'fecha',
        'monto_total',
        'tipo_pago_id',
        'reserva_id',
        'user_cliente_id',
        'user_empleado_id',
    ];

    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class, 'tipo_pago_id');
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_cliente_id');
    }

    public function empleado_users()
    {
        return $this->belongsTo(User::class, 'user_empleado_id');
    }

    public function detalle_servicios()
    {
        return $this->hasMany(DetalleServicio::class, 'nota_venta_id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function detalle_venta()
    {
        return $this->hasMany(DetalleVenta::class, 'nota_venta_id');
    }
}
