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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('costo_paquete', 8, 2);
            $table->unsignedBigInteger('id_modelo');

            // Definir la clave foránea para id_modelo
            $table->foreign('id_modelo')->references('id')->on('modelos')->onDelete('cascade');
            
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
        Schema::table('paquetes', function (Blueprint $table) {
            $table->dropForeign(['id_modelo']);
        });
        Schema::dropIfExists('paquetes');
    }
};
