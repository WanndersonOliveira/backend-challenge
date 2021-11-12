<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LoginCliente;
use App\Http\Middleware\CadastrarProdutos;
use App\Http\Middleware\CadastrarProdutosCli;
use App\Http\Middleware\CadastrarCliente;
use App\Http\Middleware\Cors;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Rotas Administrativas

Route::get('/', [AdminController::class,'login']);
Route::get('/logout',[AdminController::class,'logout']);
Route::get('/initial',[AdminController::class,'initial']);
Route::post('/auth',[AdminController::class,'auth']);//->middleware('validlogin','authadmin');

Route::get('/produto/cadastrar',function (){
	return view('cadastroProdutos');
});

Route::get('/cliente/listar', 'App\Http\Controllers\AdminController@listarClientes');

Route::get('/produto/listar', 'App\Http\Controllers\AdminController@listarProdutos');
Route::get('/pedido/listar', 'App\Http\Controllers\AdminController@listarPedidos');
Route::get('/pedido/ver/{id}/{id2}','App\Http\Controllers\AdminController@visualizarPedidos');

Route::get('/produto/excluir/{id}', 'App\Http\Controllers\AdminController@deletarProduto');

Route::get('/produto/alterar/{id}', 'App\Http\Controllers\AdminController@atualizarProduto');
Route::get('/pedido/alterar/{id}','App\Http\Controllers\AdminController@atualizarPedido');

//Route::middleware([AlterarPedido::class])->group(function(){
	Route::post('/pedido/atualizar', 'App\Http\Controllers\AdminController@alterarPedido');
//});
//Route::middleware([CadastrarProdutos::class])->group(function(){
	Route::post('/produto/cadastrar','App\Http\Controllers\AdminController@cadastrarProduto');

	Route::post('/produto/alterar','App\Http\Controllers\AdminController@alterarProduto');
//});

//Rotas de Clientes

Route::get('/cliente/produtos/listar', 'App\Http\Controllers\ClienteController@mostrarProdutos');

Route::get('/cliente/logoff', 'App\Http\Controllers\ClienteController@logoff');

Route::get('/cliente/pedidos/listar','App\Http\Controllers\ClienteController@listarPedidos');

Route::get('/cliente/pedidos/ver/{id}','App\Http\Controllers\ClienteController@verPedido');

Route::delete('/cliente/pedido/excluir/{id}','App\Http\Controllers\ClienteController@excluirPedido');


Route::middleware([CadastrarProdutosCli::class])->group(function(){
	Route::post('/cliente/pedido/cadastrar', 'App\Http\Controllers\ClienteController@cadastrarPedido');

	Route::patch('/cliente/pedido/alterar/{id}','App\Http\Controllers\ClienteController@alterarPedido');
});

Route::middleware([LoginCliente::class])->group(function(){
	Route::post('/cliente/login','App\Http\Controllers\ClienteController@login');
});

Route::middleware([CadastrarCliente::class])->group(function(){
	Route::post('/cliente/cadastrar','App\Http\Controllers\ClienteController@cadastrar');
});



