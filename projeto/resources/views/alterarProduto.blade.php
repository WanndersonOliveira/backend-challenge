<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<a href="/initial">Voltar</a>
	<br>
	<center>
		<h3>Alteração de produto</h3>
		<br><br>
		<form method="post" action="/produto/alterar">
			@csrf
			<input type="hidden" name="id" value="{{ $id }}">
			<input type="text" name="nome" value="{{ $nome }}"><br>
			<input type="text" name="preco" value="{{ $preco }}"><br><br>
			<input type="submit" value="Alterar">
		</form>
	</center>
</body>
</html>