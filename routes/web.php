<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HistorialController;
use App\Http\Controllers\ChatController;

// ─── Área Pública ─────────────────────────────────────────────────────────────

Route::get('/', [CotizacionController::class, 'index'])->name('cotizacion.index');
Route::post('/calcular', [CotizacionController::class, 'calcular'])->name('cotizacion.calcular');
Route::post('/guardar', [CotizacionController::class, 'guardar'])->name('cotizacion.guardar');
Route::post('/distancia', [CotizacionController::class, 'calcularDistancia'])->name('distancia.calcular');
Route::post('/chat', [ChatController::class, 'responder'])->name('chat.responder');
Route::get('/cotizacion/{id}/pdf', [CotizacionController::class, 'generarPdf'])->name('cotizacion.pdf');

// ─── Login Admin ───────────────────────────────────────────────────────────────

Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ─── Área Admin Protegida ─────────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
    Route::put('/configuracion', [ConfiguracionController::class, 'actualizar'])->name('configuracion.actualizar');

    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    Route::patch('/historial/{id}/estado', [HistorialController::class, 'actualizarEstado'])->name('historial.estado');
    Route::post('/historial/{id}/reenviar', [HistorialController::class, 'reenviar'])->name('historial.reenviar');

});

Route::get('/forzar-error', function () {
    \Illuminate\Support\Facades\Mail::raw('Prueba desde terminal', function($message) { 
        $message->to('anriv3100@gmail.com')->subject('Prueba Error'); 
    });
    return '¡El correo sí salió!';
});
