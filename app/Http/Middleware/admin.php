<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { //it use to check password of admin if pass is currect the it show dashboard 
        if (!Auth::guard('admin')->check()) {
             return redirect('/admin/login');
        }
        return $next($request);
    }
}
