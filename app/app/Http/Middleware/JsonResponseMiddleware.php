<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Procesa la solicitud y obtiene la respuesta
        $response = $next($request);

        // Solo modificar respuestas JSON
        $originalContent = $response->getContent();
        $contentJson = json_decode($originalContent, true);
        // Estructura de respuesta estándar
        $formattedResponse = [
            'success' => $response->isSuccessful(),
            'data' => $contentJson,
            'message' => $response->isSuccessful() ? 'Request was successful' : $response->getStatusCode(),
            'status' => $response->getStatusCode(),
        ];

        // Si es un error, incluye el mensaje del error
        if (!$response->isSuccessful() && isset($contentJson['message'])) {
            $formattedResponse['message'] = $contentJson['message'];
        }

        // Establecer la nueva estructura de respuesta
        $response->setContent(json_encode($formattedResponse));


        return $response;
    }
}
