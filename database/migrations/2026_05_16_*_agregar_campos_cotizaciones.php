<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->string('cliente_telefono')->nullable()->after('cliente_correo');
            $table->date('fecha_estimada')->nullable()->after('cliente_telefono');
            $table->text('notas')->nullable()->after('fecha_estimada');
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn(['cliente_telefono', 'fecha_estimada', 'notas']);
        });
    }
};

