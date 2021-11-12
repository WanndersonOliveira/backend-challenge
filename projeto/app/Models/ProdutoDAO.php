<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDAO
{
    //use HasFactory;

    public function cadastrar($nome, $preco){
    	$produto = new Produto();
    	$produto->nome = $nome;
    	$produto->preco = (float) $preco;      //Precisa melhorar

    	$produto->save();

    	return true;
    }

    public function listar(){
    	$produto = Produto::all();

    	return $produto;
    }

    public function selecionar($id){
      $produto = Produto::find($id);

      return $produto;
    }

    public function deletar($id){
    	$produto = Produto::find($id);

    	$produto->delete();          //Precisa melhorar

    	return 0;
    }

    public function selecionarPorPedido($idPed){
      $pedprod = PedProd::find($idPed);  

      $produtos = [];

      foreach ($pedprod as $p) {
          $produto = Produto::find($p->cod_prod);

          array_push($produtos, $produto);
      }

      return $produtos;
    }

   	public function alterar($id,$nome,$preco){
   		$produto = Produto::find($id);

   		$produto->nome = $nome;
   		$produto->preco = $preco;  //Precisa melhorar

   		$produto->save();

   		return 0;
   	}
}
