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
            $table->boolean('kinder')->default(false);
            $table->boolean('primaria')->default(false);
            $table->boolean('secundaria')->default(false);
            $table->boolean('preparatoria')->default(false);
            $table->boolean('universidad')->default(false);
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
            $table->dropColumn(['kinder', 'primaria', 'secundaria', 'preparatoria', 'universidad']);
        });
    }
};
