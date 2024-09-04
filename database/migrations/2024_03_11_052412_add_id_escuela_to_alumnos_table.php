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
            // Agrega la columna id_escuela
            $table->unsignedBigInteger('id_escuela')->nullable();

            // Agrega la restricción de clave foránea
            $table->foreign('id_escuela')->references('id')->on('escuelas');
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
            // Elimina la restricción de clave foránea
            $table->dropForeign(['id_escuela']);

            // Elimina la columna id_escuela
            $table->dropColumn('id_escuela');
        });
    }
};
