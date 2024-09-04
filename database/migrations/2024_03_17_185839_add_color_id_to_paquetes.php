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
        Schema::table('paquetes', function (Blueprint $table) {
            // Agregar la columna id_color después de id_modelo
            $table->unsignedBigInteger('id_color')->nullable()->after('id_modelo');
            
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
        Schema::table('paquetes', function (Blueprint $table) {
            // Eliminar la columna id_color
            $table->dropForeign(['id_color']);
            $table->dropColumn('id_color');
        });
    }
};
