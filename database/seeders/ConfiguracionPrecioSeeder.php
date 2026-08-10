<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfiguracionPrecio;

class ConfiguracionPrecioSeeder extends Seeder
{
    public function run(): void
    {
        $configuraciones = [
            ['clave' => 'tarifa_base_20',      'valor' => 5000.00,  'descripcion' => 'Tarifa base contenedor 20 pies'],
            ['clave' => 'tarifa_base_40',      'valor' => 7500.00,  'descripcion' => 'Tarifa base contenedor 40 pies'],
            ['clave' => 'tarifa_base_40hc',    'valor' => 8500.00,  'descripcion' => 'Tarifa base contenedor 40 HC'],
            ['clave' => 'precio_por_km',       'valor' => 12.50,    'descripcion' => 'Precio por kilómetro recorrido'],
            ['clave' => 'precio_por_tonelada', 'valor' => 150.00,   'descripcion' => 'Cargo adicional por tonelada'],
            ['clave' => 'umbral_custodia',     'valor' => 15000.00, 'descripcion' => 'Monto a partir del cual se activa custodia'],
            ['clave' => 'costo_custodia',      'valor' => 3500.00,  'descripcion' => 'Costo fijo del servicio de custodia'],
        ];

        foreach ($configuraciones as $config) {
            ConfiguracionPrecio::updateOrCreate(
                ['clave' => $config['clave']],
                ['valor' => $config['valor'], 'descripcion' => $config['descripcion']]
            );
        }
    }
}
