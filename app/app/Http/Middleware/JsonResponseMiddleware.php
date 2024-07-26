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
         if ($response instanceof Response && $request->expectsJson()) {
             $originalContent = $response->getContent();
             $data = json_decode($originalContent, true);
 
             // Estructura de respuesta estándar
             $formattedResponse = [
                 'success' => $response->isSuccessful(),
                 'data' => $data,
                 'message' => $response->isSuccessful() ? 'Request was successful' : $response->getStatusCode(),
                 'status' => $response->getStatusCode(),
             ];
 
             // Si es un error, incluye el mensaje del error
             if (!$response->isSuccessful() && isset($data['message'])) {
                 $formattedResponse['message'] = $data['message'];
             }
 
             // Establecer la nueva estructura de respuesta
             $response->setContent(json_encode($formattedResponse));
         }
 
         return $response;
    }
}
