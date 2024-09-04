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
            $table->date('fecha_entrega')->nullable()->after('fin_generacion'); 
            $table->string('ubicacion_entrega')->nullable()->after('fecha_entrega'); 
            $table->date('fecha_sesion')->nullable()->after('fin_generacion');  
            $table->string('ubicacion_sesion')->nullable()->after('fecha_sesion');                      
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
            $table->dropColumn('fecha_entrega');
            $table->dropColumn('fecha_sesion');
        });
    }
};
