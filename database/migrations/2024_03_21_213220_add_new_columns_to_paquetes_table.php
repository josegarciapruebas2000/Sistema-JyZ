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
            $table->integer('incluye_individual')->default(0)->after('nombre');
            $table->decimal('costo_individual_extra', 8, 2)->default(0)->after('incluye_individual');
            $table->integer('incluye_poster')->default(0)->after('costo_individual_extra');
            $table->decimal('costo_poster_extra', 8, 2)->default(0)->after('incluye_poster');
            $table->integer('incluye_sueltas')->default(0)->after('costo_poster_extra');
            $table->decimal('costo_sueltas_extra', 8, 2)->default(0)->after('incluye_sueltas');
            $table->decimal('costo_cartera_extra', 8, 2)->default(0)->after('costo_sueltas_extra'); // cambiar el orden
            $table->integer('incluye_cartera')->default(0)->after('costo_cartera_extra'); // cambiar el orden
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
            $table->dropColumn('incluye_individual');
            $table->dropColumn('costo_individual_extra');
            $table->dropColumn('incluye_poster');
            $table->dropColumn('costo_poster_extra');
            $table->dropColumn('incluye_sueltas');
            $table->dropColumn('costo_sueltas_extra');
            $table->dropColumn('incluye_cartera');
            $table->dropColumn('costo_cartera_extra');
        });
    }
};
