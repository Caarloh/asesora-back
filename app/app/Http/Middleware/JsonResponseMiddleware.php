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
        $data = json_decode($response->getContent(), true);


        // Estructura de respuesta estándar
        $formattedResponse = [
            'success' => true,
            'data' => $data,
            'message' => 'hola soy api',
            'status' => 1,
        ];

        return new Response(json_encode($formattedResponse));
    }
}
