<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lanchonete Podrão Admin</title>
</head>
<body>
	<a href="/logout">Sair</a>
	@for ($i = 0; $i < 5; $i++)
		<br>
	@endfor
	<center>
	<h3>Lanchonete Podrão</h3>
	@for ($i = 0; $i < 3; $i++)
		<br>
	@endfor
	<a href="/produto/cadastrar">Cadastrar Produtos</a><br><br>
	<a href="/produto/listar">Listar Produtos</a><br><br>
	<a href="/pedido/listar">Listar Pedidos</a><br><br>
	<a href="/cliente/listar">Listar Clientes</a><br><br>
	</center>
</body>
</html>