<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $table = 'tipo_pagos';

    protected $fillable = [
        'nombre',
    ];

    public function nota_ventas()
    {
        return $this->hasMany(NotaVenta::class, 'tipo_pago_id');
    }
}
