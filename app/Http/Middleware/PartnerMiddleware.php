<?php

namespace App\Http\Middleware;

use App\Models\PlatformUser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && PlatformUser::isPartner()) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
