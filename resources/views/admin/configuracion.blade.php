@extends('layouts.app')
@section('titulo', 'Configuración de Precios')

@section('contenido')
<div class="max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-800 text-gray-900">Configuración de Precios</h1>
            <p class="text-gray-500 mt-1 text-sm">Ajusta las tarifas y reglas del sistema de cotización.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.historial.index') }}"
               class="flex items-center gap-2 text-sm bg-white border border-gray-200 text-gray-700 font-500 px-4 py-2 rounded-xl hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Historial
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

    @if(session('exito'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6">
            {{ session('exito') }}
        </div>
    @endif

    <form action="{{ route('admin.configuracion.actualizar') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Tarifas base --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-600 text-gray-900">Tarifas Base por Contenedor</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Costo fijo según el tipo de equipo utilizado</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Contenedor 20 Pies</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="tarifa_base_20"
                               value="{{ $configuraciones['tarifa_base_20']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Contenedor 40 Pies</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="tarifa_base_40"
                               value="{{ $configuraciones['tarifa_base_40']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Contenedor 40 HC</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="tarifa_base_40hc"
                               value="{{ $configuraciones['tarifa_base_40hc']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                </div>
            </div>
        </div>

        {{-- Variables operativas --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-600 text-gray-900">Variables Operativas</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Costos variables según distancia y peso</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Precio por Kilómetro</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="precio_por_km"
                               value="{{ $configuraciones['precio_por_km']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Se multiplica por la distancia total de la ruta</p>
                </div>
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Recargo por Tonelada</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="precio_por_tonelada"
                               value="{{ $configuraciones['precio_por_tonelada']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Se multiplica por el peso declarado de la carga</p>
                </div>
            </div>
        </div>

        {{-- Custodia --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-600 text-gray-900">Seguridad Automática</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Regla de custodia obligatoria por monto</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Umbral de Activación</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="umbral_custodia"
                               value="{{ $configuraciones['umbral_custodia']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Si el subtotal supera este monto, la custodia se agrega automáticamente</p>
                </div>
                <div>
                    <label class="block text-xs font-600 text-gray-500 uppercase tracking-wider mb-2">Costo de Custodia</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-sm text-gray-400 font-500">$</span>
                        <input type="number" step="0.01" name="costo_custodia"
                               value="{{ $configuraciones['costo_custodia']->valor ?? 0 }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-8 pr-4 py-3 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all" required>
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Monto fijo que se suma al total cuando se activa</p>
                </div>
            </div>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-600 py-4 rounded-2xl transition-all duration-200 shadow-lg shadow-blue-200 text-sm">
            Guardar Configuraciones
        </button>

    </form>
</div>
@endsection
