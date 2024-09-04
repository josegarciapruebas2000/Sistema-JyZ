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
            // Eliminar las columnas paquete y costo_paquete
            $table->dropColumn('paquete');
            $table->dropColumn('costo_paquete');

            // Mover el atributo turno debajo de grupo
            $table->string('turno')->after('grupo')->nullable();

            // Agregar la nueva columna id_paquete
            $table->unsignedBigInteger('id_paquete')->nullable();

            // Definir la clave foránea para id_paquete
            $table->foreign('id_paquete')->references('id')->on('paquetes')->onDelete('set null');
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
            // Revertir los cambios en caso de hacer un rollback
            $table->string('paquete');
            $table->decimal('costo_paquete', 8, 2);
            $table->dropForeign(['id_paquete']);
            $table->dropColumn('id_paquete');

            // Mover el atributo turno de nuevo al final
            $table->dropColumn('turno');
        });
    }
};
