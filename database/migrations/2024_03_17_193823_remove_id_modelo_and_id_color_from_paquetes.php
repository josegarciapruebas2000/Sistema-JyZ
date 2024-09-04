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
            // Eliminar la columna id_modelo
            if (Schema::hasColumn('paquetes', 'id_modelo')) {
                $table->dropForeign(['id_modelo']);
                $table->dropColumn('id_modelo');
            }

            // Eliminar la columna id_color
            if (Schema::hasColumn('paquetes', 'id_color')) {
                $table->dropForeign(['id_color']);
                $table->dropColumn('id_color');
            }
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
            //
        });
    }
};
