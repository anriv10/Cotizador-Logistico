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
        Schema::create('configuracion_precios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	    $table->string('clave')->unique();
            $table->decimal('valor', 10, 2);
            $table->string('descripcion')->nullable();		
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_precios');
    }
};
