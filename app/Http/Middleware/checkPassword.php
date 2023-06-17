<?php

namespace App\Http\Middleware;

use Closure;

class checkPassword
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
        if ($request->API_PASSWORD != env('API_PASSWORD', '7snaLHkWDk4NnrNoPWR1Em7BgG5Hkhx1g')) {
            return response()->json('Unauthorized');
        }
        return $next($request);
    }
}
