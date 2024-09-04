<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('tutor');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('municipio');
            $table->string('paquete');
            $table->decimal('costo_paquete', 8, 2);
            $table->string('nombre_alumno');
            $table->string('grado');
            $table->string('grupo');
            $table->string('firma_cliente')->nullable(); // Campo para la imagen de la firma del cliente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
};
