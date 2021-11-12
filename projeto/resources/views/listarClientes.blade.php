<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de Clientes</title>
</head>
<body>
	<a href="/initial">Voltar</a>
	<br>
	<center>
		<h3>Lista de Clientes</h3>
		<br><br>
		@if (isset($msg))
			<b>{{ $msg }}</b>
		@endif
		<br><br>
		<ul>
		@if (isset($clientes))
			@foreach ($clientes as $cliente)
				<li>{{ $cliente->nome }} - {{ $cliente->email }} - {{ $cliente->telefone }} - {{ $cliente->endereço }}</li>
			@endforeach
		@endif
		</ul>

		<br><br>
		@if (isset($count))
			<p>Há {{ $count }} clientes cadastrados até o momento.</p>
		@endif

	</center>
</body>
</html>