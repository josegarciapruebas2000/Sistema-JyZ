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
        Schema::table('escuelas', function (Blueprint $table) {
            // Agregar la columna 'turno' después de 'fecha_entrega'
            $table->string('turno')->after('ubicacion_entrega');
            $table->integer('status')->after('turno')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escuelas', function (Blueprint $table) {
            // Revertir la adición de la columna 'turno'
            $table->dropColumn('turno');
        });
    }
};
