<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincias';

    protected $fillable = [
        'nombre_provincia',
        'capital_provincia',
        'descripcion_provincia',
        'poblacion_provincia',
        'superficie_provincia',
        'latitud_provincia',
        'longitud_provincia',
        'id_region',
    ];

    protected $casts = [
        'poblacion_provincia' => 'decimal:2',
        'superficie_provincia' => 'decimal:2',
    ];

    public function empleadosResidentes()
    {
        return $this->hasMany(Empleado::class, 'provincia_id');
    }

    public function empleadosLaborales()
    {
        return $this->hasMany(Empleado::class, 'provincia_laboral_id');
    }
}