<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1a1a2e; background: #fff; }

        .header { background: #1e3a5f; color: white; padding: 28px 36px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 22px; font-weight: 700; letter-spacing: -0.5px; }
        .header .sub { font-size: 11px; opacity: 0.7; margin-top: 2px; }
        .badge { background: rgba(255,255,255,0.15); border-radius: 6px; padding: 6px 14px; font-size: 13px; font-weight: 700; }

        .body { padding: 32px 36px; }

        .meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px; }
        .meta-card { background: #f8fafc; border-radius: 10px; padding: 16px 20px; border: 1px solid #e2e8f0; }
        .meta-card .titulo { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin-bottom: 10px; }
        .meta-card .fila { display: flex; justify-content: space-between; margin-bottom: 6px; }
        .meta-card .fila .key { color: #64748b; }
        .meta-card .fila .val { font-weight: 600; color: #0f172a; }

        .ruta { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 16px 20px; margin-bottom: 28px; display: flex; justify-content: space-between; align-items: center; }
        .ruta .punto { font-size: 13px; font-weight: 700; color: #1e3a5f; }
        .ruta .flecha { color: #3b82f6; font-size: 18px; }
        .ruta .distancia { font-size: 11px; color: #3b82f6; font-weight: 600; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        thead tr { background: #1e3a5f; color: white; }
        thead th { padding: 10px 16px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        tbody tr { border-bottom: 1px solid #f1f5f9; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody td { padding: 10px 16px; }
        tbody td.monto { text-align: right; font-weight: 600; }

        .custodia-row { background: #fffbeb !important; }
        .custodia-row td { color: #92400e; }

        .total-box { background: #1e3a5f; color: white; border-radius: 10px; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .total-box .label { font-size: 13px; opacity: 0.8; }
        .total-box .monto { font-size: 24px; font-weight: 800; }

        .custodia-aviso { background: #fffbeb; border: 1px solid #fcd34d; border-radius: 8px; padding: 12px 16px; margin-bottom: 24px; font-size: 11px; color: #92400e; }
        .custodia-aviso strong { display: block; margin-bottom: 2px; }

        .vigencia-aviso { background: #fee2e2; border: 1px solid #ef4444; border-radius: 8px; padding: 12px 16px; margin-bottom: 24px; font-size: 11px; color: #991b1b; text-align: center; }
        .vigencia-aviso strong { display: block; margin-bottom: 3px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }

        /* Estilo para las notas adicionales */
        .notas-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; margin-bottom: 24px; font-size: 11px; color: #475569; }
        .notas-box strong { display: block; margin-bottom: 4px; color: #1e3a5f; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; }

        .footer { border-top: 1px solid #e2e8f0; padding: 16px 36px; display: flex; justify-content: space-between; font-size: 10px; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>

<div class="header">
    <div>
        <div class="sub">COTIZACIÓN OFICIAL</div>
        <h1>LogísticaMX</h1>
    </div>
    <div class="badge"># {{ str_pad($cotizacion->id, 5, '0', STR_PAD_LEFT) }}</div>
</div>

<div class="body">

    <div class="meta-grid">
        <div class="meta-card">
            <div class="titulo">Datos del Cliente</div>
            <div class="fila"><span class="key">Nombre</span><span class="val">{{ $cotizacion->cliente_nombre }}</span></div>
            <div class="fila"><span class="key">Correo</span><span class="val">{{ $cotizacion->cliente_correo }}</span></div>
            <div class="fila"><span class="key">Teléfono</span><span class="val">{{ $cotizacion->cliente_telefono ?? 'No especificado' }}</span></div>
            <div class="fila"><span class="key">Fecha estimada</span><span class="val">{{ $cotizacion->fecha_estimada ? \Carbon\Carbon::parse($cotizacion->fecha_estimada)->format('d/m/Y') : 'No especificada' }}</span></div>
        </div>
        <div class="meta-card">
            <div class="titulo">Detalles de Carga</div>
            <div class="fila"><span class="key">Contenedor</span><span class="val">{{ strtoupper(str_replace('_', ' ', $cotizacion->tipo_contenedor)) }}</span></div>
            <div class="fila"><span class="key">Peso</span><span class="val">{{ $cotizacion->peso_toneladas }} toneladas</span></div>
            <div class="fila"><span class="key">Fecha</span><span class="val">{{ $cotizacion->created_at->format('d/m/Y') }}</span></div>
        </div>
    </div>

    <div class="ruta">
        <div>
            <div class="titulo" style="font-size:9px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Origen</div>
            <div class="punto">{{ $cotizacion->origen }}</div>
        </div>
        <div style="text-align:center;">
            <div class="flecha">→</div>
            <div class="distancia">{{ $cotizacion->distancia_km }} km</div>
        </div>
        <div style="text-align:right;">
            <div class="titulo" style="font-size:9px;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">Destino</div>
            <div class="punto">{{ $cotizacion->destino }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Concepto</th>
                <th style="text-align:right;">Monto (MXN)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tarifa base — {{ strtoupper(str_replace('_', ' ', $cotizacion->tipo_contenedor)) }}</td>
                <td class="monto">${{ number_format($cotizacion->subtotal - ($cotizacion->distancia_km * 12.5) - ($cotizacion->peso_toneladas * 150), 2) }}</td>
            </tr>
            <tr>
                <td>Costo por distancia ({{ $cotizacion->distancia_km }} km)</td>
                <td class="monto">${{ number_format($cotizacion->distancia_km * 12.5, 2) }}</td>
            </tr>
            <tr>
                <td>Recargo por peso ({{ $cotizacion->peso_toneladas }} ton)</td>
                <td class="monto">${{ number_format($cotizacion->peso_toneladas * 150, 2) }}</td>
            </tr>
            @if($cotizacion->requiere_custodia)
            <tr class="custodia-row">
                <td>Servicio de custodia de seguridad</td>
                <td class="monto">${{ number_format($cotizacion->costo_custodia, 2) }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="total-box">
        <div class="label">Total de la Cotización</div>
        <div class="monto">${{ number_format($cotizacion->total, 2) }} MXN</div>
    </div>

    @if($cotizacion->requiere_custodia)
    <div class="custodia-aviso">
        <strong>Custodia de seguridad activada automáticamente</strong>
        El valor del flete supera el umbral establecido por la empresa, por lo que se ha agregado el servicio de custodia como medida de seguridad obligatoria.
    </div>
    @endif

    @if($cotizacion->notas)
    <div class="notas-box">
        <strong>Notas adicionales del traslado:</strong>
        {{ $cotizacion->notas }}
    </div>
    @endif

    <div class="vigencia-aviso">
        <strong>⚠️ AVISO IMPORTANTE</strong>
        Esta cotización es válida únicamente por 15 días a partir de su fecha de emisión. Transcurrido este plazo, los precios estarán sujetos a cambios sin previo aviso.
    </div>

</div>

<div class="footer">
    <span>LogísticaMX — Cotización #{{ str_pad($cotizacion->id, 5, '0', STR_PAD_LEFT) }}</span>
    <span>Generado el {{ now()->format('d/m/Y H:i') }}</span>
</div>

</body>
</html>
