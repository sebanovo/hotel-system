<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'precio_v',
        'cantidad',
        'nota_venta_id',
        'habitacion_id',
    ];

    public function nota_ventas()
    {
        return $this->belongsTo(NotaVenta::class, 'nota_venta_id');
    }
    public function habitacions()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }

}
