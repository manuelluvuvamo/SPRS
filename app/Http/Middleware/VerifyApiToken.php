<?php

namespace App\Http\Middleware;

use App\Models\Entity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'API token not provided'], 401);
        }

        $entity = Entity::where('api_token', $token)->first();
        if (!$entity) {
            return response()->json(['error' => 'Invalid API Token'], 401);
        }

        // Adicione a entidade à requisição para uso posterior, se necessário
        $request->merge(['entity' => $entity]);

        return $next($request);
    }
}
