<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Hash;


class ClienteDAO 
{
    //use HasFactory;

    public function listar(){
        $clientes = Cliente::all();

        return $clientes;
    }

    public function selecionar($id){
        $cliente = Cliente::find($id);

        return $cliente;
    }


    public function checar($email, $telefone, $senha){
    	$cliente = Cliente::where('email','=',$email)->get();

        $cliente2 = Cliente::where('telefone','=',$telefone)->get();

    	$check = 0;

    	if(sizeof($cliente) == 0 & sizeof($cliente2) == 0){
    		$check = 0; 	//Não tem email, senha ou telefone no banco de dados.
    	} else {
    		if(Hash::check($senha, $cliente[0]->password)){
    			$check = 1;		//Tem email, senha e telefone no banco de dados.
    		} else {	
    			$check = 2; //Tem email e telefone no banco de dados mas com senha diferente.
    		}
    	}

    	return $check;
    }

    public function cadastrar($nome, $endereco, $telefone, $email, $senha){
    	$cliente = new Cliente();
    	$cliente->nome = $nome;
    	$cliente->endereço = $endereco;
    	$cliente->telefone = $telefone;
    	$cliente->email = $email;
    	$cliente->password = Hash::make($senha);

    	$cliente->save();

    	return true;
    }


    public function autenticar($email, $senha){
    	$cliente = Cliente::where('email','=',$email)->get();

        error_log($cliente);

    	if(sizeof($cliente) == 0){
    		return null;
    	} else {
    		if(Hash::check($senha, $cliente[0]->password)){
    			return $cliente;
    		} else {
    			return null;
    		}
    	}	
    }
}

