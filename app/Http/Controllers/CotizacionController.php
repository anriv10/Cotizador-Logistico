<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\ConfiguracionPrecio;
use App\Mail\CotizacionMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CotizacionController extends Controller
{
    public function index()
    {
        return view('cotizacion.index');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'tipo_contenedor' => 'required|in:20_pies,40_pies,40_hc',
            'distancia_km'    => 'required|numeric|min:1',
            'peso_toneladas'  => 'required|numeric|min:0.1',
        ]);

        $resultado = Cotizacion::calcular(
            $request->tipo_contenedor,
            (float) $request->distancia_km,
            (float) $request->peso_toneladas
        );

        return response()->json($resultado);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'cliente_nombre'  => 'required|string|max:255',
            'cliente_correo'  => 'required|email|max:255',
            'origen'          => 'required|string|max:255',
            'destino'         => 'required|string|max:255',
            'tipo_contenedor' => 'required|in:20_pies,40_pies,40_hc',
            'distancia_km'    => 'required|numeric|min:1',
            'peso_toneladas'     => 'required|numeric|min:0.1',
            'cliente_telefono'   => 'nullable|string|max:20',
            'fecha_estimada'     => 'nullable|date|after:today',
            'notas'              => 'nullable|string|max:500',
        ]);

        $calculo = Cotizacion::calcular(
            $request->tipo_contenedor,
            (float) $request->distancia_km,
            (float) $request->peso_toneladas
        );

        $cotizacion = Cotizacion::create([
            'cliente_nombre'    => $request->cliente_nombre,
            'cliente_correo'    => $request->cliente_correo,
            'origen'            => $request->origen,
            'destino'           => $request->destino,
            'distancia_km'      => $request->distancia_km,
            'tipo_contenedor'   => $request->tipo_contenedor,
            'peso_toneladas'    => $request->peso_toneladas,
            'requiere_custodia' => $calculo['requiere_custodia'],
            'subtotal'          => $calculo['subtotal'],
            'costo_custodia'    => $calculo['costo_custodia'],
            'total'             => $calculo['total'],
            'estado'            => 'borrador',
            'cliente_telefono'  => $request->cliente_telefono,
            'fecha_estimada'    => $request->fecha_estimada,
            'notas'             => $request->notas,
        ]);

        try {
            // Se envía ÚNICA y EXCLUSIVAMENTE al Administrador
            $correoAdministrador = env('MAIL_FROM_ADDRESS', 'cotizaciones@logisticamx.com');
            
            Mail::to($correoAdministrador)->cc($cotizacion->cliente_correo)
                ->send(new CotizacionMail($cotizacion));
                
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return view('cotizacion.confirmacion', compact('cotizacion'));
    }

    public function generarPdf(int $id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $pdf = Pdf::loadView('pdf.cotizacion', compact('cotizacion'));

        return $pdf->download("cotizacion-{$cotizacion->id}.pdf");
    }

    public function calcularDistancia(Request $request)
    {
        $request->validate([
            'origen'  => 'required|string',
            'destino' => 'required|string',
        ]);

        try {
            $headersNominatim = [
                'User-Agent' => 'LogisticaMX/1.0 (App Interna)'
            ];

            $geoOrigen = Http::withHeaders($headersNominatim)
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q'            => $request->origen . ', México',
                    'format'       => 'json',
                    'limit'        => 1,
                    'countrycodes' => 'mx'
                ]);

            $geoDestino = Http::withHeaders($headersNominatim)
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q'            => $request->destino . ', México',
                    'format'       => 'json',
                    'limit'        => 1,
                    'countrycodes' => 'mx'
                ]);

            if (!$geoOrigen->ok() || !$geoDestino->ok()) {
                return response()->json(['error' => 'No se pudo conectar con el servicio de geocodificación.'], 422);
            }

            $dataOrigen = $geoOrigen->json();
            $dataDestino = $geoDestino->json();

            if (empty($dataOrigen) || empty($dataDestino)) {
                return response()->json(['error' => 'Ciudad no encontrada. Intenta ser más específica.'], 422);
            }

            $lat1 = $dataOrigen[0]['lat'];
            $lon1 = $dataOrigen[0]['lon'];
            
            $lat2 = $dataDestino[0]['lat'];
            $lon2 = $dataDestino[0]['lon'];

            $urlOsrm = "http://router.project-osrm.org/route/v1/driving/{$lon1},{$lat1};{$lon2},{$lat2}?overview=false";
            
            $ruta = Http::get($urlOsrm);

            if (!$ruta->ok() || empty($ruta->json('routes'))) {
                return response()->json(['error' => 'No se encontró ruta terrestre entre estos dos puntos.'], 422);
            }

            $distanciaMetros = $ruta->json('routes.0.distance');
            $distanciaKm     = round($distanciaMetros / 1000, 1);

            return response()->json(['distancia_km' => $distanciaKm]);

        } catch (\Exception $e) {
            \Log::error("Error en calcularDistancia: " . $e->getMessage());
            return response()->json(['error' => 'Error interno al conectar con el servicio de mapas.'], 500);
        }
    }
}
