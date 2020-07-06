<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('Apikey') !== env('API_KEY')){
          return response()->json(['error' => 'Invalid api key'], 400);
        }
        return $next($request);
    }
}
