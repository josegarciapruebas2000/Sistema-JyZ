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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pago');
            $table->string('metodo');
            $table->decimal('por_pagar', 8, 2)->default(0);
            $table->decimal('anticipo', 8, 2)->default(0);
            $table->decimal('pendiente', 8, 2)->default(0);
            $table->unsignedBigInteger('id_alumno');

            // Definir la clave foránea para id_alumno
            $table->foreign('id_alumno')->references('id')->on('alumnos')->onDelete('cascade');
            
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
        Schema::dropIfExists('pagos');
    }
};
