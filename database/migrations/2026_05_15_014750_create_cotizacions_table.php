<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_nombre');
            $table->string('cliente_correo');
            $table->string('origen');
            $table->string('destino');
            $table->decimal('distancia_km', 8, 2);
            $table->enum('tipo_contenedor', ['20_pies', '40_pies', '40_hc']);
            $table->decimal('peso_toneladas', 6, 2);
            $table->boolean('requiere_custodia')->default(false);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('costo_custodia', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['borrador', 'enviada', 'aceptada'])->default('borrador');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
