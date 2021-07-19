<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

      // dd($request);
      if (!session()->has('adminId') && $request->path() != 'admin/login') {
        return redirect('admin/login');
      }
        return $next($request)->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
