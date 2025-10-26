<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empleados';

    protected $fillable = [
        'codigo_empleado',
        'nombres',
        'apellidos',
        'cedula',
        'provincia_id',
        'fecha_nacimiento',
        'email',
        'observaciones_personales',
        'fotografia',
        'fecha_ingreso',
        'cargo',
        'departamento',
        'provincia_laboral_id',
        'sueldo',
        'jornada_parcial',
        'observaciones_laborales',
        'estado',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'sueldo' => 'decimal:2',
        'jornada_parcial' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function provinciaResidencia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function provinciaLaboral()
    {
        return $this->belongsTo(Provincia::class, 'provincia_laboral_id');
    }

    public function scopeVigentes($query)
    {
        return $query->where('estado', 'VIGENTE');
    }


    public function scopeRetirados($query)
    {
        return $query->where('estado', 'RETIRADO');
    }

    public function scopeBuscar($query, $termino)
    {
        return $query->where(function ($q) use ($termino) {
            $q->where('nombres', 'LIKE', "%{$termino}%")
              ->orWhere('apellidos', 'LIKE', "%{$termino}%")
              ->orWhere('codigo_empleado', 'LIKE', "%{$termino}%");
        });
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }

    public static function generarCodigoEmpleado()
    {
        do {
            $codigo = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (self::where('codigo_empleado', $codigo)->exists());

        return $codigo;
    }
}