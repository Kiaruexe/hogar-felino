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
        Schema::create('gatos', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre');
            $table->date('edad')->nullable();
            $table->enum('sexo', ['macho', 'hembra'])->nullable();
            $table->text('descripcion')->nullable();
            $table->binary('imagen')->nullable(); 
            $table->unsignedBigInteger('casa_acogida_id');
            $table->foreign('casa_acogida_id')
                  ->references('id')
                  ->on('casas')
                  ->onDelete('cascade'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gatos');
    }
};
