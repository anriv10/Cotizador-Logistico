@extends('layouts.app')
@section('titulo', 'Cotización de Traslado')

@section('contenido')

{{-- HERO BANNER --}}
<div class="relative w-screen -ml-4 sm:-ml-6 lg:-ml-8 -mt-8 mb-16 overflow-hidden" style="height: 92vh; min-height: 600px;">

    {{-- Imagen de fondo --}}
    <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=1600&q=80"
         alt="Transporte logístico"
         class="absolute inset-0 w-full h-full object-cover object-center">

    {{-- Overlay gradiente --}}
    <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(0,0,0,0.82) 0%, rgba(0,0,0,0.5) 60%, rgba(0,0,0,0.15) 100%);"></div>

    {{-- Contenido del hero --}}
    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">

                <div class="inline-flex items-center gap-2 mb-6"
                     style="background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.15); border-radius: 100px; padding: 6px 16px;">
                    <div style="width:6px; height:6px; background:#3b82f6; border-radius:50%;"></div>
                    <span style="color:rgba(255,255,255,0.85); font-size:12px; font-weight:500; letter-spacing:0.08em; text-transform:uppercase;">Logística de contenedores</span>
                </div>

                <h1 style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; color: white; line-height: 1.1; letter-spacing: -0.02em; margin-bottom: 1.5rem;">
                    Traslada tu carga<br>
                    <span style="color: #60a5fa;">con total seguridad.</span>
                </h1>

                <p style="font-size: 1.125rem; color: rgba(255,255,255,0.7); line-height: 1.7; margin-bottom: 2.5rem; max-width: 520px;">
                    Cotiza el traslado de tu contenedor en segundos. Precio justo, calculado automáticamente según tu ruta, carga y tipo de equipo.
                </p>

                <div class="flex items-center gap-4 flex-wrap">
                    <a href="#formulario"
                       style="background: #2563eb; color: white; font-weight: 600; font-size: 0.9375rem; padding: 14px 28px; border-radius: 12px; text-decoration: none; transition: all 0.2s; box-shadow: 0 8px 24px rgba(37,99,235,0.4);"
                       onmouseover="this.style.background='#1d4ed8'; this.style.transform='translateY(-1px)'"
                       onmouseout="this.style.background='#2563eb'; this.style.transform='translateY(0)'">
                        Solicitar cotización
                    </a>
                    <div style="display:flex; align-items:center; gap:8px; color:rgba(255,255,255,0.6); font-size:0.875rem;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Respuesta en menos de 24 horas
                    </div>
                </div>

                {{-- Stats --}}
                <div class="flex items-center gap-8 mt-12 flex-wrap">
                    <div>
                        <div style="font-size:1.75rem; font-weight:800; color:white; letter-spacing:-0.02em;">+500</div>
                        <div style="font-size:0.75rem; color:rgba(255,255,255,0.5); text-transform:uppercase; letter-spacing:0.06em; margin-top:2px;">Traslados realizados</div>
                    </div>
                    <div style="width:1px; height:40px; background:rgba(255,255,255,0.15);"></div>
                    <div>
                        <div style="font-size:1.75rem; font-weight:800; color:white; letter-spacing:-0.02em;">3</div>
                        <div style="font-size:0.75rem; color:rgba(255,255,255,0.5); text-transform:uppercase; letter-spacing:0.06em; margin-top:2px;">Tipos de contenedor</div>
                    </div>
                    <div style="width:1px; height:40px; background:rgba(255,255,255,0.15);"></div>
                    <div>
                        <div style="font-size:1.75rem; font-weight:800; color:white; letter-spacing:-0.02em;">100%</div>
                        <div style="font-size:0.75rem; color:rgba(255,255,255,0.5); text-transform:uppercase; letter-spacing:0.06em; margin-top:2px;">República Mexicana</div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2"
         style="animation: bounce 2s infinite;">
        <span style="color:rgba(255,255,255,0.4); font-size:11px; letter-spacing:0.1em; text-transform:uppercase;">Cotizar</span>
        <svg width="20" height="20" fill="none" stroke="rgba(255,255,255,0.4)" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>

</div>

{{-- FORMULARIO --}}
<div id="formulario" x-data="cotizador()" class="max-w-5xl mx-auto">

    <div class="mb-12 text-center">
        <h2 style="font-size:2rem; font-weight:800; color:#0f172a; letter-spacing:-0.02em; margin-bottom:0.5rem;">
            Nueva Cotización
        </h2>
        <p style="color:#64748b; font-size:1rem;">
            Complete los datos del traslado para obtener el precio en tiempo real.
        </p>
    </div>

    <form action="{{ route('cotizacion.guardar') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-5">

                {{-- Datos del cliente --}}
                <div style="background:white; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.04); padding:28px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
                        <div style="width:36px; height:36px; background:#eff6ff; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#2563eb" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700; color:#0f172a; font-size:0.9375rem;">Datos del Cliente</div>
                            <div style="font-size:0.75rem; color:#94a3b8; margin-top:1px;">Información de contacto para el seguimiento</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Nombre / Empresa <span style="color:#f87171;">*</span></label>
                            <input type="text" name="cliente_nombre"
                                   style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                   onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                   placeholder="Transportes García S.A." required>
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Correo Electrónico <span style="color:#f87171;">*</span></label>
                            <input type="email" name="cliente_correo"
                                   style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                   onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                   placeholder="contacto@empresa.com" required>
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Teléfono</label>
                            <div style="position:relative;">
                                <span style="position:absolute; left:16px; top:50%; transform:translateY(-50%); font-size:0.875rem; color:#94a3b8; font-weight:500;">+52</span>
                                <input type="tel" name="cliente_telefono"
                                       style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px 12px 48px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                       placeholder="55 1234 5678">
                            </div>
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Fecha Estimada del Traslado</label>
                            <input type="date" name="fecha_estimada"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                   onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">
                        </div>
                    </div>
                </div>

                {{-- Ruta --}}
                <div style="background:white; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.04); padding:28px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
                        <div style="width:36px; height:36px; background:#f0fdf4; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#16a34a" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700; color:#0f172a; font-size:0.9375rem;">Ruta del Traslado</div>
                            <div style="font-size:0.75rem; color:#94a3b8; margin-top:1px;">La distancia se calcula automáticamente</div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Origen <span style="color:#f87171;">*</span></label>
                                <input type="text" name="origen"
                                       @blur="calcularDistancia()" @change="calcularDistancia()"
                                       style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                       placeholder="Manzanillo, Colima" required>
                            </div>
                            <div>
                                <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Destino <span style="color:#f87171;">*</span></label>
                                <input type="text" name="destino"
                                       @blur="calcularDistancia()" @change="calcularDistancia()"
                                       style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                       placeholder="Ciudad de México, CDMX" required>
                            </div>
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">
                                Distancia
                                <span x-show="cargandoDistancia" x-cloak style="color:#2563eb; font-weight:400; text-transform:none; letter-spacing:0; margin-left:6px;">Calculando...</span>
                                <span x-show="!cargandoDistancia" style="color:#cbd5e1; font-weight:400; text-transform:none; letter-spacing:0; margin-left:6px;">(automática al ingresar origen y destino)</span>
                            </label>
                            <div style="position:relative;">
                                <input type="number" step="0.1" name="distancia_km"
                                       x-model="distancia" @input="calcular"
                                       style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 48px 12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                       placeholder="0.0" required>
                                <span style="position:absolute; right:16px; top:50%; transform:translateY(-50%); font-size:11px; font-weight:600; color:#94a3b8; letter-spacing:0.05em;">KM</span>
                            </div>
                            <p x-show="errorDistancia" x-cloak x-text="errorDistancia" style="color:#f87171; font-size:12px; margin-top:6px;"></p>
                        </div>
                    </div>
                </div>

                {{-- Carga --}}
                <div style="background:white; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.04); padding:28px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
                        <div style="width:36px; height:36px; background:#fff7ed; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#ea580c" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700; color:#0f172a; font-size:0.9375rem;">Detalles de Carga</div>
                            <div style="font-size:0.75rem; color:#94a3b8; margin-top:1px;">Especificaciones del contenedor y mercancía</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Tipo de Contenedor <span style="color:#f87171;">*</span></label>
                            <select name="tipo_contenedor" x-model="contenedor" @change="calcular"
                                    style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box; appearance:none; cursor:pointer;"
                                    onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                    onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                    required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="20_pies">20 Pies — Estándar (hasta 25 ton)</option>
                                <option value="40_pies">40 Pies — Estándar (hasta 27 ton)</option>
                                <option value="40_hc">40 Pies — High Cube HC</option>
                            </select>
                        </div>
                        <div>
                            <label style="display:block; font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:8px;">Peso de la Carga <span style="color:#f87171;">*</span></label>
                            <div style="position:relative;">
                                <input type="number" step="0.1" name="peso_toneladas"
                                       x-model="peso" @input="calcular"
                                       style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 52px 12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                                       onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                                       placeholder="0.0" required>
                                <span style="position:absolute; right:16px; top:50%; transform:translateY(-50%); font-size:11px; font-weight:600; color:#94a3b8; letter-spacing:0.05em;">TON</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notas --}}
                <div style="background:white; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.04); padding:28px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
                        <div style="width:36px; height:36px; background:#faf5ff; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#9333ea" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight:700; color:#0f172a; font-size:0.9375rem;">Notas Adicionales</div>
                            <div style="font-size:0.75rem; color:#94a3b8; margin-top:1px;">Instrucciones especiales — opcional</div>
                        </div>
                    </div>
                    <textarea name="notas" rows="3"
                              style="width:100%; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.875rem; color:#0f172a; outline:none; transition:all 0.15s; box-sizing:border-box; resize:none; font-family:inherit;"
                              onfocus="this.style.borderColor='#2563eb'; this.style.background='white'; this.style.boxShadow='0 0 0 3px rgba(37,99,235,0.08)'"
                              onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'"
                              placeholder="Ej. Mercancía frágil, requiere manejo especial..."></textarea>
                </div>

            </div>

            {{-- Panel resumen --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">

                    <div style="background:white; border-radius:20px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.04); padding:24px;">
                        <div style="font-weight:700; color:#0f172a; font-size:0.9375rem; margin-bottom:20px;">Resumen</div>

                        <div style="space-y:0;">
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f8fafc;">
                                <span style="font-size:0.8125rem; color:#64748b;">Tarifa base</span>
                                <span style="font-size:0.8125rem; font-weight:600; color:#0f172a;">$<span x-text="fmt(desglose.tarifa_base)">0.00</span></span>
                            </div>
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f8fafc;">
                                <span style="font-size:0.8125rem; color:#64748b;">Distancia</span>
                                <span style="font-size:0.8125rem; font-weight:600; color:#0f172a;">$<span x-text="fmt(desglose.costo_distancia)">0.00</span></span>
                            </div>
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f8fafc;">
                                <span style="font-size:0.8125rem; color:#64748b;">Peso</span>
                                <span style="font-size:0.8125rem; font-weight:600; color:#0f172a;">$<span x-text="fmt(desglose.costo_peso)">0.00</span></span>
                            </div>
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 0;">
                                <span style="font-size:0.8125rem; color:#64748b;">Subtotal</span>
                                <span style="font-size:0.875rem; font-weight:700; color:#0f172a;">$<span x-text="fmt(desglose.subtotal)">0.00</span></span>
                            </div>
                        </div>

                        <div x-show="desglose.requiere_custodia" x-cloak
                             style="background:#fffbeb; border:1px solid #fde68a; border-radius:12px; padding:14px; margin-bottom:16px;">
                            <div style="display:flex; gap:10px; align-items:flex-start;">
                                <svg width="16" height="16" fill="none" stroke="#d97706" viewBox="0 0 24 24" style="flex-shrink:0; margin-top:1px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <div>
                                    <div style="font-size:12px; font-weight:700; color:#92400e;">Custodia activada</div>
                                    <div style="font-size:11px; color:#b45309; margin-top:2px;">El flete supera el umbral de seguridad.</div>
                                    <div style="font-size:0.875rem; font-weight:700; color:#92400e; margin-top:6px;">+$<span x-text="fmt(desglose.costo_custodia)">0.00</span></div>
                                </div>
                            </div>
                        </div>

                        <div style="border-top:1.5px solid #f1f5f9; padding-top:16px; margin-top:4px;">
                            <div style="display:flex; justify-content:space-between; align-items:baseline;">
                                <span style="font-size:0.8125rem; color:#64748b;">Total estimado</span>
                                <div style="text-align:right;">
                                    <div style="font-size:1.75rem; font-weight:800; color:#2563eb; letter-spacing:-0.02em; line-height:1;">$<span x-text="fmt(desglose.total)">0.00</span></div>
                                    <div style="font-size:11px; color:#94a3b8; margin-top:2px; letter-spacing:0.04em;">MXN</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div style="background:#eff6ff; border:1px solid #dbeafe; border-radius:16px; padding:16px;">
                        <div style="display:flex; flex-direction:column; gap:10px;">
                            <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#1d4ed8; font-weight:500;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                PDF generado al instante
                            </div>
                            <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#1d4ed8; font-weight:500;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Notificación automática al equipo
                            </div>
                            <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:#1d4ed8; font-weight:500;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Vigencia de 15 días hábiles
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            style="width:100%; background:#2563eb; color:white; font-weight:700; font-size:0.9375rem; padding:16px; border-radius:14px; border:none; cursor:pointer; transition:all 0.2s; box-shadow:0 4px 16px rgba(37,99,235,0.3); letter-spacing:-0.01em;"
                            onmouseover="this.style.background='#1d4ed8'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 24px rgba(37,99,235,0.4)'"
                            onmouseout="this.style.background='#2563eb'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 16px rgba(37,99,235,0.3)'">
                        Enviar y Descargar PDF
                    </button>

                    <p style="font-size:11px; color:#94a3b8; text-align:center; line-height:1.5;">
                        Al enviar aceptas que los datos sean procesados por LogísticaMX
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- Chat IA --}}
<div x-data="chatIA()" class="fixed bottom-6 right-6 z-50">
    <button @click="abierto = !abierto"
            style="width:56px; height:56px; background:#2563eb; color:white; border:none; border-radius:50%; box-shadow:0 8px 24px rgba(37,99,235,0.4); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s;"
            onmouseover="this.style.transform='scale(1.08)'"
            onmouseout="this.style.transform='scale(1)'">
        <svg x-show="!abierto" width="22" height="22" fill="none" stroke="white" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z"/>
        </svg>
        <svg x-show="abierto" x-cloak width="20" height="20" fill="none" stroke="white" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <div x-show="abierto" x-cloak
         style="position:absolute; bottom:70px; right:0; width:320px; background:white; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.15); border:1px solid #f1f5f9; overflow:hidden;">
        <div style="background:#2563eb; padding:16px 18px; display:flex; align-items:center; gap:12px;">
            <div style="width:36px; height:36px; background:rgba(255,255,255,0.15); border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.346.346a5 5 0 01-1.48 1.48l-.346.346a5 5 0 01-7.072 0 5 5 0 010-7.072z"/>
                </svg>
            </div>
            <div>
                <div style="color:white; font-weight:700; font-size:0.875rem;">Asistente LogísticaMX</div>
                <div style="color:rgba(255,255,255,0.6); font-size:11px; margin-top:1px;">IA Local · Siempre disponible</div>
            </div>
        </div>

        <div id="chat-mensajes" style="height:240px; overflow-y:auto; padding:16px; background:#f8fafc; display:flex; flex-direction:column; gap:10px;">
            <div style="display:flex; gap:8px;">
                <div style="width:24px; height:24px; background:#dbeafe; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;">
                    <svg width="12" height="12" fill="#2563eb" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/></svg>
                </div>
                <div style="background:white; border-radius:12px; border-top-left-radius:4px; padding:10px 12px; font-size:12px; color:#374151; box-shadow:0 1px 3px rgba(0,0,0,0.06); max-width:240px; line-height:1.5;">
                    Hola, soy tu asistente de logística. Puedo ayudarte a elegir el contenedor correcto o resolver dudas sobre el servicio.
                </div>
            </div>
        </div>

        <div style="padding:12px; background:white; border-top:1px solid #f1f5f9;">
            <div style="display:flex; gap:8px;">
                <input type="text" x-model="mensaje" @keydown.enter="enviar"
                       placeholder="Escribe tu pregunta..."
                       style="flex:1; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:10px; padding:9px 12px; font-size:12px; color:#0f172a; outline:none; font-family:inherit;"
                       onfocus="this.style.borderColor='#2563eb'"
                       onblur="this.style.borderColor='#e2e8f0'">
                <button @click="enviar" :disabled="cargando"
                        style="width:36px; height:36px; background:#2563eb; border:none; border-radius:10px; display:flex; align-items:center; justify-content:center; cursor:pointer; flex-shrink:0; opacity:1; transition:opacity 0.15s;"
                        :style="cargando ? 'opacity:0.5' : 'opacity:1'">
                    <svg x-show="!cargando" width="14" height="14" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <svg x-show="cargando" x-cloak width="14" height="14" fill="none" stroke="white" viewBox="0 0 24 24" style="animation:spin 1s linear infinite;">
                        <circle cx="12" cy="12" r="10" stroke-width="4" style="opacity:0.25"/>
                        <path fill="white" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4z" style="opacity:0.75"/>
                    </svg>
                </button>
            </div>
            <div style="font-size:10px; color:#94a3b8; text-align:center; margin-top:8px; letter-spacing:0.03em;">Powered by Llama 3.2 · IA Local</div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
<script>
function cotizador() {
    return {
        distancia: '',
        contenedor: '',
        peso: '',
        cargandoDistancia: false,
        errorDistancia: '',
        desglose: {
            tarifa_base: 0, costo_distancia: 0, costo_peso: 0,
            subtotal: 0, requiere_custodia: false, costo_custodia: 0, total: 0
        },
        fmt(val) {
            return parseFloat(val || 0).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
        async calcularDistancia() {
            const origen = document.querySelector('[name="origen"]').value.trim();
            const destino = document.querySelector('[name="destino"]').value.trim();
            if (!origen || !destino) return;
            this.cargandoDistancia = true;
            this.errorDistancia = '';
            try {
                const res = await fetch("{{ route('distancia.calcular') }}", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ origen, destino })
                });
                const data = await res.json();
                if (data.distancia_km) {
                    this.distancia = data.distancia_km;
                    this.errorDistancia = '';
                    await this.calcular();
                } else if (data.error) {
                    this.errorDistancia = data.error;
                }
            } catch(e) { console.error(e); }
            finally { this.cargandoDistancia = false; }
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
            } catch(e) { console.error(e); }
        }
    }
}

function chatIA() {
    return {
        abierto: false, mensaje: '', cargando: false,
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
                this.agregarMensaje('Error de conexión.', 'asistente');
            } finally { this.cargando = false; }
        },
        agregarMensaje(texto, tipo) {
            const c = document.getElementById('chat-mensajes');
            const eu = tipo === 'usuario';
            const d = document.createElement('div');
            d.style.cssText = 'display:flex; gap:8px;' + (eu ? 'flex-direction:row-reverse;' : '');
            d.innerHTML =
                '<div style="width:24px;height:24px;background:' + (eu ? '#e2e8f0' : '#dbeafe') + ';border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">' +
                '<svg width="12" height="12" fill="' + (eu ? '#64748b' : '#2563eb') + '" viewBox="0 0 20 20"><path d="' + (eu ? 'M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z' : 'M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z') + '"/></svg></div>' +
                '<div style="background:' + (eu ? '#2563eb' : 'white') + ';color:' + (eu ? 'white' : '#374151') + ';border-radius:12px;border-' + (eu ? 'top-right' : 'top-left') + '-radius:4px;padding:10px 12px;font-size:12px;box-shadow:0 1px 3px rgba(0,0,0,0.06);max-width:220px;line-height:1.5;">' + texto + '</div>';
            c.appendChild(d);
            c.scrollTop = c.scrollHeight;
        }
    }
}
</script>
@endsection
