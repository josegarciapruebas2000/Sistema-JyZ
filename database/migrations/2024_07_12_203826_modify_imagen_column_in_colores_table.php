<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyImagenColumnInColoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Cambiar el tipo de la columna 'imagen' a LONGBLOB
        DB::statement('ALTER TABLE colores MODIFY COLUMN imagen LONGBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertir el cambio a BLOB (o a cualquier tipo de datos anterior)
        DB::statement('ALTER TABLE colores MODIFY COLUMN imagen BLOB');
    }
}
