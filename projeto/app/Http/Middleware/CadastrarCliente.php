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
        $validated = $request->validate([
            'nome' => ['required'], //'regex:^[a-zA-Z ]*$/'],
            'endereco' => ['required'],
            'telefone' => ['required'],// 'regex:^[0-9\-\+]{9,15}$'],
            'email' => ['required'],//'regex:^.+@.+$/i'],
            'senha' => ['required', 'max:20'],
        ]);

        return $next($request);
    }
}
