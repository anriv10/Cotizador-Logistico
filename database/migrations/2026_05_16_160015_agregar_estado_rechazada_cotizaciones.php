<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->enum('estado', ['borrador', 'enviada', 'aceptada', 'rechazada'])
                  ->default('borrador')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->enum('estado', ['borrador', 'enviada', 'aceptada'])
                  ->default('borrador')
                  ->change();
        });
    }
};
