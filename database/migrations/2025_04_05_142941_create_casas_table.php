<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('casas', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password'); 
            $table->rememberToken();
            $table->string('telefono')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fechaRegistro')->nullable();
            $table->string('estadoCuenta')->default('activo');
            $table->enum('rol', ['casa', 'admin'])->default('casa'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casas');
    }
};
