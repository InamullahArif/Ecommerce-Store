<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Log the visit to the 'visitors' table
        DB::table('visitors')->insert([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
