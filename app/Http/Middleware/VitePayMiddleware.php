<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateIfMatchUseragent
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!isset($_SERVER['HTTP_USER_AGENT']) || ($_SERVER['HTTP_USER_AGENT'] !== 'VitePay (+https://vitepay.dev)')) {
            abort(403, 'Permission denied');
        }

        return $next($request);
    }
}