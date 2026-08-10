<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionPrecio;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $configuraciones = ConfiguracionPrecio::all()->keyBy('clave');

        return view('admin.configuracion', compact('configuraciones'));
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'tarifa_base_20'      => 'required|numeric|min:0',
            'tarifa_base_40'      => 'required|numeric|min:0',
            'tarifa_base_40hc'    => 'required|numeric|min:0',
            'precio_por_km'       => 'required|numeric|min:0',
            'precio_por_tonelada' => 'required|numeric|min:0',
            'umbral_custodia'     => 'required|numeric|min:0',
            'costo_custodia'      => 'required|numeric|min:0',
        ]);

        foreach ($request->only([
            'tarifa_base_20',
            'tarifa_base_40',
            'tarifa_base_40hc',
            'precio_por_km',
            'precio_por_tonelada',
            'umbral_custodia',
            'costo_custodia',
        ]) as $clave => $valor) {
            ConfiguracionPrecio::where('clave', $clave)->update(['valor' => $valor]);
        }

        return redirect()->route('admin.configuracion.index')
            ->with('exito', 'Precios actualizados correctamente.');
    }
}
