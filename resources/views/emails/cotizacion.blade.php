@component('mail::message')
# Nueva Cotización Recibida

Se ha generado una nueva cotización en el sistema. Adjunto encontrará el PDF con el desglose completo.

@component('mail::panel')
**Cliente:** {{ $cotizacion->cliente_nombre }}
**Correo:** {{ $cotizacion->cliente_correo }}
**Ruta:** {{ $cotizacion->origen }} → {{ $cotizacion->destino }}
**Distancia:** {{ $cotizacion->distancia_km }} km
@endcomponent

@component('mail::table')
| Concepto | Monto |
|:---------|------:|
| Tarifa base ({{ $cotizacion->tipo_contenedor }}) | ${{ number_format($cotizacion->subtotal - ($cotizacion->distancia_km * 12.5), 2) }} MXN |
| Costo por distancia | ${{ number_format($cotizacion->distancia_km * 12.5, 2) }} MXN |
| Subtotal | ${{ number_format($cotizacion->subtotal, 2) }} MXN |
@if($cotizacion->requiere_custodia)
| Custodia de seguridad | ${{ number_format($cotizacion->costo_custodia, 2) }} MXN |
@endif
| **Total** | **${{ number_format($cotizacion->total, 2) }} MXN** |
@endcomponent

@if($cotizacion->requiere_custodia)
> **Nota:** Esta cotización incluye custodia de seguridad porque el valor del flete supera el umbral establecido.
@endif

Gracias,
{{ config('app.name') }}
@endcomponent
