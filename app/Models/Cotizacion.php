<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [
        'cliente_nombre',
        'cliente_correo',
        'origen',
        'destino',
        'distancia_km',
        'tipo_contenedor',
        'peso_toneladas',
        'requiere_custodia',
        'subtotal',
        'costo_custodia',
        'total',
        'estado',
        'cliente_telefono',
        'fecha_estimada',
        'notas',
    ];

    protected $casts = [
        'requiere_custodia' => 'boolean',
        'distancia_km'      => 'float',
        'peso_toneladas'    => 'float',
        'subtotal'          => 'float',
        'costo_custodia'    => 'float',
        'total'             => 'float',
    ];

    public static function calcular(
        string $tipo_contenedor,
        float $distancia_km,
        float $peso_toneladas
    ): array {
        $tarifa_base = match($tipo_contenedor) {
            '20_pies' => ConfiguracionPrecio::obtener('tarifa_base_20'),
            '40_pies' => ConfiguracionPrecio::obtener('tarifa_base_40'),
            '40_hc'   => ConfiguracionPrecio::obtener('tarifa_base_40hc'),
            default   => 0.0,
        };

        $costo_distancia = $distancia_km * ConfiguracionPrecio::obtener('precio_por_km');
        $costo_peso      = $peso_toneladas * ConfiguracionPrecio::obtener('precio_por_tonelada');

        $subtotal = $tarifa_base + $costo_distancia + $costo_peso;

        $umbral          = ConfiguracionPrecio::obtener('umbral_custodia');
        $costo_custodia  = 0.0;
        $requiere_custodia = false;

        if ($subtotal > $umbral) {
            $requiere_custodia = true;
            $costo_custodia    = ConfiguracionPrecio::obtener('costo_custodia');
        }

        $total = $subtotal + $costo_custodia;

        return [
            'tarifa_base'       => $tarifa_base,
            'costo_distancia'   => $costo_distancia,
            'costo_peso'        => $costo_peso,
            'subtotal'          => $subtotal,
            'requiere_custodia' => $requiere_custodia,
            'costo_custodia'    => $costo_custodia,
            'total'             => $total,
        ];
    }
}

