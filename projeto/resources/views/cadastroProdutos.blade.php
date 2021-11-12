<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro de Produtos</title>
</head>
<body>
	<a href="/produto/listar">Listar Produtos</a>
	<br>
	<center>
		<h3>Cadastro de Produtos</h3>
		<br><br><br>
		<form method="post" action="/produto/cadastrar">
			@csrf
			<input type="text" name="nome" placeholder="Nome"><br>
			<input type="text" name="preco" placeholder="Preço"><br><br>
			<input type="submit" value="Cadastrar">
		</form>
		<br><br><br>


		@if (isset($msg))
			<b>{{ $msg }}</b>
		@endif
	</center>
</body>
</html>