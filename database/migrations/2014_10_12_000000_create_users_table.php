<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Importar la facade DB
use Illuminate\Support\Facades\Hash; // Importar la facade Hash para encriptar la contraseña

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('role');
            $table->string('telefono');
            $table->string('password');
            $table->integer('status')->nullable();
            $table->string('id_escuela')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Insertar el usuario admin inicial
        DB::table('users')->insert([
            'nombre' => 'José García',
            'role' => 'jyz',
            'telefono' => '9221064114',
            'password' => Hash::make('1234'), // Encriptar la contraseña
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
