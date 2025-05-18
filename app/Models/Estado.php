<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function habitacions()
    {
        return $this->hasMany(Habitacion::class, 'estado_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'estado_id');
    }
}
