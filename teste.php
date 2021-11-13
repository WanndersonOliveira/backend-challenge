<?php
	$curl = curl_init();

	echo "\nTeste de cadastro de clientes.\n";
	echo "Casos de sucesso\n\n";

	$usuarios = array(
		array("Sergio Mallandro", 'mallandro@gmail.com','123456','Rua dos pegas, 1333, Alecrim', '9999999'),
		array("Mara Maravilha", 'maravilha@gmail.com','56789','Rua dos flamboyans, 4444, Tirol', '888888'),
		array("Carlos Chagas", 'chagas@gmail.com','4582','Rua dos caiapós, 5555, Capim Macio', '887788'),
		array("Paulo de Tarso", 'ptarso@gmail.com','12345','Rua dos mororós, 1010, Pajuçara', '778899'),
	);

	foreach($usuarios as $usuario){

	curl_setopt_array($curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'http://localhost:8000/cliente/cadastrar',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => [
			nome => $usuario[0],
			email => $usuario[1],
			senha => $usuario[2],
			endereco => $usuario[3],
			telefone => $usuario[4],
		]
	]);

	$response = curl_exec($curl);

	echo $response;
	}


	echo "\n\nCasos de insucesso!\n\n";

	$usuarios = array(
		array("", 'mallandro@gmail.com','123456','Rua dos pegas, 1333, Alecrim', '9999999'),
		array("Mara Maravilha", '','56789','Rua dos flamboyans, 4444, Tirol', '888888'),
		array("Carlos Chagas", 'chagas@gmail.com','','Rua dos caiapós, 5555, Capim Macio', '887788'),
		array("Paulo de Tarso", 'ptarso@gmail.com','12345','', '778899'),
		array("Paulo de Tarso", 'ptarso@gmail.com','12345','', ''),
		array("Paulo de Tarso", 'ptarsogmail.com','12345','Rua dos amorins,2323, Ponta Negra', '776699'),
		array("Paulo de Tarso", 'ptarso@gmail.com','12345','Rua dos amorins,2323, Ponta Negra', '776688'),
		array("Paulo de Tarso", 'ptarso2@gmail.com','12345','Rua dos amorins,2323, Ponta Negra', '776699'),
	);

	foreach($usuarios as $usuario){

	curl_setopt_array($curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'http://localhost:8000/cliente/cadastrar',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => [
			nome => $usuario[0],
			email => $usuario[1],
			senha => $usuario[2],
			endereco => $usuario[3],
			telefone => $usuario[4],
		]
	]);

	$response = curl_exec($curl);

	echo $response;
	}	


	echo "\n\nLogin de cliente\n\n";
	echo "Caso de sucesso\n\n\n\n";

	$usuarios = array(
		array('mallandro@gmail.com','123456'),
		array("maravilha@gmail.com",'56789'),
	);

	foreach($usuarios as $usuario){

	curl_setopt_array($curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'http://localhost:8000/cliente/login',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => [
			email => $usuario[0],
			senha => $usuario[1],
		]
	]);

	$response = curl_exec($curl);

	echo $response;
	}	


	echo "\n\nCaso de insucesso\n\n\n\n";

	$usuarios = array(
		array('mallandro@gmail.com',''),
		array("",'56789'),
		array('mallandro@gmail.com','abcdef'),
		array("maravilha75@gmail.com",'56789'),
	);

	foreach($usuarios as $usuario){

	curl_setopt_array($curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'http://localhost:8000/cliente/login',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => [
			email => $usuario[0],
			senha => $usuario[1],
		]
	]);

	$response = curl_exec($curl);

	echo $response;
	}

	curl_close($curl);
?>
