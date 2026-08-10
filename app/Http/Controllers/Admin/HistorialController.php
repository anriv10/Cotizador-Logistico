<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Mail\CotizacionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HistorialController extends Controller
{
    public function index(Request $request)
    {
        $query = Cotizacion::query()->orderByDesc('created_at');

        if ($request->filled('cliente')) {
            $query->where('cliente_nombre', 'like', '%' . $request->cliente . '%');
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }

        if ($request->filled('monto_min')) {
            $query->where('total', '>=', $request->monto_min);
        }

        if ($request->filled('monto_max')) {
            $query->where('total', '<=', $request->monto_max);
        }

        $cotizaciones = $query->paginate(15);

        return view('admin.historial', compact('cotizaciones'));
    }

    public function actualizarEstado(Request $request, int $id)
    {
        $request->validate([
            'estado' => 'required|in:borrador,enviada,aceptada,rechazada',
        ]);

        $cotizacion = Cotizacion::findOrFail($id);
        $cotizacion->update(['estado' => $request->estado]);

        try {
            if ($request->estado === 'aceptada') {
                sleep(2);
                Mail::to($cotizacion->cliente_correo)->send(new \App\Mail\CotizacionAceptadaMail($cotizacion));
            } elseif ($request->estado === 'enviada') {
                sleep(2);
                Mail::to($cotizacion->cliente_correo)->send(new \App\Mail\CotizacionEnviadaMail($cotizacion));
            } elseif ($request->estado === 'rechazada') {
                sleep(2);
                Mail::to($cotizacion->cliente_correo)->send(new \App\Mail\CotizacionRechazadaMail($cotizacion));
            }
        } catch (\Exception $e) {
            \Log::warning('Error al notificar cliente: ' . $e->getMessage());
        }

        return back()->with('exito', 'Estado actualizado correctamente.');
    }

    public function reenviar(int $id)
    {
        $cotizacion = Cotizacion::findOrFail($id);

        try {
            $correoSecretaria = env('SECRETARY_EMAIL', 'secretaria@empresa.com');
            Mail::to($correoSecretaria)->send(new CotizacionMail($cotizacion));
            return back()->with('exito', 'Correo reenviado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al reenviar el correo.');
        }
    }
}
