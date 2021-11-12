<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de Pedidos</title>
</head>
<body>
	<a href="/initial">Voltar</a>
	<br>
	<center>
		<h4>Lista de Pedidos</h4>
		<br><br>
		@if (isset($msg))
			<b>{{ $msg }}</b>
		@endif

		<br><br>
		@if (isset($pedidos))
			@foreach ($pedidos as $pedido)
				<b>{{ $status[$pedido->status] }}</b> - {{ $pedido->data_criacao }} - <a href="/pedido/ver/{{ $pedido->cod_cli }}/{{ $pedido->id }}">Visualizar</a><br>
			@endforeach
		@endif

		<br><br>

		@if (isset($count))
			<p>Há {{ $count }} pedidos cadastrados.</p>
		@endif
	</center>
</body>
</html>