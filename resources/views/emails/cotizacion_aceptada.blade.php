@component('mail::message')
# ¡Su cotización ha sido aceptada!

Estimado/a **{{ $cotizacion->cliente_nombre }}**,

Nos complace informarle que su cotización de traslado ha sido **aceptada** por nuestro equipo. En breve nos pondremos en contacto con usted para confirmar la fecha y hora del servicio.

@component('mail::panel')
**Folio:** #{{ str_pad($cotizacion->id, 4, '0', STR_PAD_LEFT) }}
**Ruta:** {{ $cotizacion->origen }} → {{ $cotizacion->destino }}
**Contenedor:** {{ strtoupper(str_replace('_', ' ', $cotizacion->tipo_contenedor)) }}
**Total:** ${{ number_format($cotizacion->total, 2) }} MXN
@if($cotizacion->requiere_custodia)
**Custodia:** Incluida ✅
@endif
@endcomponent

@component('mail::table')
| Concepto | Monto |
|:---------|------:|
| Subtotal | ${{ number_format($cotizacion->subtotal, 2) }} MXN |
@if($cotizacion->requiere_custodia)
| Custodia de seguridad | ${{ number_format($cotizacion->costo_custodia, 2) }} MXN |
@endif
| **Total** | **${{ number_format($cotizacion->total, 2) }} MXN** |
@endcomponent

Si tiene alguna pregunta o necesita modificar algún detalle, no dude en contactarnos.

Gracias por confiar en LogísticaMX.

Atentamente,
**Equipo LogísticaMX**
@endcomponent

