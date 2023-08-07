<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoReloadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $shouldAutoReload = false;

        // Adjust the route names for which you want to apply auto-reload
        $autoReloadRoutes = ['admin.auth.recharge', 'admin.auth.withdraw', 'admin.auth.users.list'];

        $currentRouteName = \Route::currentRouteName(); // Get the current route name

        if (in_array($currentRouteName, $autoReloadRoutes) && isset($_COOKIE['autoReload']) && $_COOKIE['autoReload'] === 'true') {
            $shouldAutoReload = true;
        }

        if ($shouldAutoReload) {
            \Log::debug('AutoReloadMiddleware is being executed.');

            $response = $next($request);

            // Add 'Refresh' header to auto-reload the page every 10 seconds
            $response->headers->set('Refresh', '10');

            return $response;
        }
        return $next($request);
    }
}
