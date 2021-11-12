<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClienteDAO;
use App\Models\Cliente;
use App\Models\PedidoDAO;
use App\Models\ProdutoDAO;

class ClienteController extends Controller
{

    public function cadastrar(Request $req){
    	$clienteDAO = new ClienteDAO();

    	$obj['msg'] = "O usuário foi cadastrado com sucesso!";

    	$check = $clienteDAO->checar($req->input('email'),$req->input('telefone'),$req->input('senha'));

    	switch ($check) {
    		case 0:
    			$clienteDAO->cadastrar($req->input('nome'),$req->input('endereco'),$req->input('telefone'),$req->input('email'),$req->input('senha'));
    			break;
    		case 1:
    			$obj['msg'] = "O usuário não foi cadastrado: Email, senha e telefone já existem!";
    			break;

    		case 2:

    			$obj['msg'] = "O usuário não foi cadastrado: Telefone e email já existem!";
    			break;

    		default:
    			$obj['msg'] = "Um erro ocorreu!";
    			break;
    	}
    	

    	$json = json_encode($obj);

    	return $json;
    }


    public function login(Request $req){

    	$clienteDAO = new ClienteDAO();

    	$usuario = $clienteDAO->autenticar($req->input('email'),$req->input('senha'));

    	$obj['msg'] = "Um erro ocorreu na autenticação de usuário";
    
    	if(is_null($usuario)){
    		return response()->json($obj);
    	}


    	return response()->json($usuario);
    }

    public function logoff(Request $req){

        return response()->json(["msg" => "Usuário deslogado com sucesso!"]);
    }

    public function mostrarProdutos(Request $req){

        if(!isset($req->id)){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }


        $produtoDAO = new ProdutoDAO();

        $produtos = $produtoDAO->listar();

        if(sizeof($produtos) == 0){
            return response()->json(["msg" => "Nenhum produto cadastrado"]);
        }

        return response()->json($produtos);
    }


    public function cadastrarPedido(Request $req){

        if(is_null($req->input('id'))){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        $pedidoDAO = new PedidoDAO();


        if($pedidoDAO->cadastrar($req->input('id'), $req->input('idProduto'), $req->input('data'))){
            return response()->json(["msg" => "O pedido foi cadastrado com sucesso!"]);
        }

        return response()->json(["msg" => "Algum erro ocorreu! O pedido não foi cadastrado."]);

    }

    public function listarPedidos(Request $req){

        if(is_null($req->id)){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        $pedidoDAO = new PedidoDAO();

        $pedidos = $pedidoDAO->listar($req->input('id'));

        if(sizeof($pedidos) == 0){
            return response()->json(['msg' => 'Nenhum pedido foi realizado pelo cliente']);
        }

        return response()->json($pedidos);

    }

    public function verPedido(Request $req, $id){
        if(is_null($req->id)){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        $pedidoDAO = new PedidoDAO();

        $produtos = $pedidoDAO->selecionarProdutos($id);

        if(sizeof($produtos) == 0){
            return response()->json(["msg" => "Nenhum produto foi cadastrado no pedido."]);
        }

        return response()->json($produtos);
    }

    public function excluirPedido(Request $req, $id){
        if(is_null($req->input('id'))){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        $pedidoDAO = new PedidoDAO();

        error_log($id);

        if($pedidoDAO->deletar($id)){
            return response()->json(["msg" => "Pedido deletado com sucesso!"]);   
        }

        return response()->json(["msg" => "Um erro ocorreu. Não foi possível deletar o pedido."]);


    }


    public function alterarPedido(Request $req, $id){
        
        if(is_null($req->input('id'))){
            return response()->json(["msg" => "Para cadastrar pedido o cliente deve estar logado"]);
        }

        $pedidoDAO = new PedidoDAO();

        if($pedidoDAO->alterar($id, $req->input('id'),$req->input('idProduto'),$req->input('data'))){
            return response()->json(["msg" => "Pedido alterado com sucesso!"]);
        }

        return response()->json(["msg" => "Um erro ocorreu! O pedido não foi alterado."]);
    }

}
