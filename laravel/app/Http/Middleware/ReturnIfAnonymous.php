<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class ReturnIfAnonymous
{
    public function handle(Request $req, Closure $next)
    {
        $refId = Session::get('user');

        if(is_null($refId))
        {
            return redirect('login');
        }

        return $next($req);
    }
}
