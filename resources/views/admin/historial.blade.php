@extends('layouts.app')
@section('titulo', 'Historial de Cotizaciones')

@section('contenido')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="relative bg-white/60 backdrop-blur-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[2rem] overflow-hidden border border-white flex items-center justify-between min-h-[160px]">
        <div class="relative z-10 p-8 w-full md:w-2/3">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Bienvenido a LogísticaMX</h1>
            <p class="text-gray-500 font-medium mt-2 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Aquí tienes el control total de tus cotizaciones.
            </p>
        </div>
        <div class="absolute inset-y-0 right-0 w-1/2 md:w-2/3">
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/60 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=2070&auto=format&fit=crop" alt="Trailer Logística" class="w-full h-full object-cover">
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Historial</h2>
            <p class="text-gray-500 text-sm mt-1">{{ $cotizaciones->total() }} registros almacenados</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.configuracion.index') }}"
               class="flex items-center gap-2 text-sm bg-white/80 backdrop-blur-md border border-gray-100 text-gray-700 font-medium px-5 py-2.5 rounded-full shadow-sm hover:shadow-md hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ajustes
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-sm bg-red-50/80 backdrop-blur-md border border-red-100 text-red-600 font-medium px-5 py-2.5 rounded-full shadow-sm hover:shadow-md hover:bg-red-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Salir
                </button>
            </form>
        </div>
    </div>

    {{-- Alertas --}}
    @if(session('exito'))
        <div class="bg-green-50/80 backdrop-blur-md border border-green-100 text-green-700 text-sm rounded-2xl px-5 py-4 shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('exito') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50/80 backdrop-blur-md border border-red-100 text-red-700 text-sm rounded-2xl px-5 py-4 shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Filtros Estilo iOS --}}
    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] border border-gray-100 shadow-sm p-8">
        <form method="GET" action="{{ route('admin.historial.index') }}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Cliente</label>
                <input type="text" name="cliente" value="{{ request('cliente') }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-4 py-2.5 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all"
                       placeholder="Buscar...">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Estado</label>
                <select name="estado" class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-4 py-2.5 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all appearance-none">
                    <option value="">Todos</option>
                    <option value="borrador"  {{ request('estado') == 'borrador'  ? 'selected' : '' }}>Borrador</option>
                    <option value="enviada"   {{ request('estado') == 'enviada'   ? 'selected' : '' }}>Enviada</option>
                    <option value="aceptada"  {{ request('estado') == 'aceptada'  ? 'selected' : '' }}>Aceptada</option>
                    <option value="rechazada" {{ request('estado') == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Desde</label>
                <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-4 py-2.5 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all text-gray-600">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Hasta</label>
                <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-4 py-2.5 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all text-gray-600">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Monto Mínimo</label>
                <input type="number" name="monto_min" value="{{ request('monto_min') }}"
                       class="w-full bg-gray-50/50 border border-gray-200 rounded-2xl px-4 py-2.5 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all"
                       placeholder="$0.00">
            </div>
            <div class="flex flex-col justify-end">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-medium py-2.5 rounded-2xl text-sm shadow-[0_4px_14px_0_rgb(37,99,235,0.39)] hover:shadow-[0_6px_20px_rgba(37,99,235,0.23)] hover:-translate-y-0.5 transition-all duration-200">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    {{-- Tabla Minimalista --}}
    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="text-left px-8 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">ID</th>
                        <th class="text-left px-8 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Cliente</th>
                        <th class="text-left px-8 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Ruta & Equipo</th>
                        <th class="text-right px-8 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Total</th>
                        <th class="text-left px-8 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Estado</th>
                        <th class="text-center px-8 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50/80">
                    @forelse($cotizaciones as $c)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-5 text-sm text-gray-400 font-medium">#{{ str_pad($c->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-8 py-5">
                            <div class="text-sm font-semibold text-gray-900">{{ $c->cliente_nombre }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">{{ $c->cliente_correo }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 text-blue-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-700">{{ $c->origen }} <span class="text-gray-300 mx-1">→</span> {{ $c->destino }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ strtoupper(str_replace('_', ' ', $c->tipo_contenedor)) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="text-sm font-bold text-gray-900">${{ number_format($c->total, 2) }}</div>
                            @if($c->requiere_custodia)
                                <div class="text-[10px] uppercase font-bold tracking-wider text-amber-500 mt-1 flex items-center justify-end gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Custodia
                                </div>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <form action="{{ route('admin.historial.estado', $c->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="relative">
                                    <select name="estado" onchange="this.form.submit()"
                                            class="text-xs font-semibold rounded-full px-4 py-1.5 outline-none cursor-pointer appearance-none pr-8 transition-all shadow-sm border border-transparent hover:border-gray-200
                                            {{ $c->estado == 'aceptada'  ? 'bg-green-100 text-green-700 focus:ring-2 focus:ring-green-200' : '' }}
                                            {{ $c->estado == 'rechazada' ? 'bg-red-100 text-red-700 focus:ring-2 focus:ring-red-200' : '' }}
                                            {{ $c->estado == 'enviada'   ? 'bg-blue-100 text-blue-700 focus:ring-2 focus:ring-blue-200' : '' }}
                                            {{ $c->estado == 'borrador'  ? 'bg-gray-100 text-gray-600 focus:ring-2 focus:ring-gray-200' : '' }}">
                                        <option value="borrador"  {{ $c->estado == 'borrador'  ? 'selected' : '' }}>Borrador</option>
                                        <option value="enviada"   {{ $c->estado == 'enviada'   ? 'selected' : '' }}>Enviada</option>
                                        <option value="aceptada"  {{ $c->estado == 'aceptada'  ? 'selected' : '' }}>Aceptada</option>
                                        <option value="rechazada" {{ $c->estado == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <a href="{{ route('cotizacion.pdf', $c->id) }}"
                                   title="Descargar PDF"
                                   class="p-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-full transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </a>
                                <form action="{{ route('admin.historial.reenviar', $c->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" title="Reenviar Notificación"
                                            class="p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-full transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4 text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Sin registros</h3>
                            <p class="text-sm text-gray-400">No hay cotizaciones para mostrar en este momento.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($cotizaciones->hasPages())
        <div class="px-8 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $cotizaciones->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
