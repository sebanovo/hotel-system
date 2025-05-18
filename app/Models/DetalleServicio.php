<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleServicio extends Model
{
    use HasFactory;

    protected $table = 'detalle_servicios';

    protected $fillable = [
        'precio_v',
        'cantidad',
        'servicio_id',
        'nota_venta_id',
    ];

    public function servicios()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function nota_ventas()
    {
        return $this->belongsTo(NotaVenta::class, 'nota_venta_id');
    }

}
