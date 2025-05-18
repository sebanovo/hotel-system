<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_habitacions';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function habitacions()
    {
        return $this->hasMany(Habitacion::class, 'tipo_habitacion_id');
    }
}
