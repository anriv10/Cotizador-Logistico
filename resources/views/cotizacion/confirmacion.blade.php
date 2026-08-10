@extends('layouts.app')
@section('titulo', 'Cotización Enviada')

@section('contenido')
<div class="max-w-lg mx-auto text-center py-16">

    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>

    <h1 class="text-3xl font-800 text-gray-900 mb-3">¡Cotización Enviada!</h1>
    <p class="text-gray-500 mb-2">Tu cotización ha sido registrada y enviada al área de logística.</p>
    <p class="text-gray-500 mb-8">También puedes descargar tu PDF para tus registros.</p>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6 text-left">
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-500">Cliente</span>
            <span class="font-600 text-gray-900">{{ $cotizacion->cliente_nombre }}</span>
        </div>
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-500">Ruta</span>
            <span class="font-600 text-gray-900">{{ $cotizacion->origen }} → {{ $cotizacion->destino }}</span>
        </div>
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-500">Contenedor</span>
            <span class="font-600 text-gray-900">{{ strtoupper(str_replace('_', ' ', $cotizacion->tipo_contenedor)) }}</span>
        </div>
        <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between">
            <span class="text-gray-500">Total</span>
            <span class="text-xl font-800 text-blue-600">${{ number_format($cotizacion->total, 2) }} MXN</span>
        </div>
    </div>

    <a href="{{ route('cotizacion.pdf', $cotizacion->id) }}"
       class="w-full block bg-blue-600 hover:bg-blue-700 text-white font-600 py-4 rounded-2xl transition-all duration-200 shadow-lg shadow-blue-200 text-sm mb-3">
        Descargar PDF
    </a>

    <a href="{{ route('cotizacion.index') }}"
       class="w-full block bg-gray-100 hover:bg-gray-200 text-gray-700 font-600 py-4 rounded-2xl transition-all text-sm">
        Nueva Cotización
    </a>

</div>
@endsection
