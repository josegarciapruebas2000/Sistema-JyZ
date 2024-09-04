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
        Schema::table('alumnos', function (Blueprint $table) {
            // Agregar la columna id_modelo
            $table->unsignedBigInteger('id_modelo')->nullable();
            
            // Definir la clave foránea para id_modelo
            $table->foreign('id_modelo')->references('id')->on('modelos')->onDelete('set null');

            // Agregar la columna id_color
            $table->unsignedBigInteger('id_color')->nullable();
            
            // Definir la clave foránea para id_color
            $table->foreign('id_color')->references('id')->on('colores')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            //
        });
    }
};
