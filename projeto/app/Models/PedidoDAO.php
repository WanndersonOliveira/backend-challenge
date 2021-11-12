<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PedidoDAO
{
    //use HasFactory;

    /*
		status 
			0 -> Pendente
			1 -> Em preparo
			2 -> Em entrega
			3 -> Entregue
			4 -> Cancelado
    */


    public function cadastrar($idCliente, $idProdutos, $dataCriacao){
    	$pedido = new Pedido();

    	$pedido->cod_cli = $idCliente;
    	$pedido->data_criacao = $dataCriacao;
    	$pedido->status = 0;

    	$pedido->save();

    	foreach($idProdutos as $id){

    		$pedprod = new PedProd();

    		$pedprod->cod_ped = $pedido->id;
    		$pedprod->cod_prod = $id;

    		$pedprod->save();
    	}

    	return true;
    }

    public function listar($idCliente){
    	$pedidos = Pedido::where('cod_cli',$idCliente)->get();

    	return $pedidos;
    }


    public function selecionar($id){
        $pedido = Pedido::find($id);

        return $pedido;
    }


    public function selecionarProdutos($id){
    	$pedprod = PedProd::where('cod_ped',$id)->get();

    	$produtos = [];

    	foreach($pedprod as $p){
    		$produto = Produto::find($p->cod_prod);

    		array_push($produtos, $produto);
    	}

    	return $produtos;
    }

    public function deletar($id){

    	//$pedprod = PedProd::where('cod_ped',$id)->get();

    	//error_log($id);

    	//foreach($pedprod as $p){
    	//	$p->delete();
    	DB::table('ped_prod')->where('cod_ped', '=', $id)->delete();;
    	//}

    	$pedido = Pedido::find($id);

    	$pedido->delete();

    	return true;
    }

    public function alterarAdmin($id, $status){
        $pedido = Pedido::find($id);

        $pedido->status = $status;

        $pedido->save();

        return true;
    }


    public function alterar($id, $idCliente,$idProdutos,$dataCriacao){
    	$pedprod = PedProd::where('cod_ped',$id)->get();

    	foreach($idProdutos as $idProd){
    		foreach($pedprod as $p){
    			if($p->cod_prod == $idProd){
    				DB::table('ped_prod')->where('cod_prod', '=', $idProd)->delete();
    			} else {
    				$ped = new PedProd();

    				$ped->cod_ped = $id;
    				$ped->cod_prod = $idProd;

    				$ped->save();
    			}
    		}
    	}

    	return true;

    }



    public function mostrar(){

    	$pedido = Pedido::all();

    	return $pedido;
    }

}
