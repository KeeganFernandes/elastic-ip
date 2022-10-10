<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->headers->get('X-Bearer-Token') ?? $request->headers->get('Authorization');

        $token = Str($token)->remove('Bearer ')->toString();

        if (!$token) {
            return abort(401, 'Authorization header missing from request');
        }

        try {
            $response = Http::withToken($token)
                ->withHeaders([
                    'Accept' => 'application/json',
                ])->get(app('config')->get('services.tokenauth.auth_api') . '/user');

            if ($response->failed()) {
                return response()->json($response->json(), $response->status());
            }
        } catch (\Throwable $th) {
            return abort(401, 'There was a problem authenticating your request');
        }

        $user =  $response->json();

        $request->merge([
            'user' => $user,
        ]);

        $request->setUserResolver(function () use ($user) {
            return json_decode(json_encode($user), false);
        });

        return $next($request);
    }
}
