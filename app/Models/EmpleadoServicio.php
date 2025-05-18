<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoServicio extends Model
{
    use HasFactory;

    protected $table = 'empleado_servicios';

    protected $fillable = [
        'fecha_asignacion',
        'user_id',
        'servicio_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function servicios()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
