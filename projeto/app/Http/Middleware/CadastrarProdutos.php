<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CadastrarProdutos
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
        if(strlen($request->input('preco')) == 0){
            return view('cadastroProdutos',['msg' => 'Campo de preço está vazio']);
        }


        if(strlen($request->input('nome')) == 0){
            return view('cadastroProdutos',['msg' => 'Campo de nome está vazio']);
        }


        if(sizeof(explode('.', $request->input('preco'))) == 1){
            return view('cadastroProdutos',['msg' => 'Campo de preço deve ser escrito na forma 0.00']);
        }

        return $next($request);
    }
}
