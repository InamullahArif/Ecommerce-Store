<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user());
        // return $next($request);
        // if (Auth::check() && auth()->user()->can($permission)) {
            // return $next($request);
        // }

        // return redirect('/')->with('error', 'You do not have permission to access this page.');
        // getPermissions();
      
    //    $permissions = GeneralHelper::getPermissions();
    //     // dd($request->user());
    //     // $permissions_array = explode('|', $permissions);
    //     foreach($permissions as $permission){
    //         dd($request->user()->can($permission),$permission,$request->user()->name);
    //         if ($request->user()->can($permission)){
                return $next($request);                        
        //     }
        // }    
        // return redirect()->back(); 
    }
}
