<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private string $sistemaPrompt = <<<PROMPT
Eres un asistente virtual especializado en logística de traslado de contenedores para la empresa LogísticaMX.
Tu función es ayudar a los clientes a entender el servicio y resolver dudas sobre cotizaciones.

Información del servicio:
- Transportamos contenedores de 20 pies, 40 pies estándar y 40 pies High Cube (HC).
- El precio depende de la distancia en kilómetros, el tipo de contenedor y el peso de la carga.
- Si el valor del flete supera cierto umbral, se activa automáticamente un servicio de custodia de seguridad.
- La custodia es un servicio de escolta y vigilancia durante el traslado para cargas de alto valor.
- Los contenedores de 20 pies tienen capacidad para hasta 25 toneladas.
- Los contenedores de 40 pies tienen capacidad para hasta 27 toneladas.
- El contenedor 40 HC es igual al de 40 pies pero con mayor altura interior (2.70m vs 2.39m).
- Operamos en toda la República Mexicana.

Reglas:
- Responde siempre en español.
- Sé breve y directo, máximo 3 párrafos cortos.
- No inventes precios específicos, dile al cliente que el sistema los calcula automáticamente.
- Si te preguntan algo fuera del tema logístico, redirige amablemente la conversación al servicio.
PROMPT;

    public function responder(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string|max:500',
        ]);

        try {
            $response = Http::timeout(30)->post('http://localhost:11434/api/generate', [
                'model'  => 'llama3.2:1b',
                'prompt' => $this->sistemaPrompt . "\n\nCliente pregunta: " . $request->mensaje,
                'stream' => false,
            ]);

            if (!$response->ok()) {
                return response()->json(['respuesta' => 'El asistente no está disponible en este momento.']);
            }

            $texto = $response->json('response') ?? 'No pude procesar tu pregunta.';

            return response()->json(['respuesta' => trim($texto)]);

        } catch (\Exception $e) {
            return response()->json(['respuesta' => 'El asistente no está disponible en este momento.']);
        }
    }
}
