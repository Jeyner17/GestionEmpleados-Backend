<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_empleado', 10)->unique();
            
            // Datos Personales
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('cedula', 20)->unique();
            $table->foreignId('provincia_id')->nullable()->constrained('provincias')->onDelete('set null');
            $table->date('fecha_nacimiento');
            $table->string('email', 150)->unique();
            $table->text('observaciones_personales')->nullable();
            $table->string('fotografia', 255)->nullable();
            
            // Datos Laborales
            $table->date('fecha_ingreso');
            $table->string('cargo', 100);
            $table->string('departamento', 100);
            $table->foreignId('provincia_laboral_id')->nullable()->constrained('provincias')->onDelete('set null');
            $table->decimal('sueldo', 10, 2);
            $table->boolean('jornada_parcial')->default(false);
            $table->text('observaciones_laborales')->nullable();
            
            // Estado
            $table->enum('estado', ['VIGENTE', 'RETIRADO'])->default('VIGENTE');
            
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};