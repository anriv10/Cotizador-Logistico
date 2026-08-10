@extends('layouts.app')
@section('titulo', 'Nueva Cotización')

@section('contenido')
<div x-data="cotizador()" class="max-w-[1200px] mx-auto">

    <!-- Banner Horizontal Compacto (Sin azul, tráiler visible) -->
    <div class="relative bg-black rounded-[1.5rem] overflow-hidden mb-6 h-36 flex items-center shadow-md">
        <!-- Imagen de fondo de Unsplash (Tráiler) -->
        <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=2070&auto=format&fit=crop" 
             class="absolute inset-0 w-full h-full object-cover opacity-80" alt="Trailer">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        <div class="relative z-10 px-8 w-full md:w-2/3">
            <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-md">Bienvenido a nuestro sistema de cotizaciones</h1>
            <p class="text-gray-200 text-sm mt-1 font-medium drop-shadow">Calcula el costo de tu flete al instante.</p>
        </div>
    </div>

    <!-- Contenedor Principal del Formulario -->
    <form action="{{ route('cotizacion.guardar') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- COLUMNA IZQUIERDA: FORMULARIOS (8 columnas) -->
            <div class="lg:col-span-8 flex flex-col gap-6">
                
                <!-- Fila 1: Contacto y Ruta -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Tarjeta 1: Datos de Contacto --}}
                    <div class="bg-white rounded-[1.5rem] shadow-[0_4px_20px_rgb(0,0,0,0.03)] p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-gray-900 text-sm">Contacto</h2>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Empresa <span class="text-red-400">*</span></label>
                                <input type="text" name="cliente_nombre"
                                       class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                       placeholder="Transportes S.A." required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Correo <span class="text-red-400">*</span></label>
                                <input type="email" name="cliente_correo"
                                       class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                       placeholder="contacto@empresa.com" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Teléfono</label>
                                    <input type="tel" name="cliente_telefono"
                                           class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                           placeholder="5512345678">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Fecha</label>
                                    <input type="date" name="fecha_estimada" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm text-gray-600 outline-none focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tarjeta 2: Ruta del Servicio --}}
                    <div class="bg-white rounded-[1.5rem] shadow-[0_4px_20px_rgb(0,0,0,0.03)] p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-9 h-9 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-gray-900 text-sm">Ruta GPS</h2>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Origen <span class="text-red-400">*</span></label>
                                <input type="text" name="origen" @blur="calcularDistancia()" @change="calcularDistancia()"
                                       class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all"
                                       placeholder="Puerto de Manzanillo, Col." required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Destino <span class="text-red-400">*</span></label>
                                <input type="text" name="destino" @blur="calcularDistancia()" @change="calcularDistancia()"
                                       class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all"
                                       placeholder="Ciudad de México" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1 flex items-center justify-between">
                                    <span>Distancia <span class="text-red-400">*</span></span>
                                    <span x-show="cargandoDistancia" x-cloak class="text-green-600 normal-case bg-green-50 px-2 py-0.5 rounded-md">Calculando...</span>
                                </label>
                                <div class="relative">
                                    <input type="number" step="0.1" name="distancia_km" x-model="distancia" @input="calcular"
                                           class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 pr-10 text-sm outline-none focus:bg-white focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all"
                                           placeholder="0.0" required>
                                    <span class="absolute right-4 top-3.5 text-xs text-gray-400 font-bold">KM</span>
                                </div>
                                <p x-show="errorDistancia" x-cloak x-text="errorDistancia" class="text-[10px] text-red-500 mt-1 ml-1 font-medium"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fila 2: Carga y Notas -->
                <div class="bg-white rounded-[1.5rem] shadow-[0_4px_20px_rgb(0,0,0,0.03)] p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-gray-900 text-sm">Detalles de Carga</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Contenedor <span class="text-red-400">*</span></label>
                            <select name="tipo_contenedor" x-model="contenedor" @change="calcular"
                                    class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition-all appearance-none cursor-pointer" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="20_pies">20 Pies (25 ton)</option>
                                <option value="40_pies">40 Pies (27 ton)</option>
                                <option value="40_hc">40 Pies HC</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Peso <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <input type="number" step="0.1" name="peso_toneladas" x-model="peso" @input="calcular"
                                       class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 pr-14 text-sm outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition-all"
                                       placeholder="0.0" required>
                                <span class="absolute right-4 top-3.5 text-xs text-gray-400 font-bold">TON</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Notas (Opcional)</label>
                            <input type="text" name="notas"
                                   class="w-full bg-gray-100/80 border-transparent rounded-xl px-4 py-3 text-sm outline-none focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-100 transition-all"
                                   placeholder="Ej. Mercancía frágil...">
                        </div>
                    </div>
                </div>

            </div>

            <!-- COLUMNA DERECHA: RESUMEN PREMIUM Y BOTÓN -->
            <div class="lg:col-span-4">
                <div class="sticky top-6">
                    <!-- Tarjeta Estilo Apple Wallet Oscura -->
                    <div class="bg-gradient-to-b from-gray-900 to-gray-800 rounded-[2rem] shadow-2xl p-7 text-white relative overflow-hidden border border-gray-700/50">
                        
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500 rounded-full blur-[3rem] opacity-30 pointer-events-none"></div>
                        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-500 rounded-full blur-[3rem] opacity-20 pointer-events-none"></div>
                        
                        <h3 class="font-bold text-gray-100 mb-6 text-xs uppercase tracking-widest flex items-center gap-2 relative z-10">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Estimación en Vivo
                        </h3>
                        
                        <div class="space-y-4 relative z-10">
                            <div class="flex justify-between text-sm items-center">
                                <span class="text-gray-400 font-medium">Tarifa base</span>
                                <span class="font-bold text-white tracking-wide">$<span x-text="fmt(desglose.tarifa_base)">0.00</span></span>
                            </div>
                            <div class="flex justify-between text-sm items-center">
                                <span class="text-gray-400 font-medium">Costo por Distancia</span>
                                <span class="font-bold text-white tracking-wide">$<span x-text="fmt(desglose.costo_distancia)">0.00</span></span>
                            </div>
                            <div class="flex justify-between text-sm items-center">
                                <span class="text-gray-400 font-medium">Costo por Peso</span>
                                <span class="font-bold text-white tracking-wide">$<span x-text="fmt(desglose.costo_peso)">0.00</span></span>
                            </div>
                            
                            <div class="border-t border-gray-600/50 border-dashed pt-4 mt-2 flex justify-between text-sm items-center">
                                <span class="text-gray-300 font-medium">Subtotal</span>
                                <span class="font-bold text-white tracking-wide">$<span x-text="fmt(desglose.subtotal)">0.00</span></span>
                            </div>

                            <!-- Alerta de Custodia -->
                            <div x-show="desglose.requiere_custodia" x-cloak
                                 class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-3 mt-3 backdrop-blur-sm">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-amber-400 mb-0.5">Custodia Requerida</p>
                                        <p class="text-sm font-bold text-amber-300">+$<span x-text="fmt(desglose.costo_custodia)">0.00</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-700 mt-6 pt-6 relative z-10">
                            <div class="flex justify-between items-end">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Final</span>
                                <div class="text-right flex items-start gap-1">
                                    <span class="text-lg font-bold text-blue-400 mt-1">$</span>
                                    <span class="text-4xl font-black text-white tracking-tighter leading-none"><span x-text="fmt(desglose.total)">0.00</span></span>
                                </div>
                            </div>
                            <div class="text-right mt-1">
                                <span class="text-[10px] font-bold text-gray-500">MXN</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Enviar (Restaurado) -->
                    <div class="mt-6">
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-500 active:scale-[0.98] text-white font-bold py-4 rounded-[1.2rem] shadow-[0_4px_14px_0_rgb(37,99,235,0.39)] hover:shadow-[0_6px_20px_rgba(37,99,235,0.23)] transition-all duration-200 text-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Enviar y Generar PDF
                        </button>
                        <p class="text-[10px] text-center text-gray-400 font-medium px-4 mt-3 leading-relaxed">
                            Al enviar aceptas nuestros términos de servicio.<br>Cotización válida por 15 días.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>

{{-- Chat IA flotante (Intacto) --}}
<div x-data="chatIA()" class="fixed bottom-6 right-6 z-50">
    <button @click="abierto = !abierto" class="w-12 h-12 bg-gray-900 hover:bg-gray-800 text-white rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.12)] flex items-center justify-center transition-all duration-300 hover:scale-105 border border-gray-700">
        <svg x-show="!abierto" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z"/></svg>
        <svg x-show="abierto" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <div x-show="abierto" x-cloak class="absolute bottom-16 right-0 w-80 bg-white/95 backdrop-blur-2xl rounded-[1.5rem] shadow-[0_20px_50px_rgb(0,0,0,0.1)] border border-gray-100 overflow-hidden">
        <div class="bg-gray-50/80 px-5 py-3 flex items-center gap-3 border-b border-gray-100">
            <div class="w-8 h-8 bg-gradient-to-tr from-blue-600 to-purple-500 rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-gray-900 font-bold text-xs">Logística IA</p>
                <p class="text-gray-500 text-[10px] font-medium">Asistente Virtual</p>
            </div>
        </div>
        <div class="h-64 overflow-y-auto p-4 space-y-3 bg-white" id="chat-mensajes">
            <div class="flex gap-2">
                <div class="w-7 h-7 bg-blue-50 rounded-xl flex items-center justify-center shrink-0 mt-0.5 border border-blue-100">
                    <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="bg-gray-50 rounded-xl rounded-tl-none px-3 py-2.5 text-xs text-gray-700 border border-gray-100 max-w-[85%] font-medium">
                    Hola, calcularé tu flete al instante.
                </div>
            </div>
        </div>
        <div class="p-3 bg-white border-t border-gray-100">
            <div class="relative">
                <input type="text" x-model="mensaje" @keydown.enter="enviar" placeholder="Mensaje..."
                       class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-3 pr-10 py-2.5 text-xs outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-50 transition-all">
                <button @click="enviar" :disabled="cargando"
                        class="absolute right-1.5 top-1.5 w-7 h-7 bg-blue-600 hover:bg-blue-500 disabled:opacity-50 text-white rounded-lg flex items-center justify-center transition-colors">
                    <svg x-show="!cargando" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    <svg x-show="cargando" x-cloak class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function cotizador() {
    return {
        distancia: '',
        contenedor: '',
        peso: '',
        cargandoDistancia: false,
        errorDistancia: '',
        desglose: {
            tarifa_base: 0,
            costo_distancia: 0,
            costo_peso: 0,
            subtotal: 0,
            requiere_custodia: false,
            costo_custodia: 0,
            total: 0
        },
        fmt(val) {
            return parseFloat(val || 0).toLocaleString('es-MX', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        },
        async calcularDistancia() {
            const origen  = document.querySelector('[name="origen"]').value.trim();
            const destino = document.querySelector('[name="destino"]').value.trim();
            if (!origen || !destino) return;
            this.cargandoDistancia = true;
            try {
                const res = await fetch("{{ route('distancia.calcular') }}", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ origen, destino })
                });
                const data = await res.json();
                if (data.distancia_km) {
                    this.errorDistancia = '';
                    this.distancia = data.distancia_km;
                    await this.calcular();
                } else if (data.error) {
                    this.errorDistancia = data.error;
                }
            } catch(e) {
                console.error(e);
            } finally {
                this.cargandoDistancia = false;
            }
        },
        async calcular() {
            if (!this.contenedor || !this.distancia || !this.peso) return;
            try {
                const res = await fetch("{{ route('cotizacion.calcular') }}", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ tipo_contenedor: this.contenedor, distancia_km: this.distancia, peso_toneladas: this.peso })
                });
                if (!res.ok) return;
                this.desglose = await res.json();
            } catch(e) {
                console.error(e);
            }
        }
    }
}

function chatIA() {
    return {
        abierto: false,
        mensaje: '',
        cargando: false,
        async enviar() {
            if (!this.mensaje.trim() || this.cargando) return;
            const texto = this.mensaje.trim();
            this.mensaje = '';
            this.cargando = true;
            this.agregarMensaje(texto, 'usuario');
            try {
                const res = await fetch("{{ route('chat.responder') }}", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ mensaje: texto })
                });
                const data = await res.json();
                this.agregarMensaje(data.respuesta, 'asistente');
            } catch(e) {
                this.agregarMensaje('Error de red.', 'asistente');
            } finally {
                this.cargando = false;
            }
        },
        agregarMensaje(texto, tipo) {
            const contenedor = document.getElementById('chat-mensajes');
            const esUsuario = tipo === 'usuario';
            const div = document.createElement('div');
            div.className = 'flex gap-2 ' + (esUsuario ? 'flex-row-reverse' : '');
            div.innerHTML =
                '<div class="w-7 h-7 ' + (esUsuario ? 'bg-gray-100 border-gray-200' : 'bg-blue-50 border-blue-100') + ' border rounded-xl flex items-center justify-center shrink-0 mt-0.5">' +
                '<svg class="w-3.5 h-3.5 ' + (esUsuario ? 'text-gray-500' : 'text-blue-500') + '" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                (esUsuario ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>' : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>') +
                '</svg></div>' +
                '<div class="' + (esUsuario ? 'bg-blue-600 text-white rounded-xl rounded-tr-none' : 'bg-gray-50 text-gray-700 border-gray-100 border rounded-xl rounded-tl-none') + ' px-3 py-2.5 text-xs max-w-[85%] font-medium">' +
                texto + '</div>';
            contenedor.appendChild(div);
            contenedor.scrollTop = contenedor.scrollHeight;
        }
    }
}
</script>
