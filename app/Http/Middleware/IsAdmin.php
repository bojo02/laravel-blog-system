<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(!auth()->user()->isAdmin()){
                return redirect(route('home'))->with('wrong', 'Only admins can access this page...');
            }
        }
        else{
            return redirect(route('home'))->with('wrong', 'Only admins can access this page...');
        }
        

        return $next($request);
    }
}