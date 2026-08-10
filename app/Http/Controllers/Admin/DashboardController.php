<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas generales
        $totalCotizaciones  = Cotizacion::count();
        $totalFacturado     = Cotizacion::sum('total');
        $cotizacionesHoy    = Cotizacion::whereDate('created_at', today())->count();
        $aceptadas          = Cotizacion::where('estado', 'aceptada')->count();
        $rechazadas         = Cotizacion::where('estado', 'rechazada')->count();
        $conCustodia        = Cotizacion::where('requiere_custodia', true)->count();

        // Tasa de aceptación
        $tasaAceptacion = $totalCotizaciones > 0
            ? round(($aceptadas / $totalCotizaciones) * 100, 1)
            : 0;

        // Cotizaciones por mes (últimos 6 meses)
        $porMes = Cotizacion::select(
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('YEAR(created_at) as anio'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total) as monto')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('anio', 'mes')
            ->orderBy('anio')
            ->orderBy('mes')
            ->get();

        // Distribución por tipo de contenedor
        $porContenedor = Cotizacion::select('tipo_contenedor', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_contenedor')
            ->get();

        // Distribución por estado
        $porEstado = Cotizacion::select('estado', DB::raw('COUNT(*) as total'))
            ->groupBy('estado')
            ->get();

        // Rutas más frecuentes
        $rutasFrecuentes = Cotizacion::select(
                'origen', 'destino',
                DB::raw('COUNT(*) as veces'),
                DB::raw('AVG(total) as promedio')
            )
            ->groupBy('origen', 'destino')
            ->orderByDesc('veces')
            ->limit(5)
            ->get();

        // Últimas 5 cotizaciones
        $ultimasCotizaciones = Cotizacion::orderByDesc('created_at')->limit(5)->get();

        // Promedio por cotización
        $promedioPorCotizacion = $totalCotizaciones > 0
            ? round($totalFacturado / $totalCotizaciones, 2)
            : 0;

        return view('admin.dashboard', compact(
            'totalCotizaciones',
            'totalFacturado',
            'cotizacionesHoy',
            'aceptadas',
            'rechazadas',
            'conCustodia',
            'tasaAceptacion',
            'porMes',
            'porContenedor',
            'porEstado',
            'rutasFrecuentes',
            'ultimasCotizaciones',
            'promedioPorCotizacion'
        ));
    }
}
