<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class isSystemCustomer
{
    protected $auth;
    protected $route;
    public function __constructor(Guard $auth, Route $route)
    {
    $this->auth = $auth;
    $this->route = $route;
    }
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->is_system_admin == 1){
            return new Response('<center>401<br>ACCESS DENIED</center>', 401);
        }
        return $next($request);
    }
}
// ($this->auth->user()->is_system_admin !=1
// (Auth::user()->user_type == 'Administrator')
