<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
    ];

    public function empleado_servicios()
    {
        return $this->hasMany(EmpleadoServicio::class, 'servicio_id');
    }

    public function detalle_servicios()
    {
        return $this->hasMany(DetalleServicio::class, 'servicio_id');
    }
}
