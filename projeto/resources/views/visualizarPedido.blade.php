<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pedido</title>
</head>
<body>
	<a href="/initial">Voltar</a>
	<br>
	<center>
		<h4>Pedido</h4>

		<br><br>
		<a href="/pedido/alterar/{{ $pedido->id }}">Alterar Pedido</a>
		<br>
		<br>
		@if (isset($msg))
			<p>{{ $msg }}</p>
		@endif
		<br>
		@if(isset($msg2))
			<p>{{ $msg2 }}</p>
		@endif
	</center>
		<br><br>
		<p><b>Data de Criação:</b> {{ $pedido->data_criacao }}</p>
		<br>
		<br>

		<b>Status: </b>
		@if (isset($id))
		  <form method="post" action="/pedido/atualizar">
		  	@csrf
		  	<input type="hidden" name="id" value="{{ $pedido->id }}">

		  	<select name="status">
		  	@for ($i = 0; $i < sizeof($status); $i++)
		  		<option value="{{ $i }}">{{ $status[$i] }}</option>
		  	@endfor
		  	</select>

		  	<input type="submit" value="Alterar">
		  </form>
		@else 
		  {{ $status[$pedido->status] }}
		@endif
		</p>
		<br>
		<br>
		<p><b>Cliente:</b> {{ $cliente->nome }}</p>
		<br>
		<br>
		<p><b>Telefone:</b> {{ $cliente->telefone }}</p>
		<br>
		<br>
		<p><b>Endereço:</b> {{ $cliente->endereço }}</p>
		<br>
		<br>
		<br>
		<br>
		<b>Produtos:</b><br><br>
		
		@if (isset($produtos))
			<ul>
			@foreach($produtos as $produto)
				<li>{{ $produto->nome }} - {{ $produto->preco }}</li>
			@endforeach
			</ul>
		@endif
</body>
</html>