<h2>Teste de Backend Blacklab</h2>
<br><br><br>
<ul>
	<li>Projeto Lanchonete</li>
	<li>Framework: Laravel 8</li>
	<li>Autor: Wannderson Nogueira</li>
</ul>

<br><br>

<h4>Requisitos para funcionamento na máquina local</h4>
<br><br>
<ul>
	<li>Gerenciador de banco de dados relacional MySQL.</li>
	<li>PHP 7+.</li>
	<li>Laravel 8.</li>
	<li>GIT (opcional).</li>
</ul>

<h4>Instruções para executar o software em máquina local</h4>
<br><br>
<ol>
	<li>Executar o comando <i>git clone https://github.com/WanndersonOliveira/backend-challenge.git</i> no CMD do Windows ou no shell do Linux/Mac.</li>
	<li>Acessar a pasta <i>backend-challenge</i> no diretório em que ela foi baixada. Extrair a subpasta <b>projeto</b> de dentro da pasta para o diretório de sua escolha</li>
	<li>Ligar o Gerenciador de Banco de Dados MySQL.</li>
	<li>Criar um banco de dados chamado <b>blacklab</b>.</li>
	<li>Acessar a pasta <b>projeto</b> e executar o comando <i>php artisan migrate</i> para executar a migração das tabelas preparadas em php.</li>
	<li>Executar o comando <i>php artisan db:seed</i> para criar o registro do administrador (é por ele que você faz o login).</li>
	<li>Executar o comando <i>php artisan serve</i></li>
	<li>Acessar a pasta <b>routes</b> dentro de <b>projeto</b>, abrir o arquivo <i>web.php</i> para consultar as rotas.</li>
	<li>Caso seja necessário (e se vossa senhoria estiver usando o Linux), executar os testes para API no arquivo <i>teste.php</i> usando comando <i>php teste.php</i> na raiz de <b>backend-challenge</b>. (Caso não dê certo, procurar baixar o módulo <b><i>php-curl</i></b>)</li>
	<li>O teste de API acima só implementa dois casos de uso: Cadastrar Cliente e Login Cliente, pois alguns casos de uso de cliente necessita de dados cadastrados pelo administrador.</li>
</ol>

<br>
<br>

<h4>Regras de Negócio</h4>
<br><br>
<ul>
	<li>O login do administrador será feito pelo respectivo email: <i>admin@gmail.com</i> e pela respectiva senha: <i>admin</i>.</li>
	<li>O administrador só poderá alterar o pedido em seu atributo <i>status</i>.</li>
	<li>O cliente pode alterar o pedido se quiser excluir algum produto da lista ou adicionar algum outro produto.</li>
	<li>Ao atualizar o pedido, a data de atualização sobreporá a data de criação do pedido.</li>
	<li>Quando o cliente atualizar o pedido, ele deve informar um array de ids dos produtos. Caso um id seja igual a um id de um produto que esteja em seu pedido, esse produto será excluído de seu pedido. Caso contrário, esse produto deverá ser adicionado ao pedido</li>
	<li>Um administrador não poderá excluir um produto disponível se ele estiver no pedido de um cliente devido a quebra de integridade relacional do banco de dados.</li>
</ul>
<br>
<br>
<h4>Rotas API Cliente</h4>
<br>
<br>
<ul>
	<li>POST <i>cliente/cadastrar</i> - Cadastrar Clientes {nome, email, senha, endereco, telefone}</li>
	<li>POST <i>cliente/login</i> - Login do Cliente {email, senha}</li>
	<li>POST <i>cliente/pedido/cadastrar</i> - Cadastrar Pedido {id, idProduto, data} (id: id do cliente; idProduto: array de ids de produtos; data: data de criação) </li>
	<li>PATCH <i>cliente/pedido/alterar/{id}</i> - Alterar Pedido {id, idProduto, data} (o id passado na url é o id do pedido) </li>
	<li>GET <i>cliente/produtos/listar</i> - Listar (todos os) Produtos</li>
	<li>GET <i>cliente/pedidos/listar</i> - Listar Pedidos do cliente</li>
	<li>DELETE <i>cliente/pedido/excluir/{id} - Excluir Pedido -(id do pedido)</i></li>
	<li>GET <i>cliente/pedidos/ver/{id}</i> - Ver Pedido - (id do pedido)</li>
	<li>GET <i>cliente/logoff</i> - Logoff do usuário</li>
</ul>

<br>
<br>
<h4>Observações</h4>

<br><br>
<ul>
	<li>Os diagramas UML, localizados na respectiva pasta <i>uml</i> na raiz de <b>projeto</b> não descrevem fielmente a organização do sistema, mas dão uma ideia de como ele seria.</li>
	<li>O caso de uso <b>Excluir Pedido</b> foi inicialmente pensado para ser excluído tanto por <i>Cliente</i> como para <i>Admin</i>. Pois assim que o cliente receber o produto em sua residência, ele poderia excluí-lo. E caso houvesse algum erro em algum pedido, o administrador poderia excluí-lo. Mas, isso daria uma liberdade ao administrador de excluir pedidos a esmo ou acidentalmente, podendo causar avarias ao cliente.</li>
	<li>Devido ao curto tempo, os demais DSSs não foram realizados.</li>
</ul>

<br>
<br>
<br>

<center>
	<h3>Agradeço a oportunidade! ;D</h3>
</center>