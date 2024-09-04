<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyImagenColumnInPaquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Cambiar el tipo de la columna 'imagen' a LONGBLOB
        DB::statement('ALTER TABLE paquetes MODIFY COLUMN imagen LONGBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertir el cambio a BLOB (o a cualquier tipo de datos anterior)
        DB::statement('ALTER TABLE paquetes MODIFY COLUMN imagen BLOB');
    }
}
