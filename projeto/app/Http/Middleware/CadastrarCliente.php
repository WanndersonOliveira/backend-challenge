<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CadastrarCliente
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
        /*$validated = $request->validate([
            'nome' => ['required'], //'regex:^[a-zA-Z ]*$/'],
            'endereco' => ['required'],
            'telefone' => ['required'],// 'regex:^[0-9\-\+]{9,15}$'],
            'email' => ['required'],//'regex:^.+@.+$/i'],
            'senha' => ['required', 'max:20'],
        ]);*/

        if(strlen($request->input('email')) == 0 | is_null($request->input('email'))){
            return response()->json(['msg' => 'Email não informado.']);
        }

        if(strlen($request->input('telefone')) == 0 | is_null($request->input('telefone'))){
            return response()->json(['msg' => 'Telefone não informado.']);   
        }

        if(strlen($request->input('senha')) == 0 | is_null($request->input('senha'))){
            
            return response()->json(['msg' => 'Senha não informada.']);
        }

        if(strlen($request->input('nome')) == 0 | is_null($request->input('nome'))){
            
            return response()->json(['msg' => 'Nome não informado.']);
        }

        if(strlen($request->input('endereco')) == 0 | is_null($request->input('endereco'))){
            
            return response()->json(['msg' => 'Endereço não informado.']);
        }

        if(sizeof(explode('@', $request->input('email'))) != 2){

            return response()->json(['msg' => 'Email não está no formato: usuario@servidor.com.']);
        }




        return $next($request);
    }
}
