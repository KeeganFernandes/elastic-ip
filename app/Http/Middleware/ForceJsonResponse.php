<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $acceptHeader = strtolower($request->headers->get('accept'));
        $contentType = strtolower($request->headers->get('content-type'));

        if ('application/json' !== $acceptHeader) {
            $request->headers->set('Accept', 'application/json');
        }

        if ('application/json' !== $contentType) {
            $request->headers->set('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
