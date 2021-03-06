<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCliente
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

        if(strlen($request->input('email')) == 0 | is_null($request->input('email'))){
            return response()->json(["msg" => "Email não informado"]);
        }

        if(strlen($request->input('senha')) == 0 | is_null($request->input('senha'))){
            return response()->json(["msg" => "Senha não informada"]);
        }

        if(sizeof(explode('@',$request->input('email'))) == 1){
            return response()->json(["msg" => "Email deve ter @"]);
        }
        /*$validated = $request->validate([
            'email' => ['required'],//'regex:/^.+@.+$/i'],
            'senha' => ['required', 'max:20'],
        ]);*/

        return $next($request);
    }
}
