<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReportAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		if ( !auth()->guard('login')->check() ) {
			session(['url.intended' => route('report')]);
            return redirect()->route( 'login' );
        }
        return $next($request);
    }
}
