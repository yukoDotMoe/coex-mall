<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class StoreReferralCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->query('ref')) {
            $referral = $request->query('ref');
            $request->query->remove('ref'); // Remove the 'ref' parameter from the URL query
            Cookie::queue('referral', $referral, 1440); // Store the referral in a cookie for 24 hours
            return redirect()->to($request->url());
        }

        return $next($request);
    }
}
