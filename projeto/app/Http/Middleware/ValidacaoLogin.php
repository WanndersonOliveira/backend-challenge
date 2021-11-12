<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidacaoLogin
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
        if(strlen($request->input('email')) == 0){
            return view('welcome',['msg' => "Email não informado."]);
        }

        if(sizeof(explode('@',$request->input('email'))) < 2){
            return view('welcome',['msg' => "Email não tem padrão usuario@servidor.com"]);
        }

        if(strlen($request->input('senha')) == 0){
            return view('welcome',['msg' => "Senha não informado."]);
        }




        return $next($request);
    }
}
