<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlterarPedido
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
        /*if(!is_int($request->input('id'))){
            return "A variável id de pedido deve ser inteira";
        }

        if(!is_int($request->input('status'))){
            return "A variável status deve ser inteira.";
        }*/

        return $next($request);
    }
}
