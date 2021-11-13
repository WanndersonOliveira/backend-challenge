<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CadastrarProdutosCli
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
        if(is_null($request->input('id'))){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        if(strlen($request->input('id')) == 0){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        if(!is_int($request->input('id'))){
            return response()->json(["msg" => "A variável id deve comportar valor inteiro."]);
        }

        $produtos = $request->input('idProduto');

        if(sizeof($produtos) == 0){
            return response()->json(["msg" => "Não há produtos no pedido. Selecione algum produto para cadastrar o pedido."]);   
        }

        $check = false;

        foreach ($produtos as $produto){
            if(!is_int($produto)){
                $check = true;
            }
        }

        if(explode('-',$request->input('data')) < 3){
            return response()->json(["msg" => "As datas devem ser enviadas no formato yyyy-mm-dd."]);
        }



        if($check){
            return response()->json(["msg" => "O valor do id do produto deve ser inteiro."]);
        }

        return $next($request);
    }
}
