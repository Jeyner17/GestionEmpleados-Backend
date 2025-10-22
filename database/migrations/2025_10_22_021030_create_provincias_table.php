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
        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_provincia', 100);
            $table->string('capital_provincia', 100);
            $table->text('descripcion_provincia')->nullable();
            $table->decimal('poblacion_provincia', 10, 2)->nullable();
            $table->decimal('superficie_provincia', 10, 2)->nullable();
            $table->string('latitud_provincia', 20)->nullable();
            $table->string('longitud_provincia', 20)->nullable();
            $table->integer('id_region')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provincias');
    }
};