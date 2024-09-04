<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifyImagenColumnInModeloFotosGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Cambiar el tipo de la columna 'imagen' a LONGBLOB
        DB::statement('ALTER TABLE modelo_fotos_grupo MODIFY COLUMN imagen LONGBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertir el cambio a BLOB (o a cualquier tipo de datos anterior)
        DB::statement('ALTER TABLE modelo_fotos_grupo MODIFY COLUMN imagen BLOB');
    }
}
