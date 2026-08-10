@extends('layouts.app')
@section('titulo', 'Dashboard')

@section('contenido')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-800 text-gray-900">Dashboard</h1>
            <p class="text-gray-500 mt-1 text-sm">Resumen general del negocio — {{ now()->format('d \d\e F, Y') }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.historial.index') }}"
               class="flex items-center gap-2 text-sm bg-white border border-gray-200 text-gray-700 font-500 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Historial
            </a>
            <a href="{{ route('admin.configuracion.index') }}"
               class="flex items-center gap-2 text-sm bg-white border border-gray-200 text-gray-700 font-500 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Configuración
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-sm bg-red-50 border border-red-200 text-red-600 font-500 px-4 py-2 rounded-xl hover:bg-red-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    {{-- KPIs --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-600 text-gray-500 uppercase tracking-wider">Total Cotizaciones</span>
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-800 text-gray-900">{{ $totalCotizaciones }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $cotizacionesHoy }} hoy</div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-600 text-gray-500 uppercase tracking-wider">Total Facturado</span>
                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-800 text-gray-900">${{ number_format($totalFacturado, 0) }}</div>
            <div class="text-xs text-gray-400 mt-1">Promedio ${{ number_format($promedioPorCotizacion, 0) }}</div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-600 text-gray-500 uppercase tracking-wider">Tasa Aceptación</span>
                <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-800 text-gray-900">{{ $tasaAceptacion }}%</div>
            <div class="text-xs text-gray-400 mt-1">{{ $aceptadas }} aceptadas · {{ $rechazadas }} rechazadas</div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-600 text-gray-500 uppercase tracking-wider">Con Custodia</span>
                <div class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-800 text-gray-900">{{ $conCustodia }}</div>
            <div class="text-xs text-gray-400 mt-1">
                {{ $totalCotizaciones > 0 ? round(($conCustodia / $totalCotizaciones) * 100, 1) : 0 }}% del total
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Gráfica de barras por mes --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-600 text-gray-900 mb-6">Cotizaciones por Mes</h3>
            <div class="flex items-end gap-3 h-40">
                @php
                    $maxMes = $porMes->max('total') ?: 1;
                    $meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
                @endphp
                @forelse($porMes as $mes)
                    @php $altura = round(($mes->total / $maxMes) * 100); @endphp
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <span class="text-xs font-600 text-gray-700">{{ $mes->total }}</span>
                        <div class="w-full bg-blue-600 rounded-t-lg transition-all"
                             style="height: {{ $altura }}%"></div>
                        <span class="text-xs text-gray-400">{{ $meses[$mes->mes - 1] }}</span>
                    </div>
                @empty
                    <div class="w-full flex items-center justify-center text-sm text-gray-400">
                        Sin datos aún
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Distribución por contenedor --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-600 text-gray-900 mb-6">Por Tipo de Contenedor</h3>
            <div class="space-y-4">
                @php
                    $colores = ['20_pies' => 'bg-blue-500', '40_pies' => 'bg-green-500', '40_hc' => 'bg-amber-500'];
                    $nombres = ['20_pies' => '20 Pies', '40_pies' => '40 Pies', '40_hc' => '40 HC'];
                    $maxCont = $porContenedor->max('total') ?: 1;
                @endphp
                @forelse($porContenedor as $cont)
                    @php $pct = round(($cont->total / $totalCotizaciones) * 100); @endphp
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="text-gray-600 font-500">{{ $nombres[$cont->tipo_contenedor] ?? $cont->tipo_contenedor }}</span>
                            <span class="text-gray-900 font-600">{{ $cont->total }} <span class="text-gray-400 font-400">({{ $pct }}%)</span></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="{{ $colores[$cont->tipo_contenedor] ?? 'bg-gray-500' }} h-2 rounded-full"
                                 style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">Sin datos aún</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Rutas frecuentes --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-600 text-gray-900 mb-5">Rutas más Frecuentes</h3>
            <div class="space-y-3">
                @forelse($rutasFrecuentes as $ruta)
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <div class="text-sm font-500 text-gray-900">{{ $ruta->origen }}</div>
                        <div class="text-xs text-gray-400">→ {{ $ruta->destino }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-700 text-blue-600">{{ $ruta->veces }}x</div>
                        <div class="text-xs text-gray-400">${{ number_format($ruta->promedio, 0) }} prom.</div>
                    </div>
                </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">Sin datos aún</p>
                @endforelse
            </div>
        </div>

        {{-- Últimas cotizaciones --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-600 text-gray-900">Últimas Cotizaciones</h3>
                <a href="{{ route('admin.historial.index') }}" class="text-xs text-blue-600 hover:underline font-500">Ver todas</a>
            </div>
            <div class="space-y-3">
                @forelse($ultimasCotizaciones as $c)
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <div class="text-sm font-500 text-gray-900">{{ $c->cliente_nombre }}</div>
                        <div class="text-xs text-gray-400">{{ $c->origen }} → {{ $c->destino }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-700 text-gray-900">${{ number_format($c->total, 0) }}</div>
                        <span class="text-xs px-2 py-0.5 rounded-full font-500
                            {{ $c->estado == 'aceptada'  ? 'bg-green-50 text-green-700' : '' }}
                            {{ $c->estado == 'rechazada' ? 'bg-red-50 text-red-700' : '' }}
                            {{ $c->estado == 'enviada'   ? 'bg-blue-50 text-blue-700' : '' }}
                            {{ $c->estado == 'borrador'  ? 'bg-gray-50 text-gray-600' : '' }}">
                            {{ ucfirst($c->estado) }}
                        </span>
                    </div>
                </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-4">Sin cotizaciones aún</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
