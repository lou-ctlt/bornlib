<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserAuthenticated
{
    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {
            // if user admin take him to his dashboard
            if ( Auth::user()->admin() ) {
                 return redirect(route('admin/dashboard'));
            }

            // allow user to proceed with request
            else if ( Auth::user()->user() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}