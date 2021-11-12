<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\ProdutoDAO;
use App\Models\PedidoDAO;
use App\Models\AdminDAO;
use App\Models\ClienteDAO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function login(){
        return view('welcome');
    }

    public function auth(Request $req){
        /*$this->validate($req,[
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A senha é obrigatória'
        ]);

        $credentials = $req->only('email','password');

        if(Auth::attempt($credentials)){
            dd('logou');
        } else {
            dd('Um erro ocorreu');
        }*/

        if(strlen($req->input('email')) == 0){
            return view('welcome',['msg' => "Email não informado."]);
        }

        if(sizeof(explode('@',$req->input('email'))) < 2){
            return view('welcome',['msg' => "Email não tem padrão usuario@servidor.com"]);
        }

        if(strlen($req->input('senha')) == 0){
            return view('welcome',['msg' => "Senha não informada."]);
        }

        $adminDAO = new AdminDAO();

        $check = $adminDAO->auth($req->input('email'),$req->input('senha'));

        $secret = Hash::make('perfeito');


        if($check == 0){
            $req->session()->put('admin',$secret);

            return view('initial');
        }

        return view('welcome',['msg' => "Email ou senha incorretos."]);
    }


    public function logout(Request $req){
        if($req->session()->has('admin')){

            $req->session()->forget('admin');

            return view('welcome',["msg"=>"Volte sempre!"]);
        }

        
        return view('welcome');
    }

    public function initial(Request $req){
        if($req->session()->has('admin')){

            return view('initial');
        }

        
        return view('welcome',['msg' => 'Você precisa fazer login para fazer essa ação']);
    }


    public function cadastrarProduto(Request $req){
        if(strlen($req->input('preco')) == 0){
            return view('cadastroProdutos',['msg' => 'Campo de preço está vazio']);
        }


        if(strlen($req->input('nome')) == 0){
            return view('cadastroProdutos',['msg' => 'Campo de nome está vazio']);
        }


        if(sizeof(explode('.', $req->input('preco'))) == 1){
            return view('cadastroProdutos',['msg' => 'Campo de preço deve ser escrito na forma 0.00']);
        }


    	$produtoDAO = new ProdutoDAO();


    	if($produtoDAO->cadastrar($req->input('nome'),$req->input('preco'))){
    		return view('cadastroProdutos
    			',['msg' => 'Produto cadastrado com sucesso!']);
    	}
    }

    public function listarProdutos(Request $req){
    	$produtoDAO = new ProdutoDAO();
    	$produtos = $produtoDAO->listar();

    	if(sizeof($produtos)==0){
    		return view('listarProdutos',["msg" => "Nenhum produto foi cadastrado."]);
    	} else {
    		return view('listarProdutos',["produtos" => $produtos]);
    	}
    }

    public function deletarProduto(Request $req, $id){
    	$produtoDAO = new ProdutoDAO();

    	if($produtoDAO->deletar($id) == 0){

            $produtos = $produtoDAO->listar();
    		return view('listarProdutos',['msg' => "Produto deletado com sucesso!","produtos"=>$produtos]);
    	} else {

            $produtos = $produtoDAO->listar();
    		return view('listarProdutos',['msg' => "Um erro ocorreu na deleção do produto","produtos"=>$produtos]);
    	}
    }

    public function atualizarProduto(Request $req, $id){

    	$produtoDAO = new ProdutoDAO();

    	$produto = $produtoDAO->selecionar($id);

    	return view('alterarProduto',['nome' => $produto->nome, 'id'=>$produto->id,'preco' => $produto->preco]);
    }

    public function alterarProduto(Request $req){


        $produtoDAO = new ProdutoDAO();

        $produto = $produtoDAO->selecionar($req->input('id'));

        if(strlen($req->input('preco')) == 0){
            return view('cadastroProdutos',['msg' => 'Campo de preço está vazio','nome' => $produto->nome, 'id'=>$produto->id,'preco' => $produto->preco]);
        }


        if(strlen($req->input('nome')) == 0){
            return view('cadastroProdutos',['msg' => 'Campo de nome está vazio','nome' => $produto->nome, 'id'=>$produto->id,'preco' => $produto->preco]);
        }


        if(sizeof(explode(',', $req->input('preco'))) == 2){
            return view('cadastroProdutos',['msg' => 'Campo de preço deve ser escrito na forma 0.00','nome' => $produto->nome, 'id'=>$produto->id,'preco' => $produto->preco]);
        }


    	if($produtoDAO->alterar($req->input('id'),$req->input('nome'),$req->input('preco')) == 0){
            $produtos = $produtoDAO->listar();
    		return view('listarProdutos',['msg' => 'Produto atualizado com sucesso!',"produtos" => $produtos]);
    	} else {
            $produtos = $produtoDAO->listar();
    		return view('listarProdutos',['msg' => 'Um erro aconteceu na deleção do produto.',"produtos" => $produtos]);
    	}
    }


    public function listarClientes(Request $req){
        $clienteDAO = new ClienteDAO();

        $clientes = $clienteDAO->listar();

        $count = 0;

        if(sizeof($clientes) == 0){
            return view('listarClientes', ["msg" => "Nenhum cliente foi cadastrado","count"=>$count]);
        }
        foreach($clientes as $cliente){
            $count++;
        }

        return view('listarClientes', ["clientes" => $clientes,"count" => $count]);
    }


    public function listarPedidos(Request $req){
        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->mostrar();

        $count = 0;

        $status = ['Pendente', 'Em preparo', 'Em entrega', 'Entregue e Cancelado'];

        if(sizeof($pedidos) == 0){
            return view('listarPedidos', ["msg" => "Nenhum pedido foi cadastrado!"]);
        }

        foreach ($pedidos as $pedido) {
            $count++;
        }

        return view('listarPedidos', ["pedidos" => $pedidos,"count" => $count, "status" => $status]);
    }


    public function visualizarPedidos(Request $req,$id,$id2){
        $pedidoDAO = new PedidoDAO();

        $status = ['Pendente', 'Em preparo', 'Em entrega', 'Entregue', 'Cancelado'];

        $produtos = $pedidoDAO->selecionarProdutos($id2);

        $clienteDAO = new ClienteDAO();

        $cliente = $clienteDAO->selecionar($id);

        $pedido = $pedidoDAO->selecionar($id2);

        if(sizeof($produtos)==0){
            return view('visualizarPedido',["msg" => "Não há produtos no pedido.","cliente" => $cliente, "pedido" => $pedido]);            
        }


        return view('visualizarPedido',["produtos" => $produtos,"pedido" => $pedido, "cliente" => $cliente,"status" => $status]);
    }


    public function atualizarPedido(Request $req, $id){
        $pedidoDAO = new PedidoDAO();

        $status = ['Pendente', 'Em preparo', 'Em entrega', 'Entregue', 'Cancelado'];

        $produtos = $pedidoDAO->selecionarProdutos($id);

        $clienteDAO = new ClienteDAO();

        $pedido = $pedidoDAO->selecionar($id);


        $cliente = $clienteDAO->selecionar($pedido->cod_cli);
        
        return view('visualizarPedido',["produtos" => $produtos,"pedido" => $pedido, "cliente" => $cliente,"status" => $status, "id" => $id]);   
    }

    public function alterarPedido(Request $req){
        $pedidoDAO = new PedidoDAO();

        $msg2= "";


        if(!is_int($req->input('id'))){
            $msg2  = "A variável id de pedido deve ser inteira";
        }

        if(!is_int($req->input('status'))){
            $msg2 = "A variável status deve ser inteira. Checar valor no HTML.";
        }

        $msg = "Um erro ocorreu! Não foi possível alterar pedido";

        $status = ['Pendente', 'Em preparo', 'Em entrega', 'Entregue', 'Cancelado'];

        $produtos = $pedidoDAO->selecionarProdutos($req->input('id'));

        $clienteDAO = new ClienteDAO();

        $pedido = $pedidoDAO->selecionar($req->input('id'));


        $cliente = $clienteDAO->selecionar($pedido->cod_cli);

        if($pedidoDAO->alterarAdmin($req->input('id'), $req->input('status'))){
            $msg = "O pedido foi alterado com sucesso";
        }

        return view('visualizarPedido',["produtos" => $produtos,"pedido" => $pedido, "cliente" => $cliente,"status" => $status,"msg" => $msg, "msg2"=> $msg2]);
    }
}
