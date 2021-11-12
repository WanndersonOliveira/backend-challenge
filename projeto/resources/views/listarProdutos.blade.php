<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lista de Produtos</title>
</head>
<body>
	<a href="/initial">Voltar</a>
	<br>
	<center>
		<h3>Lista de Produtos</h3><br><br><br>

		@if (isset($msg))
			<b>{{ $msg }}</b>
		@endif
		<br><br>
		<ul>
		@if (isset($produtos))
			@foreach ($produtos as $produto)
				<li>{{ $produto->nome }} - {{ $produto->preco }} - <a href="/produto/excluir/{{ $produto->id }}">Excluir</a> - <a href="/produto/alterar/{{ $produto->id }}">Alterar</a></li>
			@endforeach
		@endif
		</ul>
	</center>
</body>
</html>